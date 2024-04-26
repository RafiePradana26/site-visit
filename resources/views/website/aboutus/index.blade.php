@extends('layouts.welcome')

<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,100,900);


    body {
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
        margin-top: 50px;
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
        text-align: left;
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

    .pointer {
        cursor: pointer;
    }

    body {
        background: #F9F9F9;
    }

    .myaccordion {
        max-width: 500px;
        margin: 50px auto;
        box-shadow: 0 0 1px rgba(0, 0, 0, 0.1);
    }

    .myaccordion .card,
    .myaccordion .card:last-child .card-header {
        border: none;
    }

    .myaccordion .card-header {
        border-bottom-color: #EDEFF0;
        background: transparent;
    }

    .myaccordion .fa-stack {
        font-size: 18px;
    }

    .myaccordion .btn {
        width: 100%;
        font-weight: bold;
        color: #004987;
        padding: 0;
    }

    .myaccordion .btn-link:hover,
    .myaccordion .btn-link:focus {
        text-decoration: none;
    }

    .myaccordion li+li {
        margin-top: 10px;
    }
</style>

@section('content')
    <section class="wrapper">
        <div class="container-fostrap">
            <div class="content">
                <div class="container">
                    <div class="row mt-50">
                        <div class="col-xs-12 col-sm-6">
                            <div class="card">
                                <div class="card-content">
                                    <h1 class="text-center">
                                        Visi
                                    </h1>
                                    <p class="">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu arcu
                                        ullamcorper, ullamcorper risus id, posuere sapien. Donec luctus risus tortor. In
                                        arcu nisl, ultricies non est in, placerat porta libero. Nullam scelerisque efficitur
                                        purus, nec malesuada nisl mollis tincidunt. Vestibulum ante ipsum primis in faucibus
                                        orci luctus et ultrices posuere cubilia curae; Integer rhoncus sit amet diam a
                                        tristique. Aliquam mollis turpis ut justo dictum, gravida porta ante dapibus. Duis
                                        sagittis turpis vitae velit pharetra, et accumsan arcu viverra. Suspendisse dictum
                                        enim at arcu ultrices, et dignissim purus faucibus.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <div class="card">
                                <div class="card-content">
                                    <h1 class="text-center">
                                        Misi
                                    </h1>
                                    <p class="">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer eu arcu
                                        ullamcorper, ullamcorper risus id, posuere sapien. Donec luctus risus tortor. In
                                        arcu nisl, ultricies non est in, placerat porta libero. Nullam scelerisque efficitur
                                        purus, nec malesuada nisl mollis tincidunt. Vestibulum ante ipsum primis in faucibus
                                        orci luctus et ultrices posuere cubilia curae; Integer rhoncus sit amet diam a
                                        tristique. Aliquam mollis turpis ut justo dictum, gravida porta ante dapibus. Duis
                                        sagittis turpis vitae velit pharetra, et accumsan arcu viverra. Suspendisse dictum
                                        enim at arcu ultrices, et dignissim purus faucibus.
                                </div>
                            </div>
                        </div>
                        <!-- ... Rest of your cards ... -->
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Question 1
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the first item's accordion body.</strong> It is shown by default, until
                                    the collapse plugin adds the appropriate classes that we use to style each element.
                                    These classes control the overall appearance, as well as the showing and hiding via CSS
                                    transitions. You can modify any of this with custom CSS or overriding our default
                                    variables. It's also worth noting that just about any HTML can go within the
                                    <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Question 2
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and hiding
                                    via CSS transitions. You can modify any of this with custom CSS or overriding our
                                    default variables. It's also worth noting that just about any HTML can go within the
                                    <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Question 3
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <strong>This is the third item's accordion body.</strong> It is hidden by default, until
                                    the collapse plugin adds the appropriate classes that we use to style each element.
                                    These classes control the overall appearance, as well as the showing and hiding via CSS
                                    transitions. You can modify any of this with custom CSS or overriding our default
                                    variables. It's also worth noting that just about any HTML can go within the
                                    <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<script>
    $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
        $(e.target)
            .prev()
            .find("i:last-child")
            .toggleClass("fa-minus fa-plus");
    });
</script>
