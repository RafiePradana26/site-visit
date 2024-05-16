@extends('layouts.auth')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header d-flex justify-content-between align-items-center mb-5">
                                <h4 class="card-title mb-0">Site Visit</h4>
                                <div class="d-flex">
                                </div>
                            </div>
                            <div class="">
                                <div class="mb-3">
                                    <a href="{{ route('export.pdf') }}" class="btn btn-primary">Export All to PDF</a>
                                </div>
                                {{-- <form action="{{ route('exportByClient.pdf') }}" method="get">
                                    <div class="form-group">
                                        <label for="client_name">Client Name:</label>
                                        <input type="text" class="form-control" id="client_name" name="client_name" placeholder="Enter client name">
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">Start Date:</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date">
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">End Date:</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Export PDF</button>
                                </form> --}}
                                <table id="siteVisitTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            {{-- <th>Email</th> --}}
                                            <th>Location</th>
                                            <th>Client name</th>
                                            {{-- <th>Purpose of Visit</th> --}}
                                            <th>Date of visit</th>
                                            <th>Submit date</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody id="siteVisitTableBody">
                                        @foreach ($siteVisits as $siteVisits)
                                            <tr>
                                                <td>{{ $siteVisits->name }}</td>
                                                {{-- <td>{{ $siteVisits->email }}</td> --}}
                                                <td>{{ $siteVisits->location }}</td>
                                                <td>{{ $siteVisits->clientName }}</td>
                                                {{-- <td>{{ $siteVisits->purpose }}</td>                                      --}}
                                                <td>{{ $siteVisits->date_visit }}</td>
                                                <td>{{$siteVisits->created_at}}</td>
                                                <td>
                                                    <a href="{{ route('detail.sitevisit', ['id' => $siteVisits->id]) }}"
                                                        class="btn btn-primary">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection



    @section('scripts')
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(document).ready(function() {
                var table = $('#siteVisitTable').DataTable({
                    stateSave: true
                });
            });
        </script>
    @endsection
