@extends('layouts.auth')

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    My Ticket
                </h3>
            </div>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body ">
                            <div class="card-header d-flex justify-content-between align-items-center mb-5">
                                <h4 class="card-title mb-0">History Tickets</h4>
                                <div class="d-flex">
                                    <a href="{{ route('new_ticket', ['user' => Auth::user()->id]) }}"
                                        class="btn btn-sm btn-primary ms-2">
                                        <span class="mdi mdi-plus mdi-18px me-1"></span>
                                        New Ticket
                                    </a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="userTable" class="table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th> Assigned </th>
                                            <th> Subject </th>
                                            <th> Status </th>
                                            <th> Last Update </th>
                                            <th> Tracking ID </th>
                                            <th> Detail </th>
                                        </tr>
                                    </thead>
                                    @include('partials.table_user')
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script>
            var searchValue = '';
            var intervalId = null; // Store interval ID

            function refreshTableUser(tabId, routeName, search) {
                $.ajax({
                    url: routeName,
                    method: "GET",
                    data: {
                        search: search,                    
                    },
                    success: function(data) {
                        // Destroy the existing DataTable instance
                        var table = $("#" + tabId).DataTable();
                        if ($.fn.DataTable.isDataTable("#" + tabId)) {
                            table.clear().destroy();
                        }

                        // Update the table body with the new HTML content
                        $("#" + tabId + " tbody").html(data.html);

                        // Reinitialize DataTable with stateSave option
                        $("#" + tabId).DataTable({
                            "stateSave": true,
                            // Add other DataTable options if needed
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error refreshing table: " + error);
                    }
                });
            }

            setInterval(function() {
                if (searchValue === '') {
                    refreshTableUser("userTable", "{{ route('refresh.table_user') }}", searchValue);
                }
            }, 20000);
        </script>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function() {
                // Initialize DataTable only if it's not already initialized
                if ($.fn.DataTable.isDataTable('#userTable')) {
                    $('#userTable').DataTable().destroy();
                }

                // Initialize DataTable
                var table = $('#userTable').DataTable({
                    "order": [
                        [3, "asc"]
                    ],
                    "stateSave": true
                });


                // Add search functionality
                $('#search-userticket').on('input', function() {
                    searchValue = this.value;
                    table.search(searchValue).draw();

                    // Clear the interval if searchValue is not empty
                    if (searchValue !== '' && intervalId !== null) {
                        clearInterval(intervalId);
                        intervalId = null;
                    }

                    // Start the interval if searchValue is empty and interval is not already running
                    if (searchValue === '' && intervalId === null) {
                        intervalId = setInterval(function() {
                            // Check if DataTable is initialized before refreshing
                            if ($.fn.DataTable.isDataTable('#userTable')) {
                                refreshTableUser("userTable", "{{ route('refresh.table_user') }}",
                                    searchValue);
                            }
                        }, 1000);
                    }
                });

                // Initial refresh
                refreshTableUser("userTable", "{{ route('refresh.table_user') }}", searchValue);
            });
        </script>
    @endsection
