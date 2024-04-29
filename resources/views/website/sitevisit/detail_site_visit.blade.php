<!DOCTYPE html>
<html lang="en">
@extends('layouts.user')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    Detail Site Visit
                </h3>
                <nav aria-label="breadcrumb">
                    <!-- Breadcrumb navigation, if needed -->
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" value="{{ $siteVisits->name }}"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email Address</label>
                                    <input type="text" class="form-control" id="email"
                                        value="{{ $siteVisits->email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="location">Location</label>
                                    <input type="text" class="form-control" id="location"
                                        value="{{ $siteVisits->location }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="clientName">Customer/Client Name</label>
                                    <input type="text" class="form-control" id="clientName"
                                        value="{{ $siteVisits->clientName }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="purpose">Purpose of Visit</label>
                                    <input type="text" class="form-control" id="purpose"
                                        value="{{ $siteVisits->purpose }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="visit_photo">Uploaded Photo</label><br>
                                    <img src="{{ asset('storage/' . $siteVisits->visit_photo) }}" alt="Visit Photo"
                                        style="max-width: 200px;">
                                </div>
                                <div class="form-group">
                                    <label for="created_at">Date of Visit</label>
                                    <input type="text" class="form-control" id="created_at"
                                        value="{{ $siteVisits->created_at }}" readonly>
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
