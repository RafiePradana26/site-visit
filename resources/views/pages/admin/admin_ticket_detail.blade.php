@extends('layouts.auth')
<style>
    .dataTables_filter {
        display: none;
    }
</style>

<head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h2 class="page-title text-center">
                    <a href="javascript:history.back()" class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-arrow-left"></i>
                    </a>
                    {{ $ticket->ticket_id }} | {{ $ticket->name_user }} |
                    {{ !empty($ticket->name_tech) ? $ticket->name_tech : 'No Technical Person Yet' }}
                    | @if ($ticket->user->is_premium)
                        <label class="badge badge-warning" style="color: black">{{ 'Premium' }}</label>
                    @else
                        {{ 'Not Premium' }}
                    @endif
                </h2>
            </div>
            <div class="row">
                <div class="col-6 grid-margin stretch-card ">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="exampleInputName1">Subject</label>
                                    <input type="text" class="form-control" value="{{ $ticket->subject }}"
                                        id="exampleInputName1" placeholder="subject" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Description</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="4" readonly>{{ $ticket->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectProduct">Product</label>
                                    <select class="form-control" id="exampleSelectProduct" disabled>
                                        <option disabled selected>select product type</option>
                                        <option value="0" {{ $ticket->product == 0 ? 'selected' : '' }}>Tableau Server
                                        </option>
                                        <option value="1" {{ $ticket->product == 1 ? 'selected' : '' }}>Tableau Online
                                        </option>
                                        <option value="2" {{ $ticket->product == 2 ? 'selected' : '' }}>Tableau Desktop
                                        </option>
                                        <option value="3" {{ $ticket->product == 3 ? 'selected' : '' }}>Tableau Prep
                                            Builder</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Email address</label>
                                    <input type="email" value="{{ $ticket->email }}" class="form-control"
                                        id="exampleInputEmail3" placeholder="Email" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputTelp">Telephone</label>
                                    <input type="number_format" value="{{ $ticket->phone }}" class="form-control"
                                        id="exampleInputTelp" placeholder="08xxxxx" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Complained date</label>
                                    <input type="date" value="{{ $ticket->created_at->format('Y-m-d') }}"
                                        class="form-control" id="exampleInputName1" placeholder="date" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6 grid-margin stretch-card ">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ticket {{ $ticket->ticket_id }}</h4>
                            <p class="card-description">Select Technical person to solve this ticket</p>
                            <div class="d-flex justify-content-end mb-3">
                                <div class="col-12">
                                    <input type="text" id="search-assigned" class="form-control"
                                        placeholder="Type to search...">
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="assignedTable" class="table table-striped" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th> Name </th>
                                            <th> Case Total </th>
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @include('partials.table_user_tech')
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    <script>
        function refreshAssignedTable(ticketId, search) {
            $.ajax({
                url: `/refresh-assigned-table/${ticketId}`,
                method: "GET",
                data: {
                    search: search,
                }, // Pass search value to the server
                success: function(data) {
                    $("#assignedTable tbody").html(data.html); // Use tbody selector
                    $('#assignedTable').DataTable(); // Reinitialize DataTable
                },
                error: function(xhr, status, error) {
                    console.error("Error refreshing assigned table: " + error);
                }
            });
        }

        setInterval(function() {
            if (searchValue === '') {
                refreshAssignedTable({{ $ticket->id }}, searchValue);
            }
        }, 10000);
    </script>

    @section('scripts')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script>
            $(document).ready(function() {
                // Initialize DataTable
                var table = $('#assignedTable').DataTable();

                // Add search functionality
                $('#search-assigned').on('input', function() {
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
                            refreshTable("assignedTable", "{{ route('refresh.table_user_tech') }}",
                                searchValue);
                        }, 10000);
                    }
                });

                // Initial refresh
                refreshTable("assignedTable", "{{ route('refresh.table_user_tech') }}", searchValue);
            });
        </script>
    @endsection
