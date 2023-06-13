<!DOCTYPE html>
<html>

<head>
    <title>{{$type}} Snow Plowing</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="{{ $company->name ?? '' }} admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, {{ $company->name ?? '' }} admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ $company->favicon ?? '' }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ $company->favicon ?? '' }}" type="image/x-icon">
    <title>@yield('title') - {{ $company->name ?? '' }}</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/font-awesome.css') }}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    <!-- ######## fontawesome link ####### -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<style>
    .bg-skyblue {
        background-color: #DEEFFF;
    }

    .h-100vh {
        height: 97vh;
    }

    .address-card {
        background-color: #7CC0FB;
        height: auto;
        display: -ms-flexbox;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        margin: 0 auto;
        padding: 130px 0px 0 0;
        background-image: url("../assets/images/snow-fall.png");
        background-repeat: no-repeat;
        background-size: contain;
    }

    .mt-96 {
        margin-top: 96px;
    }

    .d-down-1 .dropdown-toggle:after {
        top: 50%;
    }

    .d-down-1 .dropdown-menu .dropdown-item {
        opacity: 10;
    }

    .d-down-1 .dropdown-menu .d-flex img{
        border-radius: 50%;
        margin: 10px 15px;
    }

    .d-down-1 .dropdown-menu .d-flex .dropdown-item{
        font-size:12px
    }

    .d-down-1 .dropdown-menu .d-flex .dropdown-item:hover{
        color: #24B550 !important;
    }

    .border-top-blue{
        border-top: 5px solid #0275D8 !important;
    }
    .navbar-light .navbar-nav .nav-link {
        font-weight: 500;
    }
</style>

<body>

    {{-- header  --}}

    <nav class="navbar navbar-expand-lg navbar-light bg-white px-5">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand w-50" href="{{ route('dashboard') }}">
                <img class="img-fluid " src="{{ $company->logo ?? '' }}" alt="logo" width="150">
            </a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">

                <div class="left-side-header w-50 ps-0 d-none d-md-block">
                    <div class="input-group"><span class="input-group-text" id="basic-addon1">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M11.2753 2.71436C16.0029 2.71436 19.8363 6.54674 19.8363 11.2753C19.8363 16.0039 16.0029 19.8363 11.2753 19.8363C6.54674 19.8363 2.71436 16.0039 2.71436 11.2753C2.71436 6.54674 6.54674 2.71436 11.2753 2.71436Z"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M19.8987 18.4878C20.6778 18.4878 21.3092 19.1202 21.3092 19.8983C21.3092 20.6783 20.6778 21.3097 19.8987 21.3097C19.1197 21.3097 18.4873 20.6783 18.4873 19.8983C18.4873 19.1202 19.1197 18.4878 19.8987 18.4878Z"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </g>
                                </g>
                            </svg></span>
                        <input class="form-control" type="text" placeholder="Search here.." aria-label="search"
                            aria-describedby="basic-addon1">
                    </div>
                </div>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <!-- ------ services dropdown ------ -->
                    <div class="dropdown d-down-1 me-3">
                        <button class="btn dropdown-toggle bg-white fs-6" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                            Order Services
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark border-5 border-top-blue bg-white " aria-labelledby="dropdownMenuButton2">
                            <div class="d-flex">
                                <div>
                                    <a class="dropdown-item text-dark bg-white pb-4" href="{{route('lawn-mowing.start')}}">
                                        <img src="{{ asset('assets/images/lawn-mowing.png') }}" alt="img" width="50px" height="50px" class="">
                                        <li>Lawn Mowing</li>
                                    </a>
                                </div>
                                <div>
                                    <a class="dropdown-item text-dark bg-white pb-4" href="{{route('snow-plowing.start')}}">
                                        <img src="{{ asset('assets/images/snow-plowing.png') }}" alt="img" width="50px" height="50px" class="">
                                        <li>Snow Plowing</li>
                                    </a>
                                </div>
                            </div>
                        </ul>
                    </div>

                    <li class="nav-item">
                        <a class="nav-link text-dark fs-6" href="#">About Us</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <!-- Page Header Ends  -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 p-0 bg-skyblue h-100vh ">
                <div class="address-card">
                    <form class="theme-form login-form needs-validation" novalidate="" action=""
                        method="POST">
                        @csrf
                        <h2>{{$type}} Snow Removal</h2>
                        <p class="mt-3 text-start">Order a Snow Plowing Service from anywhere, any
                            -time. Our professional and insured fleet will come to
                            plow your driveway clear of snow. Whenever there’s
                            a storm, rest assured that we’ve got you covered.</p>

                        <div class="form-group mt-3">
                            <label>Address<span class="text-success"></span></label>
                            <div class="input-group"><span class="input-group-text"> <i
                                        class="fa-solid fa-location-dot"></i></span>
                                <input class="form-control" type="text" required value="{{ old('address') }}"
                                    name="address" placeholder="Your address" id="location">
                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="lng" id="lng">
                            </div>
                            <button class="btn btn-primary btn-block w-100 fw-light mt-4">GET YOUR PRICE</button>
                        </div>
                    </form>

                    <div class="d-flex mt-4 pt-1">
                        <div class="me-auto p-2 mt-3">
                            <img class="" src="../assets/images/tree.png" alt="tree" height="150">
                            <img class="" src="../assets/images/tree.png" alt="tree" height="180">
                        </div>
                        <div class="p-2 mt-96">
                            <img class="" src="../assets/images/tree.png" alt="tree" height="100">
                        </div>
                        <div class="p-2">
                            <img class="" src="../assets/images/tree.png" alt="tree" height="200">
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-12 p-0 ">
                <img class="img-fluid h-100vh w-100" src="{{asset('assets/images/'.$type.'.png')}}" alt="">
            </div>

        </div>
    </div>


    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('assets/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>

    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>

    @stack('vendor-scripts')

    @include('sections.notification-scripts')

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    <script type="text/javascript">
        var script = document.createElement("script");
        script.src = "https://maps.google.com/maps/api/js?key="+"{{ config('google.GOOGLE_MAPS_APIKEY') }}"+"&libraries=places";
        script.type = "text/javascript";
        script.addEventListener('load', function() {

            google.maps.event.addDomListener(window, 'load', initialize);

            function initialize() {

                var input = document.getElementById('location');
                var options = {componentRestrictions: {country: ["us"]}};
                var autocomplete = new google.maps.places.Autocomplete(input,options);


                autocomplete.addListener('place_changed', function() {
                    var place = autocomplete.getPlace();
                    $('#lat').val(place.geometry['location'].lat());
                    $('#lng').val(place.geometry['location'].lng());
                });
            }
        });

        document.head.appendChild(script);
    </script>

</body>

</html>
