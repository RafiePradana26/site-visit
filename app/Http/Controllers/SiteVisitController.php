<?php

namespace App\Http\Controllers;

use App\Models\SiteVisitModel;
use PDF;
// use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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
            'date_visit' => 'required|date'
        ]);

        // Simpan foto kunjungan ke server
        $visitPhotoPath = $request->file('visit_photo')->store('visit_photos', 'public');

        // Mendapatkan tipe gambar
        $imageFileType = pathinfo($visitPhotoPath, PATHINFO_EXTENSION);

        // Membuat string untuk tipe gambar
        $imageTypeString = 'data:image/' . $imageFileType . ';base64,';

        // Membaca file gambar
        $image = file_get_contents(public_path('storage/' . $visitPhotoPath));

        // Encode ke base64
        $visitPhotoUrl = $imageTypeString . base64_encode($image);
        $signPhotoUrl = $this->saveBase64Image($validatedData['sign_photo'], 'signatures');
        $signPhotoClientUrl = $this->saveBase64Image($validatedData['sign_photo_client'], 'signatures');

        // Simpan data ke database
        $siteVisit = new SiteVisitModel();
        $siteVisit->name = $validatedData['name'];
        $siteVisit->email = $validatedData['email'];
        $siteVisit->location = $validatedData['location'];
        $siteVisit->clientName = $validatedData['clientName'];
        $siteVisit->purpose = $validatedData['purpose'];
        $siteVisit->visit_photo = $visitPhotoPath;
        $siteVisit->sign_photo_url = $validatedData['sign_photo'];
        $siteVisit->sign_photo_client_url = $validatedData['sign_photo_client'];
        $siteVisit->visit_photo_url = $visitPhotoUrl;
        $siteVisit->sign_photo = $signPhotoUrl;
        $siteVisit->sign_photo_client = $signPhotoClientUrl;
        $siteVisit->date_visit = $validatedData['date_visit'];
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

    public function exportPDF()
    {
        $siteVisits = SiteVisitModel::all();

        $pdf = new Dompdf();
        $pdf->loadHtml(View::make('website.sitevisit.site_visit_pdf', compact('siteVisits'))->render());
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream('site_visit.pdf');
    }

    // public function exportPDF()
    // {
    //     $siteVisits = SiteVisitModel::all();
    //     $pdf = PDF::loadView('website.sitevisit.site_visit', compact('siteVisits'));
    //     return $pdf->download('site_visit.pdf');
    //     // return $pdf->stream(); 
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
