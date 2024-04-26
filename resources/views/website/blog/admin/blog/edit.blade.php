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
                    Blog Edit
                </h3>
                <nav aria-label="breadcrumb">
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form class="forms-sample" id="editBlog" action="{{ route('blog.edit.submit', $blog->id) }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @method('POST') <!-- Add this line for Laravel to recognize the form method as POST -->


                                @if ($blog->media_nama)
                                    <div class="form-group">
                                        <label for="currentMedia"></label>
                                        <img src="{{ asset('storage/' . $blog->media_nama) }}" alt="Current Media"
                                            width="100">
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="exampleTextarea1">Input Foto atau Video</label>
                                    <input type="file" class="form-control" name="media_nama" accept="image/*,video/*">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Judul</label>
                                    <input type="text" class="form-control" id="exampleInputSubject"
                                        placeholder="Judul Blog" name="judul" required
                                        value="{{ old('judul', $blog->judul) }}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleTextarea1">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi">{{ old('deskripsi', $blog->deskripsi) }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputName1">Tanggal Submit</label>
                                    <input type="date" class="form-control" id="exampleInputName1" name="created_at"
                                        placeholder="date" required
                                        value="{{ old('created_at', $blog->created_at->format('Y-m-d')) }}" readonly>
                                </div>
                                @if (auth()->user()->role == 'admin')
                                    <div class="form-group">
                                        <label for="is_publish">Status Publish</label>
                                        <select class="form-control" id="is_publish" name="is_publish" required>
                                            <option value="1" {{ $blog->is_publish == 1 ? 'selected' : '' }}>Publish
                                            </option>
                                            <option value="0" {{ $blog->is_publish == 0 ? 'selected' : '' }}>Gagal
                                            </option>
                                        </select>
                                    </div>
                                @endif
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit Changes</button>
                                </div>
                            </form>
                            <script>
                                // const image_upload_handler_callback = (blobInfo, progress) => new Promise((resolve, reject) => {
                                //     const xhr = new XMLHttpRequest();
                                //     xhr.withCredentials = false;
                                //     xhr.open('POST', 'upload.php');

                                //     // Add the CSRF token to the request headers
                                //     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                                //     xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);

                                //     xhr.upload.onprogress = (e) => {
                                //         progress(e.loaded / e.total * 100);
                                //     };

                                //     xhr.onload = () => {
                                //         if (xhr.status === 200) {
                                //             // Log the response for debugging
                                //             console.log('Image Upload Response:', xhr.responseText);
                                //             resolve(JSON.parse(xhr.responseText).location);
                                //         } else {
                                //             console.error('Image Upload Error:', xhr.status, xhr.statusText);
                                //             reject('HTTP Error: ' + xhr.status);
                                //         }
                                //     };

                                //     xhr.onerror = () => {
                                //         console.error('Image Upload Failed: XHR Transport Error');
                                //         reject('Image upload failed due to a XHR Transport error.');
                                //     };

                                //     const formData = new FormData();
                                //     formData.append('file', blobInfo.blob(), blobInfo.filename());

                                //     xhr.send(formData);
                                // });
                                tinymce.init({
                                    selector: 'textarea#deskripsi', // Replace 'yourTextareaID' with the ID of your textarea element
                                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss lists number',
                                    toolbar: 'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | removeformat | copyLink',
                                    menubar: false,
                                    statusbar: false,
                                    height: 400, // Set the height of the editor as needed
                                    branding: false, // Hide the TinyMCE branding
                                    paste_data_images: true,
                                    content_style: 'ul { list-style-type: square; margin-left: 20px; }',
                                    extended_valid_elements: 'iframe[src|title|width|height|allow|allowfullscreen|frameborder]',
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
                                    },
                                    setup: function(editor) {
                                        editor.ui.registry.addMenuItem('copyLink', {
                                            text: 'Copy Embed Link',
                                            icon: 'link',
                                            onAction: function() {
                                                var selectedNode = editor.selection.getNode();
                                                var url;
                                                if (selectedNode.nodeName === 'IMG') {
                                                    url = selectedNode.src;
                                                } else if (selectedNode.nodeName === 'IFRAME') {
                                                    url = selectedNode.src;
                                                } else {
                                                    url = selectedNode.getAttribute('src');
                                                }
                                                if (url) {
                                                    navigator.clipboard.writeText(url).then(function() {
                                                        // URL copied to clipboard
                                                        alert('Embed link copied to clipboard!');
                                                    }).catch(function(err) {
                                                        // Unable to copy URL to clipboard
                                                        console.error('Unable to copy embed link to clipboard',
                                                        err);
                                                    });
                                                } else {
                                                    alert('No embed link found!');
                                                }
                                            }
                                        });

                                        editor.ui.registry.addButton('copyLink', {
                                            icon: 'link',
                                            tooltip: 'Copy Embed Link',
                                            onAction: function() {
                                                var selectedNode = editor.selection.getNode();
                                                var url;
                                                if (selectedNode.nodeName === 'IMG') {
                                                    url = selectedNode.src;
                                                } else if (selectedNode.nodeName === 'IFRAME') {
                                                    url = selectedNode.src;
                                                } else {
                                                    url = selectedNode.getAttribute('src');
                                                }
                                                if (url) {
                                                    navigator.clipboard.writeText(url).then(function() {
                                                        // URL copied to clipboard
                                                        alert('Embed link copied to clipboard!');
                                                    }).catch(function(err) {
                                                        // Unable to copy URL to clipboard
                                                        console.error('Unable to copy embed link to clipboard',
                                                        err);
                                                    });
                                                } else {
                                                    alert('No embed link found!');
                                                }
                                            }
                                        });
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
                    text: '{{ session('success') }}',
                    icon: 'success'
                }).then(function() {
                    window.location.href = '{{ route('blog') }}';
                });
            });
        </script>
    @endif
