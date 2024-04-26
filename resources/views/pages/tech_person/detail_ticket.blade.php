@extends('layouts.auth')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h2 class="page-title">
                    <a href="/dashboard-tech" class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-arrow-left"></i>
                    </a>
                    Ticket Details
                </h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"> Tech Person </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Ticket</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-8 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title">{{ $ticket->name_user }} | {{ $ticket->ticket_id }} |
                                <p class="card-description badge badge- text-black">
                                    @switch($ticket->status)
                                        @case('Open')
                                            <label class="badge badge-info">Open</label>
                                        @break

                                        @case('Progress')
                                            <label class="badge badge-warning">Progress</label>
                                        @break

                                        @case('Pending')
                                            <label class="badge badge-danger">Pending</label>
                                        @break

                                        @case('Solved')
                                            <label class="badge badge-success">Solved</label>
                                        @break

                                        @case('onhold')
                                            <label class="badge badge-danger">On Hold</label>
                                        @break

                                        @default
                                            <label class="badge badge-secondary">Unknown</label>
                                    @endswitch
                                </p>
                                |
                                @if ($ticket->user->is_premium)
                                    <label class="badge badge-warning" style="color: black" >{{ 'Premium' }}</label>
                                @else
                                    {{ 'Not Premium' }}
                                @endif
                            </h2>
                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="exampleInputName1">Complainant Name</label>
                                    <input type="text" value="{{ $ticket->name_user }}" class="form-control"
                                        id="exampleInputName1" placeholder="Name" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Subject</label>
                                    <input type="text" value="{{ $ticket->subject }}" class="form-control"
                                        id="exampleInputSubject" placeholder="Subject" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Description</label>
                                    <textarea class="form-control" id="exampleTextarea1" rows="4" readonly> {{ $ticket->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleSelectProduct">Product</label>
                                    <select class="form-control" id="exampleSelectProduct" disabled>
                                        <option disabled selected>select product type</option>
                                        <option value="0" {{ $ticket->product == 0 ? 'selected' : '' }}>Tableau Server
                                        </option>
                                        <option value="1" {{ $ticket->product == 1 ? 'selected' : '' }}>Tableau Online
                                        </option>
                                        <option value="2" {{ $ticket->product == 2 ? 'selected' : '' }}>Tableau
                                            Desktop
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
                                    <label for="exampleInputName1">Telephone</label>
                                    <input type="text" value="{{ $ticket->phone }}" class="form-control"
                                        id="exampleInputSubject" placeholder="Telephone" readonly>
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
                <div class="col-4 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Ticket</h4>
                            <p class="card-description">How was the ticket that you handling?</p>
                            <form action="{{ route('update.ticket.status', ['ticket' => $ticket->id]) }}" method="post"
                                id="updateTicketForm">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="exampleSelectStatus">Status</label>
                                    <select class="form-control" id="exampleSelectStatus" name="status"
                                        onchange="updateSubmitButton(this.value)">
                                        <option selected disabled>select product type</option>
                                        <option value="Pending" {{ $ticket->status == 'Pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="Progress" {{ $ticket->status == 'Progress' ? 'selected' : '' }}>
                                            Progress</option>
                                        <option value="onhold" {{ $ticket->status == 'onhold' ? 'selected' : '' }}>On Hold
                                        </option>
                                        <option value="Solved" {{ $ticket->status == 'Solved' ? 'selected' : '' }}>Solved
                                        </option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary" id="submitButton"
                                    {{ $ticket->status == 'Solved' ? 'disabled' : '' }}>
                                    Submit
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Message </h3>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $ticket->name_user }}</h4>
                            <p class="card-description">Ticket {{ $ticket->ticket_id }}</p>
                            <button id="refresh-button" name="refresh_button" class="btn btn-primary"
                                onclick="refreshChat()" hidden>Refresh
                                Chat</button>


                            <head>
                                <title>Chat Box UI Design</title>
                                <link rel="stylesheet" href="styles.css" />
                                <link rel="stylesheet"
                                    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" />
                                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                            </head>

                            <body>
                                <div class="container">
                                    <div class="msg-header float-end">
                                    </div>
                                    <div class="chat-page">
                                        <div class="msg-inbox">
                                            <div class="chats" id="message-container"
                                                style="max-height: 300px; overflow-y: auto;">
                                                <!-- Loop through messages and display them -->
                                                @foreach ($messages as $message)
                                                    <div class="msg-page">
                                                        <div
                                                            class="{{ $message->sender_id === auth()->user()->id ? 'outgoing-chats' : 'received-chats' }}">
                                                            <div
                                                                class="{{ $message->sender_id === auth()->user()->id ? 'outgoing-msg' : 'received-msg' }}">
                                                                <div
                                                                    class="{{ $message->sender_id === auth()->user()->id ? 'outgoing-chats-msg' : 'received-msg-inbox' }}">
                                                                    <p>{{ $message->message }}</p>
                                                                    {{-- <span class="time">{{ formatTime($message->created_at) }}</span> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <!-- msg-bottom section -->
                                            <div class="msg-bottom">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="message-input"
                                                        placeholder="Write message..." />
                                                    <span class="input-group-text send-icon" onclick="sendMessage()">
                                                        <i class="bi bi-send"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </body>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        * {
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        /* Styling the main container */
        .container {
            width: 80%;
            margin: auto;
            margin-top: 2rem;
            letter-spacing: 0.5px;
            height: 80%;
        }

        img {
            width: 50px;
            vertical-align: middle;
            border-style: none;
            border-radius: 100%;
        }

        /* Styling the msg-header container */
        .msg-header {
            border: 1px solid #ccc;
            width: 100%;
            height: 10%;
            border-bottom: none;
            display: inline-block;
            background-color: #efefef;
            margin: 0;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        /* Styling the profile picture */
        .msgimg {
            margin-left: 2%;
            float: left;
        }

        .container1 {
            width: 270px;
            height: auto;
            float: left;
            margin: 0;
        }

        /* styling user-name */
        .active {
            width: 150px;
            float: left;
            color: black;
            font-weight: bold;
            margin: 0 0 0 5px;
            height: 10%;

        }

        /* Styling the inbox */
        .chat-page {
            padding: 0 0 50px 0;
        }

        .msg-inbox {
            border: 1px solid #ccc;
            overflow: hidden;
            border-bottom-left-radius: 20px;
            border-bottom-right-radius: 20px;
        }


        .chats {
            padding: 30px 15px 0 25px;
        }

        .msg-page {
            max-height: 500px;
            overflow-y: auto;
        }

        /* Styling the msg-bottom container */
        .msg-bottom {
            border-top: 1px solid #ccc;
            position: relative;
            height: 11%;
            background-color: rgb(239 239 239);
        }

        /* Styling the input field */
        .input-group {
            float: right;
            margin-top: 13px;
            margin-right: 20px;
            outline: none !important;
            border-radius: 20px;
            width: 61% !important;
            background-color: #fff;
            position: relative;
            display: flex;
            flex-wrap: wrap;
            align-items: stretch;
        }

        .input-group>.form-control {
            position: relative;
            flex: 1 1 auto;
            width: 1%;
            margin-bottom: 0;
        }

        .form-control {
            border: none !important;
            border-radius: 20px !important;
            display: block;
            height: calc(2.25rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .input-group-text {
            background: transparent !important;
            border: none !important;
            display: flex;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0;
            font-size: 1.5rem;
            font-weight: b;
            line-height: 1.5;
            color: #495057;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            font-weight: bold !important;
            cursor: pointer;
        }

        input:focus {
            outline: none;
            border: none !important;
            box-shadow: none !important;
        }

        .send-icon {
            font-weight: bold !important;
        }

        /* Styling the avatar  */
        received-chats-img {
            display: inline-block;
            width: 50px;
            float: left;
        }

        .received-msg {
            display: inline-block;
            padding: 0 0 0 10px;
            vertical-align: top;
            width: 92%;
        }

        .received-msg-inbox {
            width: 57%;
        }

        .received-msg-inbox p {
            background: #efefef none repeat scroll 0 0;
            border-radius: 10px;
            color: #646464;
            font-size: 14px;
            margin-left: 1rem;
            padding: 1rem;
            width: 100%;
            box-shadow: rgb(0 0 0 / 25%) 0px 5px 5px 2px;
        }

        p {
            overflow-wrap: break-word;
        }

        /* Styling the msg-sent time  */
        .time {
            color: #777;
            display: block;
            font-size: 12px;
            margin: 8px 0 0;
        }

        .outgoing-chats {
            overflow: hidden;
            margin: 26px 20px;
        }

        .outgoing-chats-msg p {
            background-color: #3a12ff;
            background-image: linear-gradient(45deg, #ee087f 0%, #DD2A7B 25%, #9858ac 50%, #8134AF 75%, #515BD4 100%);
            color: #fff;
            border-radius: 10px;
            font-size: 14px;
            color: #fff;
            padding: 5px 10px 5px 12px;
            width: 100%;
            padding: 1rem;
            box-shadow: rgb(0 0 0 / 25%) 0px 2px 5px 2px;
        }

        .outgoing-chats-msg {
            float: right;
            width: 46%;
        }

        /* Styling the avatar */
        .outgoing-chats-img {
            display: inline-block;
            width: 50px;
            float: right;
            margin-right: 1rem;
        }

        @media only screen and (max-device-width: 850px) {

            *,
            .time {
                font-size: 28px;
            }

            img {
                width: 65px;
            }

            .msg-header {
                height: 5%;
            }

            .msg-page {
                max-height: none;
            }

            .received-msg-inbox p {
                font-size: 28px;
            }

            .outgoing-chats-msg p {
                font-size: 28px;
            }
        }

        @media only screen and (max-device-width: 450px) {

            *,
            .time {
                font-size: 28px;
            }

            img {
                width: 65px;
            }

            .msg-header {
                height: 5%;
            }

            .msg-page {
                max-height: none;
            }

            .received-msg-inbox p {
                font-size: 28px;
            }

            .outgoing-chats-msg p {
                font-size: 28px;
            }
        }
    </style>
    {{-- <script>
    function updateSubmitButton(selectedStatus) {
        var submitButton = document.getElementById('submitButton');
        submitButton.disabled = selectedStatus === 'Solved';
    }
</script> --}}

    <script>
        const authUserId = {{ auth()->user()->id }};
        let ticketId = {{ $ticket->id }}; // Initial ticket ID

        // Function to load messages
        function loadMessages(ticketId) {
            $.ajax({
                url: `/chat/${ticketId}`,
                method: 'GET',
                success: function(data) {
                    const messageContainer = $('#message-container');
                    messageContainer.empty(); // Clear previous messages

                    if (data.messages && Array.isArray(data.messages) && data.messages.length > 0) {
                        // Messages exist, iterate over them
                        data.messages.forEach(message => {
                            const messageHTML = `
                            <div class="msg-page">
                                <div class="${message.sender_id === authUserId ? 'outgoing-chats' : 'received-chats'}">
                                    <div class="${message.sender_id === authUserId ? 'outgoing-msg' : 'received-msg'}">
                                        <div class="${message.sender_id === authUserId ? 'outgoing-chats-msg' : 'received-msg-inbox'}">
                                            <p>${message.message}</p>
                                            <span class="time">${formatTime(message.created_at)}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                            messageContainer.append(messageHTML);
                        });
                    } else {
                        // No messages, display a placeholder message
                        const placeholderHTML = `
                        <div class="msg-page">
                            <div class="info-msg">
                                <p>Let's start a convo!!</p>
                            </div>
                        </div>`;
                        messageContainer.append(placeholderHTML);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading messages:', error);
                },
            });
        }

        // Function to send a message
        function sendMessage() {
            const messageInput = $('#message-input');
            const message = messageInput.val();

            $.ajax({
                url: `/chat/${ticketId}`,
                method: 'POST',
                data: {
                    message: message,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    // Handle success, maybe refresh the message container
                    loadMessages(ticketId);
                    // Clear the input field after sending
                    messageInput.val('');
                },
                error: function(xhr, status, error) {
                    console.error('Error sending message:', error);
                }
            });
        }

        // Helper function to format time
        function formatTime(timestamp) {
            const date = new Date(timestamp);

            // Get day, month, hour, and minute components
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const hour = String(date.getHours()).padStart(2, '0');
            const minute = String(date.getMinutes()).padStart(2, '0');

            // Format as DD/MM hour:minute
            const formattedTime = `${day}/${month} ${hour}:${minute}`;
            return formattedTime;
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Get the reference to the refresh button by name attribute
            var refreshButton = document.querySelector("[name='refresh_button']");

            // Automatically refresh the chat section every 5 seconds
            setInterval(function() {
                // Trigger click on the refresh button
                refreshButton.click();
            }, 5000); // 5 seconds interval

            // Handling of click event
            refreshButton.onclick = function() {
                console.log('Button clicked');
                // Call the loadMessages function here
                loadMessages(ticketId);
            };
        });
    </script>
