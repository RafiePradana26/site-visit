<?php

namespace App\Http\Controllers;

use App\Models\SiteVisitModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class SiteVisitController extends Controller
{
    public function showAllSiteVisit()
    {
        $siteVisits = SiteVisitModel::all();
        return view('website.sitevisit.site_visit', compact('siteVisits'));
    }

    public function showDetail($id)
    {
        // Ambil data dari database berdasarkan ID yang diberikan
        $siteVisits = SiteVisitModel::findOrFail($id);

        // Kirim data ke halaman detail
        return view('website.sitevisit.detail_site_visit', compact('siteVisits'));
    }

    public function indexSiteVisit()
    {
        //
        return view('website.sitevisit.form_site_visit');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'location' => 'required|string',
            'clientName' => 'required|string',
            'purpose' => 'required|string',
            'visit_photo' => 'required|image',
            'sign_photo' => 'required|string',
            'sign_photo_client' => 'required|string',
        ]);

        // Simpan foto kunjungan ke server
        $visitPhotoPath = $request->file('visit_photo')->store('visit_photos', 'public');
        $signPhotoPath = $this->saveBase64Image($validatedData['sign_photo'], 'signatures');
        $signPhotoClientPath = $this->saveBase64Image($validatedData['sign_photo_client'], 'signatures');

        // Simpan data ke database
        $siteVisit = new SiteVisitModel();
        $siteVisit->name = $validatedData['name'];
        $siteVisit->email = $validatedData['email'];
        $siteVisit->location = $validatedData['location'];
        $siteVisit->clientName = $validatedData['clientName'];
        $siteVisit->purpose = $validatedData['purpose'];
        $siteVisit->visit_photo = $visitPhotoPath;
        // $siteVisit->sign_photo = $validatedData['sign_photo'];
        // $siteVisit->sign_photo_client = $validatedData['sign_photo_client'];
        $siteVisit->sign_photo = $signPhotoPath;
        $siteVisit->sign_photo_client = $signPhotoClientPath;
        $siteVisit->save();

        // Kembalikan respons ke pengguna
        return redirect()->route('website.sitevisit')->with('success', 'Site visit data has been successfully stored!');
    }

    private function saveBase64Image($base64Image, $subdirectory)
    {
        // Decode base64 image
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64Image));

        // Generate unique filename
        $filename = uniqid() . '.png';

        // Save the image to storage
        Storage::disk('public')->put("$subdirectory/$filename", $imageData);

        // Return the path to the saved image
        return "$subdirectory/$filename";
    }


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

    public function destroy($id)
    {
        //
    }
}
