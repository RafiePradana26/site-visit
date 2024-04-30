<!DOCTYPE html>
<html lang="en">
@extends('layouts.auth')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <a href="/site-visit-all " class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-arrow-left"></i>
                    </a>
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
                                    <input type="text" class="form-control" id="name"
                                        value="{{ $siteVisits->name }}" readonly>
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
                                    <label for="signature">User's Signature</label><br>
                                    <img src="{{ $siteVisits->sign_photo }}" alt="Signature" style="max-width: 200px;">
                                </div>
                                <div class="form-group">
                                    <label for="signature">User's Signature</label><br>
                                    <img src="{{ $siteVisits->sign_photo_cleint }}" alt="Signature"
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
            </div>
        @endsection
