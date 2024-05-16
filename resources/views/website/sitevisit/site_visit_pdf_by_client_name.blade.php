@extends('layouts.auth')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    Export Site Visit to PDF by Client
                </h3>
                <nav aria-label="breadcrumb">
                    <!-- Breadcrumb navigation, if needed -->
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('exportByClient.pdf') }}" method="get">
                                <div class="form-group">
                                    <label for="client_name">Client Name</label>
                                    <select class="form-control" id="client_name" name="client_name">
                                        <option disabled selected value="">Select client</option>
                                        @foreach ($siteVisits as $visit)
                                            <option value="{{ $visit->clientName }}">{{ $visit->clientName }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="start_date">Start Date </label>
                                    <input type="date" class="form-control" id="start_date" name="start_date">
                                </div>
                                <div class="form-group">
                                    <label for="end_date">End Date </label>
                                    <input type="date" class="form-control" id="end_date" name="end_date">
                                </div>
                                <button type="submit" class="btn btn-primary">Export to PDF</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
