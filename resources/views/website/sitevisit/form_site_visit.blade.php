<!DOCTYPE html>
<html lang="en">
@extends('layouts.user')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    Form Site Visit
                </h3>
                <nav aria-label="breadcrumb">
                    <!-- Breadcrumb navigation, if needed -->
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" id="submitSiteVisit" action="{{ route('site-visit.store') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label for="exampleInputName1">Name</label>
                                    <input type="text" class="form-control" id="" placeholder="Input Name"
                                        name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Email Address</label>
                                    <input type="text" class="form-control" id=""
                                        placeholder="Input email address" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Location</label>
                                    <input type="text" class="form-control" id="" placeholder="Input Name"
                                        name="location" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Customer/client name</label>
                                    <input type="text" class="form-control" id=""
                                        placeholder="Input customer/client name" name="clientName" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Purpose of visit</label>
                                    <input type="text" class="form-control" id=""
                                        placeholder="Input purpose of visit" name="purpose" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Upload Photo</label>
                                    <input type="file" class="form-control" name="visit_photo" accept="image/*,video/*"
                                        required>
                                </div>
                                {{-- <!-- Tambahkan input tersembunyi untuk menyimpan URL gambar tanda tangan site visit -->
                                <input type="hidden" id="sign_photo_url" name="sign_photo_url">
                                <!-- Tambahkan input tersembunyi untuk menyimpan URL gambar tanda tangan client -->
                                <input type="hidden" id="sign_photo_client_url" name="sign_photo_client_url">
                                <div class="form-group">
                                    <label for="exampleInputSignature">Signature (Site Visit)</label>
                                    <canvas id="sign_photo" class="sign_photo" width="400" height="200"
                                        style="border: 1px solid black;"></canvas>
                                    <button type="button" id="clearSignature" class="btn btn-danger">Clear
                                        Signature</button>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputSignature">Client's Signature</label>
                                    <canvas id="sign_photo_client" class="sign_photo_client" width="400" height="200"
                                        style="border: 1px solid black;"></canvas>
                                    <button type="button" id="clearSignatureClient" class="btn btn-danger">Clear
                                        Signature</button>
                                </div> --}}
                                <div class="form-group">
                                    <label for="exampleInputName1">Tanggal Submit</label>
                                    <input type="date" class="form-control" id="exampleInputName1" name="created_at"
                                        placeholder="date" required value="{{ now()->format('Y-m-d') }}" readonly>
                                </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- <script>
                // Skrip untuk tanda tangan site visit
                const canvas1 = document.getElementById('sign_photo');
                const ctx1 = canvas1.getContext('2d');
                let isDrawing1 = false;
                let lastX1 = 0;
                let lastY1 = 0;

                canvas1.addEventListener('mousedown', (e) => {
                    isDrawing1 = true;
                    [lastX1, lastY1] = [e.offsetX, e.offsetY];
                });

                canvas1.addEventListener('mousemove', (e) => {
                    if (!isDrawing1) return;
                    ctx1.beginPath();
                    ctx1.moveTo(lastX1, lastY1);
                    ctx1.lineTo(e.offsetX, e.offsetY);
                    ctx1.stroke();
                    [lastX1, lastY1] = [e.offsetX, e.offsetY];
                });

                canvas1.addEventListener('mouseup', () => {
                    isDrawing1 = false;
                    // Mengambil URL gambar dari kanvas dan menyimpannya ke dalam input tersembunyi
                    document.getElementById('sign_photo_url').value = canvas1.toDataURL();
                });

                canvas1.addEventListener('mouseout', () => {
                    isDrawing1 = false;
                });

                document.getElementById('clearSignature').addEventListener('click', () => {
                    ctx1.clearRect(0, 0, canvas1.width, canvas1.height);
                });

                // Skrip untuk tanda tangan client
                const canvas2 = document.getElementById('sign_photo_client');
                const ctx2 = canvas2.getContext('2d');
                let isDrawing2 = false;
                let lastX2 = 0;
                let lastY2 = 0;

                canvas2.addEventListener('mousedown', (e) => {
                    isDrawing2 = true;
                    [lastX2, lastY2] = [e.offsetX, e.offsetY];
                });

                canvas2.addEventListener('mousemove', (e) => {
                    if (!isDrawing2) return;
                    ctx2.beginPath();
                    ctx2.moveTo(lastX2, lastY2);
                    ctx2.lineTo(e.offsetX, e.offsetY);
                    ctx2.stroke();
                    [lastX2, lastY2] = [e.offsetX, e.offsetY];
                });

                canvas2.addEventListener('mouseup', () => {
                    isDrawing2 = false;
                    // Mengambil URL gambar dari kanvas dan menyimpannya ke dalam input tersembunyi
                    document.getElementById('sign_photo_client_url').value = canvas2.toDataURL();
                });

                canvas2.addEventListener('mouseout', () => {
                    isDrawing2 = false;
                });

                document.getElementById('clearSignatureClient').addEventListener('click', () => {
                    ctx2.clearRect(0, 0, canvas2.width, canvas2.height);
                });
            </script> --}}
        </div>
    @endsection

    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Jika gambar tidak berhasil ditampilkan, silahkan ubah / upload ulang pada halaman edit',
                    icon: 'success'
                }).then(function() {
                    window.location.href = '{{ route('blog') }}';
                });
            });
        </script>
    @endif --}}
