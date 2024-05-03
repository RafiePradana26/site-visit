<!DOCTYPE html>
<html lang="en">
@extends('layouts.user')
<meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
</head>

<style>
    #sign_photo {
        border: 2px dotted #CCCCCC;
        border-radius: 15px;
        cursor: crosshair;
    }

    #sign_photo_client {
        border: 2px dotted #CCCCCC;
        border-radius: 15px;
        cursor: crosshair;
    }
</style>

@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    Form Site Visit
                </h3>
                <nav aria-label="breadcrumb">
                    <!-- Breadcrumb navigation, if needed -->
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" id="submitSiteVisit" action="{{ route('site-visit.store') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label for="exampleInputName1">Name</label>
                                    <input type="text" class="form-control" id="" placeholder="Input Name"
                                        name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Email Address</label>
                                    <input type="text" class="form-control" id=""
                                        placeholder="Input email address" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Location</label>
                                    <input type="text" class="form-control" id="" placeholder="Input Name"
                                        name="location" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Customer/client name</label>
                                    <input type="text" class="form-control" id=""
                                        placeholder="Input customer/client name" name="clientName" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Purpose of visit</label>
                                    <input type="text" class="form-control" id=""
                                        placeholder="Input purpose of visit" name="purpose" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Upload Photo</label>
                                    <input type="file" class="form-control" name="visit_photo" accept="image/*,video/*"
                                        required>
                                </div>
                                <!-- Tambahkan area tanda tangan -->
                                <div class="form-group">
                                    <label>User Signature</label>
                                    <canvas id="sign_photo" width="200" height="100"></canvas>
                                    <button type="button" class="btn btn-default" id="sig-clearBtn">Clear
                                        Signature</button>
                                </div>
                                <!-- Hidden input to store signature data URL -->
                                <input type="hidden" id="sign_photo_input" name="sign_photo">
                                <div class="form-group">
                                    <label>Client Signature</label>
                                    <canvas id="sign_photo_client" width="200" height="100"></canvas>
                                    <button type="button" class="btn btn-default" id="sig-clearBtn_client">Clear
                                        Signature</button>
                                </div>
                                <!-- Hidden input to store signature data URL -->
                                <input type="hidden" id="sign_photo_input_client" name="sign_photo_client">
                                <div class="form-group">
                                    <label for="exampleInputName1">Tanggal Submit</label>
                                    <input type="date" class="form-control" id="exampleInputName1" name="created_at"
                                        placeholder="date" required value="{{ now()->format('Y-m-d') }}" readonly>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function isCanvasEmpty(canvas) {
                const ctx = canvas.getContext('2d');
                const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height).data;
                return !Array.from(imageData).some(color => color !== 0);
            }

            // Pada form submit, simpan data tanda tangan dan submit formulir jika tanda tangan sudah diisi
            document.getElementById("submitSiteVisit").addEventListener("submit", function(e) {
                e.preventDefault(); // Menghentikan pengiriman formulir

                // Memeriksa apakah kedua tanda tangan sudah diisi
                const userSignatureCanvas = document.getElementById("sign_photo");
                const clientSignatureCanvas = document.getElementById("sign_photo_client");
                if (!isCanvasEmpty(userSignatureCanvas) && !isCanvasEmpty(clientSignatureCanvas)) {
                    // Tanda tangan sudah diisi, simpan datanya dan submit formulir
                    var userSignature = userSignatureCanvas.toDataURL();
                    document.getElementById("sign_photo_input").value = userSignature;

                    var clientSignature = clientSignatureCanvas.toDataURL();
                    document.getElementById("sign_photo_input_client").value = clientSignature;

                    this.submit(); // Submit the form
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please fill in both signatures before submitting the form.',
                    });
                }
            });

            // document.getElementById("submitSiteVisit").addEventListener("touchstart", function(e) {
            //     e.preventDefault();
            // }, false);
            // document.getElementById("submitSiteVisit").addEventListener("touchend", function(e) {
            //     e.preventDefault();
            // }, false);
            document.getElementById("submitSiteVisit").addEventListener("touchmove", function(e) {
                e.preventDefault();
            }, false);

            // Tambahkan kode JavaScript untuk tanda tangan
            window.requestAnimFrame = (function(callback) {
                return window.requestAnimationFrame ||
                    window.webkitRequestAnimationFrame ||
                    window.mozRequestAnimationFrame ||
                    window.oRequestAnimationFrame ||
                    window.msRequestAnimaitonFrame ||
                    function(callback) {
                        window.setTimeout(callback, 1000 / 60);
                    };
            })();

            var canvas = document.getElementById("sign_photo");
            var ctx = canvas.getContext("2d");
            ctx.strokeStyle = "#222222";
            ctx.lineWidth = 4;

            var drawing = false;
            var mousePos = {
                x: 0,
                y: 0
            };
            var lastPos = mousePos;

            canvas.addEventListener("mousedown", function(e) {
                drawing = true;
                lastPos = getMousePos(canvas, e);
            }, false);

            canvas.addEventListener("mouseup", function(e) {
                drawing = false;
            }, false);

            canvas.addEventListener("mousemove", function(e) {
                mousePos = getMousePos(canvas, e);
            }, false);

            // Add touch event support for mobile
            canvas.addEventListener("touchstart", function(e) {

            }, false);

            canvas.addEventListener("touchmove", function(e) {
                var touch = e.touches[0];
                var me = new MouseEvent("mousemove", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(me);
            }, false);

            canvas.addEventListener("touchstart", function(e) {
                mousePos = getTouchPos(canvas, e);
                var touch = e.touches[0];
                var me = new MouseEvent("mousedown", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas.dispatchEvent(me);
            }, false);

            canvas.addEventListener("touchend", function(e) {
                var me = new MouseEvent("mouseup", {});
                canvas.dispatchEvent(me);
            }, false);

            function getMousePos(canvasDom, mouseEvent) {
                var rect = canvasDom.getBoundingClientRect();
                return {
                    x: mouseEvent.clientX - rect.left,
                    y: mouseEvent.clientY - rect.top
                }
            }

            function getTouchPos(canvasDom, touchEvent) {
                var rect = canvasDom.getBoundingClientRect();
                return {
                    x: touchEvent.touches[0].clientX - rect.left,
                    y: touchEvent.touches[0].clientY - rect.top
                }
            }

            function renderCanvas() {
                if (drawing) {
                    ctx.moveTo(lastPos.x, lastPos.y);
                    ctx.lineTo(mousePos.x, mousePos.y);
                    ctx.stroke();
                    lastPos = mousePos;
                }
            }

            // Prevent scrolling when touching the canvas
            document.body.addEventListener("touchstart", function(e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            }, false);
            document.body.addEventListener("touchend", function(e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            }, false);
            document.body.addEventListener("touchmove", function(e) {
                if (e.target == canvas) {
                    e.preventDefault();
                }
            }, false);

            (function drawLoop() {
                requestAnimFrame(drawLoop);
                renderCanvas();
            })();

            function clearCanvas() {
                canvas.width = canvas.width;
            }

            // Set up the UI
            var sigText = document.getElementById("sig-dataUrl");
            var sigImage = document.getElementById("sig-image");
            var clearBtn = document.getElementById("sig-clearBtn");
            var submitBtn = document.getElementById("sig-submitBtn");
            clearBtn.addEventListener("click", function(e) {
                clearCanvas();
            }, false);
            clearBtn.addEventListener("touchstart", function(e) {
                clearCanvas();
            }, false);

            // Tambahkan kode JavaScript untuk tanda tangan client
            var canvas_client = document.getElementById("sign_photo_client");
            var ctx_client = canvas_client.getContext("2d");
            ctx_client.strokeStyle = "#222222";
            ctx_client.lineWidth = 4;

            var drawing_client = false;
            var mousePos_client = {
                x: 0,
                y: 0
            };
            var lastPos_client = mousePos_client;

            canvas_client.addEventListener("mousedown", function(e) {
                drawing_client = true;
                lastPos_client = getMousePos(canvas_client, e);
            }, false);

            canvas_client.addEventListener("mouseup", function(e) {
                drawing_client = false;
            }, false);

            canvas_client.addEventListener("mousemove", function(e) {
                if (drawing_client) {
                    mousePos_client = getMousePos(canvas_client, e);
                    renderCanvas_client();
                }
            }, false);

            canvas_client.addEventListener("touchstart", function(e) {
                drawing_client = true;
                mousePos_client = getTouchPos(canvas_client, e);
                var touch = e.touches[0];
                var me = new MouseEvent("mousedown", {
                    clientX: touch.clientX,
                    clientY: touch.clientY
                });
                canvas_client.dispatchEvent(me);
            }, false);

            canvas_client.addEventListener("touchend", function(e) {
                drawing_client = false;
            }, false);

            canvas_client.addEventListener("touchmove", function(e) {
                if (drawing_client) {
                    var touch = e.touches[0];
                    var me = new MouseEvent("mousemove", {
                        clientX: touch.clientX,
                        clientY: touch.clientY
                    });
                    canvas_client.dispatchEvent(me);
                }
            }, false);


            canvas_client.addEventListener("touchend", function(e) {
                var me = new MouseEvent("mouseup", {});
                canvas_client.dispatchEvent(me);
            }, false);

            function renderCanvas_client() {
                if (drawing_client) {
                    ctx_client.moveTo(lastPos_client.x, lastPos_client.y);
                    ctx_client.lineTo(mousePos_client.x, mousePos_client.y);
                    ctx_client.stroke();
                    lastPos_client = mousePos_client;
                }
            }

            function clearCanvas_client() {
                canvas_client.width = canvas_client.width;
            }

            var clearBtn_client = document.getElementById("sig-clearBtn_client");
            clearBtn_client.addEventListener("click", function(e) {
                clearCanvas_client();
            }, false);
            clearBtn_client.addEventListener("touchstart", function(e) {
                clearCanvas_client();
            }, false);
        </script>
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Site visit data has been successfully stored!',
                    icon: 'success'
                }).then(function() {
                    window.location.href = '{{ route('website.sitevisit') }}';
                });
            });
        </script>
    @endif
