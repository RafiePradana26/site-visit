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
            // 'sign_photo' => 'required',
            // 'sign_photo_client' => 'required',
        ]);

        // Simpan foto kunjungan ke server
        $visitPhotoPath = $request->file('visit_photo')->store('visit_photos', 'public');

        // // Simpan tanda tangan sebagai gambar (site visit)
        // $signPhotoPath = $this->saveSignatureAsImage($request->input('sign_photo'));

        // // Simpan tanda tangan sebagai gambar (client)
        // $signPhotoClientPath = $this->saveSignatureAsImage($request->input('sign_photo_client'));

        // Simpan data ke database
        $siteVisit = new SiteVisitModel();
        $siteVisit->name = $validatedData['name'];
        $siteVisit->email = $validatedData['email'];
        $siteVisit->location = $validatedData['location'];
        $siteVisit->clientName = $validatedData['clientName'];
        $siteVisit->purpose = $validatedData['purpose'];
        $siteVisit->visit_photo = $visitPhotoPath;
        // $siteVisit->sign_photo = $signPhotoPath;
        // $siteVisit->sign_photo_client = $signPhotoClientPath;
        $siteVisit->save();

        // Kembalikan respons ke pengguna
        return redirect()->back()->with('success', 'Site visit data has been successfully stored!');
    }

    // Metode untuk menyimpan tanda tangan sebagai gambar
    // private function saveSignatureAsImage($signatureData)
    // {
    //     // Decode data URL dan simpan sebagai file gambar
    //     $encoded_image = explode(",", $signatureData)[1];
    //     $decoded_image = base64_decode($encoded_image);
    //     $imagePath = 'signatures/' . uniqid() . '.png'; // Misalnya, simpan tanda tangan sebagai PNG

    //     // Simpan gambar ke dalam direktori storage
    //     file_put_contents(public_path($imagePath), $decoded_image);

    //     // Kembalikan path dari gambar yang disimpan
    //     return $imagePath;
    // }


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
