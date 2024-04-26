@extends('layouts.auth')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <a href="/my_ticket" class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-arrow-left"></i>
                    </a>
                    New Ticket
                </h3>
                <nav aria-label="breadcrumb">
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" id="submitNewTicketForm" action="{{ route('submit_ticket') }}"
                                method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">Complainant Name</label>
                                    <input type="text" value="{{ $user->name }}" class="form-control"
                                        id="exampleInputName1" placeholder="Name" name="name_user" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail3">Email address</label>
                                    <input type="email" value="{{ $user->email }}" class="form-control"
                                        id="exampleInputEmail3" name="email" placeholder="Email" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Complained date</label>
                                    <input type="date" class="form-control" id="exampleInputName1" name="complained_date"
                                        placeholder="date" required value="{{ now()->format('Y-m-d') }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Subject</label>
                                    <input type="text" class="form-control" id="exampleInputSubject"
                                        placeholder="Subject" name="subject" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Description</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="4" name="description" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectProduct">Product</label>
                                    <select class="form-control" id="exampleSelectProduct" name="product" required>
                                        <option disabled selected>Select product type</option>
                                        <option value="0">Tableau Server</option>
                                        <option value="1">Tableau Online</option>
                                        <option value="2">Tableau Desktop</option>
                                        <option value="3">Tableau Prep Builder</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Telephone</label>
                                    <input type="text" value="{{ $user->phone }}" class="form-control"
                                        id="exampleInputSubject" name="phone" readonly>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                @if (session('newTicketInfoUser'))
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Show SweetAlert when the page is loaded
                            const sweetAlert = Swal.fire({
                                icon: 'success',
                                title: 'Ticket submitted successfully!',
                                html: `
                        <p>Ticket ID: {{ session('newTicketInfoUser')['ticket_id'] }}</p>
                        <p>Name: {{ session('newTicketInfoUser')['name_user'] }}</p>
                        <p>Email: {{ session('newTicketInfoUser')['email'] }}</p>                        
                    `,
                            });
                        });
                    </script>
                @endif
            @endsection
