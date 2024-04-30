<?php

namespace App\Http\Controllers;

use App\Models\SiteVisitModel;
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
            // 'sign_photo_client' => 'required',
        ]);

        // Simpan foto kunjungan ke server
        $visitPhotoPath = $request->file('visit_photo')->store('visit_photos', 'public');

        // Simpan data ke database
        $siteVisit = new SiteVisitModel();
        $siteVisit->name = $validatedData['name'];
        $siteVisit->email = $validatedData['email'];
        $siteVisit->location = $validatedData['location'];
        $siteVisit->clientName = $validatedData['clientName'];
        $siteVisit->purpose = $validatedData['purpose'];
        $siteVisit->visit_photo = $visitPhotoPath;
        $siteVisit->sign_photo = $validatedData['sign_photo'];
        $siteVisit->save();

        // Kembalikan respons ke pengguna
        return redirect()->route('website.sitevisit')->with('success', 'Site visit data has been successfully stored!');
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
