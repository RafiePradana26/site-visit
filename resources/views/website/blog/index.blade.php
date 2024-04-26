@extends('layouts.welcome')
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> --}}

<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,100,900);

    <<<<<<< HEAD

    /* Add max-height to the card-content */
    .card-content {
        max-height: 100px;
        /* Adjust the value as needed */
        overflow: hidden;
    }

    /* Limit the number of characters in the description */
    .limited-text {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    =======>>>>>>>5e58498a1e54d07f3a642302432a4ea00728f04e body {
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        height: 100%;
        width: 100%;
        background: #FFF;
        font-family: 'Roboto', sans-serif;
        font-weight: 400;
    }

    .wrapper {
        display: table;
        height: 100%;
        width: 100%;
    }

    .container-fostrap {
        display: table-cell;
        padding: 1em;
        text-align: center;
        margin-top: 100px;
        /* vertical-align: middle; */
    }

    .fostrap-logo {
        width: 100px;
        margin-bottom: 15px;
    }

    h1.heading {
        color: #505050;
        font-size: 2.5em;
        font-weight: 900;
        margin: 0 0 0.5em;
    }

    .card {
        display: block;
        margin-left: 20px;
        margin-bottom: 10px;
        line-height: 1.42857143;
        background-color: #fff;
        border-radius: 2px;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.16), 0 2px 10px 0 rgba(0, 0, 0, 0.12);
        transition: box-shadow 0.25s;
    }

    .card:hover {
        box-shadow: 0 8px 17px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .img-card {
        width: 100%;
        height: 200px;
        border-top-left-radius: 2px;
        border-top-right-radius: 2px;
        display: block;
        overflow: hidden;
    }

    .img-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: all 0.25s ease;
    }

    .card-content {
        padding: 15px;
        max-height: 100px;
        text-align: left;
        overflow: hidden;
    }

    .card-title {
        margin-top: 0px;
        font-weight: 700;
        font-size: 1.65em;
    }

    .card-title a {
        color: #000;
        text-decoration: none !important;
    }

    .card-read-more {
        border-top: 1px solid #D4D4D4;
    }

    .card-read-more a {
        text-decoration: none !important;
        padding: 10px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .paginationBlog {
        display: flex;
        justify-content: center;
        margin-top: 200px;
        /* display: none; */
    }

    .paginationBlog svg {
        display: none;
    }

    .paginationBlog {
        margin: 0 5px;
        display: flex;
        align-items: center;
    }

    .paginationBlog {
        padding: 10px 15px;
        border-radius: 5px;
        color: #fff;
        /* background-color: #0d6efd;
        border: 1px solid #0d6efd; */
        transition: background-color 0.3s, border-color 0.3s, color 0.3s;
    }

    .paginationBlog {
        /* background-color: #007bff;
        border-color: #007bff; */
        color: #fff;
    }

    .paginationBlog {
        background-color: #f8f9fa;
        border-color: #f8f9fa;
        color: #6c757d;
    }

    .paginationBlog {
        outline: none;
        /* box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25); */
    }

    .paginationBlog {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: #fff; /* Adjust the background color as needed */
        z-index: 1000; /* Ensure the pagination is on top of other elements */
        padding: 10px; /* Add some padding for better visibility */
        border-top: 1px solid #ccc; /* Add a border at the top for separation */
    }
</style>

@section('content')
    <section class="wrapper">
        <div class="container-fostrap">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="section-title text-center">
                            <h2>Blog</h2>
                            <p>Our Blog</p>
                        </div>
                        @if (
                            $blogs->isEmpty() ||
                                $blogs->every(function ($blog) {
                                    return !$blog->is_publish;
                                }))
                            <h1>Belum Ada Data</h1>
                        @else
                            @foreach ($blogs as $b)
                                @if ($b->is_publish)
                                    <div class="col-xs-12 col-sm-4">
                                        <div class="card">
                                            <a class="img-card" href="#">
                                                <img src="{{ asset('storage/' . $b->media_nama) }}"
                                                    alt="{{ $b->judul }}" />
                                            </a>
                                            <div class="card-content">
                                                <h4 class="card-title">
                                                    <a href="#"> {{ $b->judul }}</a>
                                                </h4>
                                                <p class="limited-text">
                                                    {!! $b->deskripsi !!}
                                                </p>
                                            </div>
                                            <div class="card-read-more">
                                                <a href="{{ route('blog.showBlog', ['id' => $b->id]) }}"
                                                    class="btn btn-link btn-block">
                                                    Read More
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="paginationBlog">

                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
