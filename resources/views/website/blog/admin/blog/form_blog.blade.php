<!DOCTYPE html>
<html lang="en">
@extends('layouts.auth')
<meta name="csrf-token" content="{{ csrf_token() }}">

<head>
    <!-- Adjust the path based on your project structure -->
    <script src="{{ asset('tinymce/js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

</head>
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    <a href="/blog" class="page-title-icon bg-gradient-primary text-white me-2">
                        <i class="mdi mdi-arrow-left"></i>
                    </a>
                    Form Blog
                </h3>
                <nav aria-label="breadcrumb">
                    <!-- Breadcrumb navigation, if needed -->
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" id="submitBlog" action="{{ route('blog.submit') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <label for="exampleTextarea1">Input Foto atau Video</label>
                                    <input type="file" class="form-control" name="media_nama" accept="image/*,video/*"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Judul</label>
                                    <input type="text" class="form-control" id="exampleInputSubject"
                                        placeholder="Judul Blog" name="judul" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Tanggal Submit</label>
                                    <input type="date" class="form-control" id="exampleInputName1" name="created_at"
                                        placeholder="date" required value="{{ now()->format('Y-m-d') }}" readonly>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>

                            <!-- TinyMCE initialization script -->
                            <script>
                                tinymce.init({
                                    selector: 'textarea#deskripsi', // Replace 'yourTextareaID' with the ID of your textarea element
                                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss lists number',
                                    toolbar: 'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | removeformat',
                                    menubar: false,
                                    statusbar: false,
                                    height: 400, // Set the height of the editor as needed
                                    branding: false, // Hide the TinyMCE branding
                                    paste_data_images: true,
                                    content_style: 'ul { list-style-type: square; margin-left: 20px; }',
                                    image_title: true,
                                    automatic_uploads: true,
                                    file_picker_types: 'image',
                                    images_upload_url: '/upload', // Replace 'upload.php' with your image upload endpoint
                                    images_upload_credentials: true,
                                    file_picker_callback: function(callback, value, meta) {
                                        var input = document.createElement('input');
                                        input.setAttribute('type', 'file');
                                        input.setAttribute('accept', 'image/*');

                                        input.onchange = function() {
                                            var file = this.files[0];
                                            var reader = new FileReader();
                                            reader.onload = function() {
                                                var id = 'blobid' + (new Date()).getTime();
                                                var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                                                var base64 = reader.result.split(',')[1];
                                                var blobInfo = blobCache.create(id, file, base64);
                                                blobCache.add(blobInfo);
                                                callback(blobInfo.blobUri(), {
                                                    title: file.name
                                                });
                                            };
                                            reader.readAsDataURL(file);
                                        };

                                        input.click();
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Jika gambar tidak berhasil ditampilkan, silahkan ubah / upload ulang pada halaman edit',
                    icon: 'success'
                }).then(function() {
                    window.location.href = '{{ route('blog') }}';
                });
            });
        </script>
    @endif
