@extends('layouts.auth')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
                            <form class="forms-sample" action="{{ route('updateUserRole', $users->id) }}" method="post">
                                @csrf
                                @method('PUT') {{-- Use the correct method for updating --}}
                                <div class="form-group">
                                    <label for="exampleInputName1">Name</label>
                                    <input type="text" value="{{ $users->name }}" class="form-control" id="exampleInputName1" placeholder="Name" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectName">Role</label>
                                    <select class="form-control" name="role" id="selectName">
                                        <option disabled>Select Role</option>
                                        @foreach ($roles as $r)
                                            <option value="{{ $r->role }}" {{ $users->role == $r->role ? 'selected' : '' }}>
                                                {{ $r->role }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
