@extends('layouts.auth')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <a href="/user_management" class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-arrow-left"></i>
                    </a>
                    User Management
                </h3>                
                <nav aria-label="breadcrumb">
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" id="submitRms" action="{{ route('blog.submit') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleSelectName">Nama</label>
                                    <select class="form-control" id="selectName">
                                        <option disabled selected>Pilih Nama</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>  
                                        @endforeach
                                    </select>
                                </div>                                
                                <div class="form-group">
                                    <label for="exampleSelectProduct">Role</label>
                                    <select class="form-control" id="exampleSelectProduct">
                                        <option disabled selected>select product type</option>
                                        <option value="0" >Tableau Server
                                        </option>
                                        <option value="1" >Tableau Online
                                        </option>                                        
                                            Builder</option>
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endsection
