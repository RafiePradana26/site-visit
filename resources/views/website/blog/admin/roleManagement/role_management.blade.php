@extends('layouts.auth')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">                
            </div>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body ">
                            <div class="card-header d-flex justify-content-between align-items-center mb-5">
                                <h4 class="card-title mb-0">Role Management Page</h4>
                                <div class="d-flex">
                                    <a href="{{ route('editrms') }}" class="btn btn-sm btn-primary ms-2">
                                        <span class="mdi mdi-plus mdi-18px me-1"></span>
                                        New Submit
                                    </a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="roleManagementTable" class="table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th> Role </th>
                                            <th> Akses Halaman </th>
                                            <th> Button </th>
                                        </tr>
                                    </thead>
                                    @foreach ($roles as $u)
                                        <tr>
                                            <td>{{ $u->role }}</td>
                                            <td>{{ $u->akses_halaman }}</td>
                                            <td>
                                                <a href="{{ route('showRoleManagementDetail', ['id' => $u->id]) }}"
                                                    class="btn btn-info bg-gradient-info">
                                                    <span class="mdi mdi-details"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
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
                var table = $('#roleManagementTable').DataTable(); // Inisialisasi DataTable                
            });
        </script>
    @endsection
