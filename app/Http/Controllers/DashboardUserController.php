<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class DashboardUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { {
            return view('pages.user_complainant.user_dashboard');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function updateProfile()
    {
        $user = Auth::user();
        return view('pages.user_complainant.update_profile_user', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        try {
            $user = Auth::user();

            // Validate the form data
            $request->validate([
                'password' => 'nullable|min:8', // Password is optional, can be null
                'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add file validation rules
            ]);

            // Update password if provided
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            // Update profile photo if provided
            if ($request->hasFile('profile_photo')) {
                // Validate and upload the profile photo
                $this->uploadProfilePhoto($request, $user);
            }

            // Save the user model
            $user->save();

            // Determine the success message based on the updated fields
            // $successMessage = 'Profile Updated Successfully!';
            if ($request->filled('password') && $request->hasFile('profile_photo')) {
                $successMessage = 'Password and Profile Photo Updated Successfully!';
            } elseif ($request->hasFile('profile_photo')) {
                $successMessage = 'Profile Photo Updated Successfully!';
            } elseif ($request->filled('password')) {
                $successMessage = 'Password Updated Successfully!';
            }

            // Add SweetAlert notification
            $sweetAlert = [
                'icon' => 'success',
                'title' => $successMessage,
                'position' => 'center',
            ];

            return redirect()->route('user.profile.update')->with('sweetAlert', $sweetAlert);
        } catch (ValidationException $e) {
            // Handle validation errors
            $errorMessages = $e->validator->getMessageBag()->all();
            $sweetAlert = [
                'icon' => 'error',
                'title' => 'Validation Error',
                'text' => implode('<br>', $errorMessages),
                'position' => 'center',
            ];

            return redirect()->route('user.profile.update')->with('sweetAlert', $sweetAlert)->withErrors($e->validator);
        } catch (\Exception $e) {
            // Handle other exceptions
            $sweetAlert = [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Nothing has been updated.',
                'position' => 'center',
            ];

            return redirect()->route('user.profile.update')->with('sweetAlert', $sweetAlert);
        }
    }


    private function uploadProfilePhoto(Request $request, $user)
    {
        // Validate the uploaded file
        $request->validate([
            'profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add appropriate file validation rules
        ]);

        // Get the uploaded file from the request
        $profilePhoto = $request->file('profile_photo');

        // Generate a unique name for the file
        $photoName = 'profile_' . time() . '.' . $profilePhoto->getClientOriginalExtension();

        // Move the uploaded file to the public disk
        $profilePhoto->storeAs('public/profile_photos', $photoName);

        // Check if the user already has a profile photo
        if ($user->profile_photo) {
            // If yes, delete the existing profile photo
            Storage::delete('public/' . $user->profile_photo);
        }

        // Save the new profile photo path
        $user->profile_photo = 'profile_photos/' . $photoName;

        // Save the user model
        $user->save();
    }

    public function redeemCode(Request $request)
    {
        $inputCode = $request->input('premiumCode');
        $validCode = 'GwoYQiY23Jdma'; // Gantilah dengan kode yang valid

        if ($inputCode == $validCode) {
            // Kode valid, update status premium menjadi true
            auth()->user()->update(['is_premium' => true]);

            // Set pesan sukses untuk Sweet Alert dalam session
            session()->flash('sweetAlert', [
                'icon' => 'success',
                'title' => 'Sukses!',
                'text' => 'Kode berhasil diredeem. Status user anda menjadi premium.'
            ]);

            // Redirect kembali ke halaman profile/update
            return redirect()->route('user.profile.update');
        } else {
            // Set pesan kesalahan untuk Sweet Alert dalam session
            session()->flash('sweetAlert', [
                'icon' => 'error',
                'title' => 'Error!',
                'text' => 'Kode tidak valid.'
            ]);

            // Redirect kembali ke halaman profile/update
            return redirect()->route('user.profile.update');
        }
    }

    public function create()
    {
        //
        // return view('pages.user_complainant.my_ticket');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name_user' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'complained_date' => 'required|date',
            'description' => 'required|string',
            'subject' => 'required|string|max:255',
            'product' => 'required|in:0,1,2,3',
            'phone' => 'required|numeric',
        ]);

        $product = $request->input('product');
        $productPrefix = ''; // Initialize an empty prefix

        // Determine the prefix and counter based on the selected product
        switch ($product) {
            case 0:
                $productPrefix = 'TS';
                break;
            case 1:
                $productPrefix = 'TO';
                break;
            case 2:
                $productPrefix = 'TD';
                break;
            case 3:
                $productPrefix = 'TP';
                break;
        }

        // Find the latest ticket with the same product prefix
        $latestTicket = Ticket::where('ticket_id', 'like', $productPrefix . '%')->latest()->first();

        // Generate the new ticket ID
        if ($latestTicket) {
            $ticketIdNumber = intval(substr($latestTicket->ticket_id, strlen($productPrefix))) + 1;
        } else {
            $ticketIdNumber = 1;
        }

        $newTicketId = $productPrefix . str_pad($ticketIdNumber, 5, '0', STR_PAD_LEFT);

        $password = Str::random(8);

        // Create a new user
        $user = User::create([
            'name' => $request->input('name_user'),
            'email' => $request->input('email'),
            'password' => bcrypt($password),
            'phone' => $request->input('phone'),
            'role' => 'user',
        ]);

        $userId = $user->getKey();

        // Create a new ticket using the Ticket model
        Ticket::create([
            'user_id' => $userId, // Set the user_id to the newly created user's ID
            'name_user' => $request->input('name_user'),
            'email' => $request->input('email'),
            'complained_date' => $request->input('complained_date'),
            'description' => $request->input('description'),
            'subject' => $request->input('subject'),
            'product' => $product,
            'phone' => $request->input('phone'),
            'status' => 'Open',
            'ticket_id' => $newTicketId,
        ]);

        $request->session()->flash('newTicketInfo', [
            'ticket_id' => $newTicketId,
            'name_user' => $request->input('name_user'),
            'email' => $request->input('email'),
            'password' => $password,
        ]);

        return redirect()->route('dashboard-user.index')->with('success', 'Ticket submitted successfully!');
    }

    public function submitTicket(Request $request)
    {
        $request->validate([
            'complained_date' => 'required|date',
            'description' => 'required|string',
            'subject' => 'required|string|max:255',
            'product' => 'required|in:0,1,2,3',
        ]);

        $product = $request->input('product');
        $productPrefix = ''; // Initialize an empty prefix

        // Determine the prefix and counter based on the selected product
        switch ($product) {
            case 0:
                $productPrefix = 'TS';
                break;
            case 1:
                $productPrefix = 'TO';
                break;
            case 2:
                $productPrefix = 'TD';
                break;
            case 3:
                $productPrefix = 'TP';
                break;
        }

        // Find the latest ticket with the same product prefix
        $latestTicket = Ticket::where('ticket_id', 'like', $productPrefix . '%')->latest()->first();

        // Generate the new ticket ID
        if ($latestTicket) {
            $ticketIdNumber = intval(substr($latestTicket->ticket_id, strlen($productPrefix))) + 1;
        } else {
            $ticketIdNumber = 1;
        }

        $newTicketId = $productPrefix . str_pad($ticketIdNumber, 5, '0', STR_PAD_LEFT);

        $user = $request->user();
        $userId = $user->getKey();

        // Create a new ticket using the Ticket model
        Ticket::create([
            'user_id' => $user->id, // Menggunakan ID pengguna saat ini
            'name_user' => $user->name, // Menggunakan nama pengguna saat ini
            'email' => $user->email, // Menggunakan email pengguna saat ini
            'complained_date' => $request->input('complained_date'),
            'description' => $request->input('description'),
            'subject' => $request->input('subject'),
            'product' => $product,
            'phone' => $user->phone, // Menggunakan nomor telepon pengguna saat ini
            'status' => 'Open',
            'ticket_id' => $newTicketId,
        ]);

        $request->session()->flash('newTicketInfoUser', [
            'ticket_id' => $newTicketId,
            'name_user' => $request->input('name_user'),
            'email' => $request->input('email'),
        ]);

        // Show Sweet Alert
        return redirect()->back()->with('success', 'Ticket submitted successfully!');
    }


    public function myTickets()
    {
        // Retrieve the authenticated user's email
        $userEmail = Auth::user()->email;

        // Fetch tickets associated with the user's email
        $userTickets = Ticket::where('email', $userEmail)->latest()->get();

        return view('pages.user_complainant.my_ticket', [
            'tickets' => $userTickets,
        ]);
    }

    public function showNewTicketForm(User $user)
    {
        $users = User::all();
        $ticket = Ticket::all();

        // Pass data to the view
        return view('pages.user_complainant.new_ticket', compact('user', 'ticket'));
    }


    public function refreshTableUser()
    {
        $user = Auth::user(); // Assuming you're using Laravel's built-in authentication

        // Filter tickets based on the authenticated user's name
        $tickets = Ticket::where('name_user', $user->name)->get();
        $html = view('partials.table_user', compact('tickets'))->render();

        return response()->json(['html' => $html]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // return view('pages.user_complainant.detail_ticket_user');
        // return view('pages.user_complainant.new_ticket');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ticket = Ticket::find($id);
        $messages = Chat::where('ticket_id', $id)->orderBy('created_at', 'asc')->get();

        return view('pages.user_complainant.detail_ticket_user', compact('ticket', 'messages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
