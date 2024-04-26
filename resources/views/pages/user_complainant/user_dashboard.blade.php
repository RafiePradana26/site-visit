@extends('layouts.user')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    New Ticket
                </h3>
                <nav aria-label="breadcrumb">
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" action="{{ route('dashboard-user.store') }}" method="post">
                                @csrf
                            
                                <div class="form-group">
                                    <label for="exampleInputName1">Complainant Name</label>
                                    <input type="text" class="form-control @error('name_user') is-invalid @enderror" id="exampleInputName1"
                                        name="name_user" placeholder="Name" value="{{ old('name_user') }}" required>
                                    @error('name_user')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Email address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail3"
                                        name="email" placeholder="Email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="form-group">
                                    <label for="exampleInputName1">Complained date</label>
                                    <input type="date" class="form-control @error('complained_date') is-invalid @enderror" id="exampleInputName1"
                                        name="complained_date" value="{{ old('complained_date', now()->format('Y-m-d')) }}" required readonly>
                                    @error('complained_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="form-group">
                                    <label for="exampleInputName1">Subject</label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" id="exampleInputName1"
                                        name="subject" placeholder="subject" value="{{ old('subject') }}" required>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="form-group">
                                    <label for="exampleTextarea1">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="exampleTextarea1" name="description"
                                        rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="form-group">
                                    <label for="exampleSelectProduct">Product</label>
                                    <select class="form-control @error('product') is-invalid @enderror" id="exampleSelectProduct" name="product"
                                        required>
                                        <option disabled selected>Select product type</option>
                                        <option value="0" @if(old('product') == '0') selected @endif>Tableau Server</option>
                                        <option value="1" @if(old('product') == '1') selected @endif>Tableau Online</option>
                                        <option value="2" @if(old('product') == '2') selected @endif>Tableau Desktop</option>
                                        <option value="3" @if(old('product') == '3') selected @endif>Tableau Prep Builder</option>
                                    </select>
                                    @error('product')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div class="form-group">
                                    <label for="exampleInputTelp">Telephone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="exampleInputTelp" name="phone"
                                        placeholder="08xxxxx" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>                            
                        </div>
                    </div>
                </div>
                {{-- <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    </span> User Dashboard
                </h3>
            </div>
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">My History Tickets
                                <button type="button"
                                    class="btn btn-sm btn-primary mdi mdi-plus mdi-18px float-end text-center "
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    New Ticket
                                </button>
                            </h4>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> Tech Person </th>
                                            <th> Subject </th>
                                            <th> Status </th>
                                            <th> Last Update </th>
                                            <th> Tracking ID </th>
                                            <th> Detail Ticket </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/auth/images/faces/face1.jpg') }}" class="me-2"
                                                    alt="image">
                                                Davcccccc
                                            </td>
                                            <td> Fund is not recieved </td>
                                            <td>
                                                <label class="badge badge-gradient-success">DONE</label>
                                            </td>
                                            <td> Dec 5, 2017 </td>
                                            <td> WD-12345 </td>
                                            <td>
                                                <a href="{{ route('detail_ticket_user') }}"
                                                    class="btn btn-info mdi mdi-information-variant">
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/auth/images/faces/face2.jpg') }}" class="me-2"
                                                    alt="image">
                                                Stella Johnson
                                            </td>
                                            <td> High loading time </td>
                                            <td>
                                                <label class="badge badge-gradient-warning">PROGRESS</label>
                                            </td>
                                            <td> Dec 12, 2017 </td>
                                            <td> WD-12346 </td>
                                            <td>
                                                <a href="{{ route('detail_ticket_user') }}"
                                                    class="btn btn-info mdi mdi-information-variant">
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/auth/images/faces/face3.jpg') }}" class="me-2"
                                                    alt="image">
                                                Marina Michel
                                            </td>
                                            <td> Website down for one week </td>
                                            <td>
                                                <label class="badge badge-gradient-info">ON HOLD</label>
                                            </td>
                                            <td> Dec 16, 2017 </td>
                                            <td> WD-12347 </td>
                                            <td>
                                                <a href="{{ route('detail_ticket_user') }}"
                                                    class="btn btn-info mdi mdi-information-variant">
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <img src="{{ asset('assets/auth/images/faces/face4.jpg') }}" class="me-2"
                                                    alt="image"> John
                                                Doe
                                            </td>
                                            <td> Loosing control on server </td>
                                            <td>
                                                <label class="badge badge-gradient-danger">REJECTED</label>
                                            </td>
                                            <td> Dec 3, 2017 </td>
                                            <td> WD-12348 </td>
                                            <td>
                                                <a href="{{ route('detail_ticket_user') }}"
                                                    class="btn btn-info mdi mdi-information-variant">
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Ticket Form</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <div class="col-12 grid-margin stretch-card ">
                            <div class="card">
                                <div class="card-body">
                                    <form class="forms-sample">
                                        <div class="form-group">
                                            <label for="exampleInputName1">Subject</label>
                                            <input type="text" class="form-control" id="exampleInputName1"
                                                placeholder="subject">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleTextarea1">Description</label>
                                            <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelectProduct">Product</label>
                                            <select class="form-control" id="exampleSelectProduct">
                                                <option disabled selected>select product type</option>
                                                <option>Tableau Server</option>
                                                <option>Tableau Online</option>
                                                <option>Tableau Desktop</option>
                                                <option>Tableau Prep Builder</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail3">Email address</label>
                                            <input type="email" class="form-control" id="exampleInputEmail3"
                                                placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputTelp">Telephone</label>
                                            <input type="number_format" class="form-control" id="exampleInputTelp"
                                                placeholder="08xxxxx">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputName1">Complained date</label>
                                            <input type="date" class="form-control" id="exampleInputName1"
                                                placeholder="date">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> --}}
                @if (session('newTicketInfo'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Show SweetAlert when the page is loaded
                            const sweetAlert = Swal.fire({
                                icon: 'success',
                                title: 'Ticket submitted successfully!',
                                html: `
                        <p>Ticket ID: {{ session('newTicketInfo')['ticket_id'] }}</p>
                        <p>Name: {{ session('newTicketInfo')['name_user'] }}</p>
                        <p>Email: {{ session('newTicketInfo')['email'] }}</p>
                        <p>Password: {{ session('newTicketInfo')['password'] }}</p>
                        <h5 id="goToLogin" class="btn btn-link"> <b> Click here to go to the Login Page</h5>
                    `,
                                showCancelButton: false,
                                confirmButtonText: 'Close',
                                closeOnClickOutside: false, // Do not close on click outside the alert
                                allowOutsideClick: false, // Do not allow clicking outside the alert to close it
                                reverseButtons: true, // Reverse the order of buttons (confirm/cancel)
                            });

                            // Add a click event listener to the specific text element
                            const goToLoginText = document.getElementById('goToLogin');
                            if (goToLoginText) {
                                goToLoginText.addEventListener('click', function() {
                                    // Open the login page in a new tab using window.open()
                                    window.open('{{ route('login') }}');
                                });
                            }
                        });
                    </script>
                @endif
                @if (session('error'))
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: '{{ session('error') }}',
                        });
                    </script>
                @endif
            @endsection
