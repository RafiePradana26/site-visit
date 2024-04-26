<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate([
            'status' => 'required|in:Progress,Pending,Solved,onhold',
        ]);

        $ticket->update(['status' => $request->input('status')]);

        return redirect()->back()->with('success', 'Ticket status updated successfully');
    }

    public function assign(Request $request, Ticket $ticket)
    {
        $ticketId = $request->input('ticket_id');
        $userId = $request->input('user_id');

        $ticket = Ticket::findOrFail($ticketId);
        $user = User::findOrFail($userId);



        // Increment the case_total attribute for the user by 1
        $user->increment('case_total');

        // Update the status based on the new case_total value
        $user->updateStatus();

        // Update the ticket's name_tech with the user's name
        $ticket->update(['name_tech' => $user->name]);
        $ticket->update(['status' => 'Pending']);


        return redirect()->route('auth.dashboard')->with('success', 'Ticket assigned successfully');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
