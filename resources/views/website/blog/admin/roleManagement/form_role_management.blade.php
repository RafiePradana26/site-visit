@extends('layouts.auth')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <a href="/role_management" class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-arrow-left"></i>
                    </a>
                    Role Management
                </h3>
                <nav aria-label="breadcrumb">
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" id="submitRole" action="{{ route('role.submit') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">Role</label>
                                    <input type="text" class="form-control" id="exampleInputSubject"
                                        placeholder="Nama Role" name="role" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleCheckbox">Akses Halaman</label>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                    name="akses_halaman[]" value="landingPage">
                                                <label class="form-check-label" for="landingPage">Landing Page</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    name="akses_halaman[]" value="aktivitas">
                                                <label class="form-check-label" for="aktivitas">Aktivitas</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                    name="akses_halaman[]" value="pendaftaran">
                                                <label class="form-check-label" for="pendaftaran">Pendaftaran</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                    name="akses_halaman[]" value="blog">
                                                <label class="form-check-label" for="blog">Blog</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                    name="akses_halaman[]" value="kelas">
                                                <label class="form-check-label" for="kelas">Kelas</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" 
                                                    name="akses_halaman[]" value="testimoni">
                                                <label class="form-check-label" for="testimoni">Testimoni</label>
                                            </div>
                                            <div class="col">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" 
                                                        name="akses_halaman[]" value="aboutUs">
                                                    <label class="form-check-label" for="aboutUs">About Us</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="akses_halaman[]" value="rms">
                                                    <label class="form-check-label" for="rms ">Role Management </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endsection
