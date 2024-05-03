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
                                    <a href="{{ route('export.pdf') }}" class="btn btn-primary">Export to PDF</a>
                                </div>
                                <table id="siteVisitTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Location</th>
                                            <th>Client name</th>
                                            <th>Purpose of Visit</th>
                                            <th>Date of visit</th>
                                            <th>Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody id="siteVisitTableBody">
                                        @foreach ($siteVisits as $siteVisits)
                                            <tr>
                                                <td>{{ $siteVisits->name }}</td>
                                                <td>{{ $siteVisits->email }}</td>
                                                <td>{{ $siteVisits->location }}</td>
                                                <td>{{ $siteVisits->clientName }}</td>
                                                <td>{{ $siteVisits->purpose }}</td>
                                                <td>{{ $siteVisits->date_visit }}</td>
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
