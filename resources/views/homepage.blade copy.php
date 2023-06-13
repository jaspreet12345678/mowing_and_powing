<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ---- fav-icon link ------ -->
    <link rel="icon" type="image/x-icon" href="images/favicon.jpg') }}">

    <!-- ---- bootstrap 5 ------ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ---- style.css ------ -->
    <link rel="stylesheet" href="{{ asset('assets/css/home_page_style.css') }}">

    <!-- ---- font-awesome link ------ -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

    <title>Mowing & Plowing landing page</title>
</head>

<body>
    <div class="container-fluid border-bottom border-secondary">
        <!-- ---blue navbar ---- -->

        {{-- <div class="row bg-darkblue py-lg-2 py-3">
            <div class="col-xl-2 col-lg-1 col-0"></div>

            <div class="col-xl-5 col-lg-6 col-12 text-white my-auto navbar-haeding">
                <h6 class="my-auto">Winter Offers: Check out our Snow Plow offers for this winter season</h6>
            </div>
            <div class="col-xl-3 col-lg-4 col-12 mt-lg-0 mt-4">
                    ---- timer ----
                <div class="d-flex navbar-timer">
                    <div class="timer1" id="timer">
                        <div class="container1">
                            <div class="numbers1">
                                <div><span id="hours"></span></div>
                                <div class="description1">Hrs</div>
                            </div>
                            <div class="numbers1">
                                <div><span id="minutes"></span></div>
                                <div class="description1">Mins</div>
                            </div>
                            <div class="numbers1">
                                <div><span id="seconds"></span></div>
                                <div class="description1">Secs</div>
                            </div>
                        </div>
                    </div>

                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="46.443"
                        height="39.599" viewBox="0 0 46.443 39.599" class="my-auto mx-3">
                        <defs>
                            <filter id="Path_18539" x="0" y="0.741" width="46.443" height="38.858"
                                filterUnits="userSpaceOnUse">
                                <feOffset dy="2" input="SourceAlpha" />
                                <feGaussianBlur stdDeviation="2" result="blur" />
                                <feFlood flood-opacity="0.161" />
                                <feComposite operator="in" in2="blur" />
                            </filter>
                            <filter id="Path_18539-2" x="0" y="0.741" width="46.443" height="38.858"
                                filterUnits="userSpaceOnUse">
                                <feOffset input="SourceAlpha" />
                                <feGaussianBlur stdDeviation="1.5" result="blur-2" />
                                <feFlood flood-opacity="0.161" result="color" />
                                <feComposite operator="out" in="SourceGraphic" in2="blur-2" />
                                <feComposite operator="in" in="color" />
                                <feComposite operator="in" in2="SourceGraphic" />
                            </filter>
                        </defs>
                        <g id="_172566_down_arrow_icon" data-name="172566_down_arrow_icon"
                            transform="translate(40.234) rotate(90)">
                            <g id="_172566_down_arrow_icon-2" data-name="172566_down_arrow_icon"
                                transform="translate(0 0)">
                                <rect id="Rectangle_8653" data-name="Rectangle 8653" width="34.137" height="34.137"
                                    transform="translate(0 0)" fill="none" />
                                <g data-type="innerShadowGroup">
                                    <g transform="matrix(0, -1, 1, 0, 0, 40.23)" filter="url(#Path_18539)">
                                        <path id="Path_18539-3" data-name="Path 18539"
                                            d="M6.208,18.905l9.307,12.827,9.307-12.827H18.748C18.748-.672,0,0,0,0s12.283.927,12.283,18.9Z"
                                            transform="translate(39.43 4.82) rotate(90)" fill="none" stroke="#fff"
                                            stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" />
                                    </g>
                                    <g transform="matrix(0, -1, 1, 0, 0, 40.23)" filter="url(#Path_18539-2)">
                                        <path id="Path_18539-4" data-name="Path 18539"
                                            d="M6.208,18.905l9.307,12.827,9.307-12.827H18.748C18.748-.672,0,0,0,0s12.283.927,12.283,18.9Z"
                                            transform="translate(39.43 4.82) rotate(90)" fill="#fff" />
                                    </g>
                                    <path id="Path_18539-5" data-name="Path 18539"
                                        d="M6.208,18.905l9.307,12.827,9.307-12.827H18.748C18.748-.672,0,0,0,0s12.283.927,12.283,18.9Z"
                                        transform="translate(4.816 0.799)" fill="none" stroke="#fff"
                                        stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" />
                                </g>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
            <div class="col-xl-2 col-lg-1 col-0"></div>
        </div> --}}


        <!-- ---white navbar ---- -->
        <div class="container-lg">
            <nav class="navbar navbar-expand-lg navbar-light">
                <img src="{{ asset('assets/home_page_images/logo.png') }}" alt="logo-mowing&plowing">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse ms-auto flex-grow-0" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Book your Services</a>
                        </li>
                        <li class="nav-item d-flex">
                            <a class="nav-link me-lg-0 me-md-3" href="#">
                                <svg id="Component_33_3" data-name="Component 33 – 3"
                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 30 30">
                                    <circle id="Ellipse_209" data-name="Ellipse 209" cx="15" cy="15" r="15"
                                        fill="#1f2119" />
                                    <g id="_5402435_account_profile_user_avatar_man_icon"
                                        data-name="5402435_account_profile_user_avatar_man_icon"
                                        transform="translate(6.969 6)">
                                        <ellipse id="Ellipse_208" data-name="Ellipse 208" cx="4" cy="4.5" rx="4"
                                            ry="4.5" transform="translate(4)" fill="#fff" />
                                        <path id="Path_18538" data-name="Path 18538"
                                            d="M20.483,19.181v1.03a1.03,1.03,0,0,1-1.03,1.03H5.03A1.03,1.03,0,0,1,4,20.211v-1.03A6.181,6.181,0,0,1,10.181,13H14.3A6.181,6.181,0,0,1,20.483,19.181Z"
                                            transform="translate(-4 -3.242)" fill="#fff" />
                                    </g>
                                </svg></a>
                            <a class="nav-link" href="{{ route('web.login') }}">Login</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('signup') }}">
                                <button class="btn btn-sm btn-green">Work With Us</button>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link pt-1" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="45" height="40" viewBox="0 0 52 52">
                                    <defs>
                                        <filter id="Ellipse_217" x="0" y="0" width="52" height="52"
                                            filterUnits="userSpaceOnUse">
                                            <feOffset dy="2" input="SourceAlpha" />
                                            <feGaussianBlur stdDeviation="2" result="blur" />
                                            <feFlood flood-opacity="0.161" />
                                            <feComposite operator="in" in2="blur" />
                                            <feComposite in="SourceGraphic" />
                                        </filter>
                                        <filter id="Path_13686" x="4.669" y="8.302" width="39.384" height="39.362"
                                            filterUnits="userSpaceOnUse">
                                            <feOffset dy="3" input="SourceAlpha" />
                                            <feGaussianBlur stdDeviation="3" result="blur-2" />
                                            <feFlood flood-opacity="0.161" />
                                            <feComposite operator="in" in2="blur-2" />
                                            <feComposite in="SourceGraphic" />
                                        </filter>
                                        <filter id="Path_13687" x="11.601" y="5.645" width="35.988" height="35.901"
                                            filterUnits="userSpaceOnUse">
                                            <feOffset dy="3" input="SourceAlpha" />
                                            <feGaussianBlur stdDeviation="3" result="blur-3" />
                                            <feFlood flood-opacity="0.161" />
                                            <feComposite operator="in" in2="blur-3" />
                                            <feComposite in="SourceGraphic" />
                                        </filter>
                                        <filter id="Path_13688" x="18.882" y="11.93" width="23.319" height="25.874"
                                            filterUnits="userSpaceOnUse">
                                            <feOffset dy="3" input="SourceAlpha" />
                                            <feGaussianBlur stdDeviation="3" result="blur-4" />
                                            <feFlood flood-opacity="0.161" />
                                            <feComposite operator="in" in2="blur-4" />
                                            <feComposite in="SourceGraphic" />
                                        </filter>
                                        <filter id="Path_13689" x="13.623" y="11.876" width="22.378" height="25.999"
                                            filterUnits="userSpaceOnUse">
                                            <feOffset dy="3" input="SourceAlpha" />
                                            <feGaussianBlur stdDeviation="3" result="blur-5" />
                                            <feFlood flood-opacity="0.161" />
                                            <feComposite operator="in" in2="blur-5" />
                                            <feComposite in="SourceGraphic" />
                                        </filter>
                                    </defs>
                                    <g id="Component_26_1" data-name="Component 26 – 1" transform="translate(6 4)">
                                        <g transform="matrix(1, 0, 0, 1, -6, -4)" filter="url(#Ellipse_217)">
                                            <circle id="Ellipse_217-2" data-name="Ellipse 217" cx="20" cy="20"
                                                r="20" transform="translate(6 4)" fill="#58d109" />
                                        </g>
                                        <g id="Group_8" data-name="Group 8" transform="translate(-494.99 -152.569)">
                                            <g transform="matrix(1, 0, 0, 1, 488.99, 148.57)"
                                                filter="url(#Path_13686)">
                                                <path id="Path_13686-2" data-name="Path 13686"
                                                    d="M518.324,205.319a9.3,9.3,0,0,1-3.736-1.343,28.119,28.119,0,0,1-10.858-11.135,8.453,8.453,0,0,1-1.072-4.049,5.282,5.282,0,0,1,2.991-4.626,1.365,1.365,0,0,1,1.737.258,2.165,2.165,0,0,1,.341.366c.893,1.345,1.808,2.677,2.657,4.049a1.642,1.642,0,0,1-.422,2.243c-.291.259-.591.511-.857.794a1.569,1.569,0,0,0-.362,1.8,7.372,7.372,0,0,0,1.135,1.892,38.488,38.488,0,0,0,2.9,2.832,5.071,5.071,0,0,0,1.385.809,1.724,1.724,0,0,0,2.042-.412c.247-.251.477-.52.711-.784a1.605,1.605,0,0,1,2.194-.423c1.422.874,2.819,1.793,4.176,2.764a1.416,1.416,0,0,1,.5,2.051A5.624,5.624,0,0,1,518.324,205.319Z"
                                                    transform="translate(-488.99 -169.66)" fill="#fff" />
                                            </g>
                                            <g transform="matrix(1, 0, 0, 1, 488.99, 148.57)"
                                                filter="url(#Path_13687)">
                                                <path id="Path_13687-2" data-name="Path 13687"
                                                    d="M565.043,163.656l-.43-.556a10.586,10.586,0,0,1,14.784.246,10.373,10.373,0,0,1,.229,14.768l-.469-.369c.437-.979.9-1.905,1.267-2.865a8.4,8.4,0,0,0,.544-3.116c-.449,0-.869.008-1.288,0-.464-.011-.581-.135-.6-.6-.046-1.1-.01-1.14,1.065-1.141h.663a9.837,9.837,0,0,0-8.009-8.089c0,.409.009.809,0,1.209-.013.463-.138.6-.605.591-.369-.008-.79.151-1.142-.3v-1.69A11.3,11.3,0,0,0,565.043,163.656Z"
                                                    transform="translate(-544.01 -148.57)" fill="#fff" />
                                            </g>
                                            <g transform="matrix(1, 0, 0, 1, 488.99, 148.57)"
                                                filter="url(#Path_13688)">
                                                <path id="Path_13688-2" data-name="Path 13688"
                                                    d="M634.133,216.386v4.352l.874.143v1.576l-.855.137v1.666h-1.7v-1.708H629.83a3.008,3.008,0,0,1,.043-1.955c.759-1.378,1.606-2.707,2.419-4.055a1.045,1.045,0,0,1,.14-.156Zm-1.763,4.386v-1.679l-.09-.025-.948,1.7Z"
                                                    transform="translate(-601.8 -198.46)" fill="#fff" />
                                            </g>
                                            <g transform="matrix(1, 0, 0, 1, 488.99, 148.57)"
                                                filter="url(#Path_13689)">
                                                <path id="Path_13689-2" data-name="Path 13689"
                                                    d="M585.256,222.2h1.769v1.541a14.437,14.437,0,0,1-4.337,0v-1.4c.672-.818,1.334-1.542,1.9-2.336a7.343,7.343,0,0,0,.79-1.644c.164-.431.043-.577-.43-.768-.563.033-.5.641-.9.942l-1.35-.256a2.267,2.267,0,0,1,3.117-2.2,2.148,2.148,0,0,1,1.208,2.437,7.859,7.859,0,0,1-1.476,3.083c-.107.148-.217.3-.325.443Z"
                                                    transform="translate(-560.06 -198.03)" fill="#fff" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

    <header class="container-fluid px-0 position-relative">
        <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="{{ asset('assets/home_page_images/slider-1.jpg') }}" class="d-block slider-img" alt="...">
                    <div class="carousel-caption d-non d-sm-block">
                        <div class="row text-white">
                            <div class="col-xl-3 col-md-2 col-0"></div>
                            <div class="col-xl-6 col-md-8 col-12">
                                <h1 class="fw-bold mx-xxl-5"><span class="fw-normal">Get</span> Lawn Mowing
                                <span class="fw-normal">&</span> Snow Plowing. <span class="fw-normal">Instantly.</span>
                                </h1>
                                <div class="d-flex justify-content-center mt-lg-5 mt-1">
                                    <h6 class="me-2 fw-normal">Book a provider for same day service in 5 minutes</h6>

                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25"
                                        height="30" viewBox="0 0 44.906 52.398">
                                        <defs>
                                            <filter id="Path_18539" x="0" y="0" width="44.906" height="52.398"
                                                filterUnits="userSpaceOnUse">
                                                <feOffset dy="2" input="SourceAlpha" />
                                                <feGaussianBlur stdDeviation="2" result="blur" />
                                                <feFlood flood-opacity="0.161" />
                                                <feComposite operator="in" in2="blur" />
                                            </filter>
                                            <filter id="Path_18539-2" x="0" y="0" width="44.906" height="52.398"
                                                filterUnits="userSpaceOnUse">
                                                <feOffset input="SourceAlpha" />
                                                <feGaussianBlur stdDeviation="1.5" result="blur-2" />
                                                <feFlood flood-opacity="0.161" result="color" />
                                                <feComposite operator="out" in="SourceGraphic" in2="blur-2" />
                                                <feComposite operator="in" in="color" />
                                                <feComposite operator="in" in2="SourceGraphic" />
                                            </filter>
                                        </defs>
                                        <g id="_172566_down_arrow_icon" data-name="172566_down_arrow_icon"
                                            transform="translate(1.256 4.211)">
                                            <g id="_172566_down_arrow_icon-2" data-name="172566_down_arrow_icon">
                                                <rect id="Rectangle_8653" data-name="Rectangle 8653" width="40.137" height="40.137"
                                                    fill="none" />
                                                <g data-type="innerShadowGroup">
                                                    <g transform="matrix(1, 0, 0, 1, -1.26, -4.21)" filter="url(#Path_18539)">
                                                        <path id="Path_18539-3" data-name="Path 18539"
                                                            d="M13.709,23.476,25.266,38.728,36.822,23.476H29.279C29.279.2,6,1,6,1S21.252,2.1,21.252,23.476Z"
                                                            transform="translate(0.07 4.01)" fill="none" stroke="#24b550"
                                                            stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" />
                                                    </g>
                                                    <g transform="matrix(1, 0, 0, 1, -1.26, -4.21)" filter="url(#Path_18539-2)">
                                                        <path id="Path_18539-4" data-name="Path 18539"
                                                            d="M13.709,23.476,25.266,38.728,36.822,23.476H29.279C29.279.2,6,1,6,1S21.252,2.1,21.252,23.476Z"
                                                            transform="translate(0.07 4.01)" fill="#fff" />
                                                    </g>
                                                    <path id="Path_18539-5" data-name="Path 18539"
                                                        d="M13.709,23.476,25.266,38.728,36.822,23.476H29.279C29.279.2,6,1,6,1S21.252,2.1,21.252,23.476Z"
                                                        transform="translate(-1.184 -0.196)" fill="none" stroke="#24b550"
                                                        stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" />
                                                </g>
                                            </g>
                                        </g>
                                    </svg>

                                </div>

                                <div>
                                    <div class="search-local">
                                        <i class="fa-solid fa-location-dot text-primary ps-2"></i>

                                        <input class="ps-4" type="text" placeholder="Enter your home address">
                                        <button class="btn rounded-pill search-btn-green">
                                            <a href="#" class="text-decoration-none">Select service</a>
                                        </button>
                                    </div>

                                    <button class="btn btn-transparent mt-lg-5 mt-2 px-4">Get Now</button>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-2 col-0"></div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="{{ asset('assets/home_page_images/slider-2.jpg') }}" class="d-block slider-img" alt="...">
                    <div class="carousel-caption d-non d-sm-block">
                        <div class="row text-white">
                            <div class="col-xl-3 col-md-2 col-0"></div>
                            <div class="col-xl-6 col-md-8 col-12">
                                <h1 class="fw-bold mx-xxl-5"><span class="fw-normal">Get</span> Lawn Mowing
                                    <span class="fw-normal">&</span> Snow Plowing. <span class="fw-normal">Instantly.</span>
                                </h1>
                                <div class="d-flex justify-content-center mt-lg-5 mt-1">
                                    <h6 class="me-2 fw-normal">Book a provider for same day service in 5 minutes</h6>

                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25"
                                        height="30" viewBox="0 0 44.906 52.398">
                                        <defs>
                                            <filter id="Path_18539" x="0" y="0" width="44.906" height="52.398"
                                                filterUnits="userSpaceOnUse">
                                                <feOffset dy="2" input="SourceAlpha" />
                                                <feGaussianBlur stdDeviation="2" result="blur" />
                                                <feFlood flood-opacity="0.161" />
                                                <feComposite operator="in" in2="blur" />
                                            </filter>
                                            <filter id="Path_18539-2" x="0" y="0" width="44.906" height="52.398"
                                                filterUnits="userSpaceOnUse">
                                                <feOffset input="SourceAlpha" />
                                                <feGaussianBlur stdDeviation="1.5" result="blur-2" />
                                                <feFlood flood-opacity="0.161" result="color" />
                                                <feComposite operator="out" in="SourceGraphic" in2="blur-2" />
                                                <feComposite operator="in" in="color" />
                                                <feComposite operator="in" in2="SourceGraphic" />
                                            </filter>
                                        </defs>
                                        <g id="_172566_down_arrow_icon" data-name="172566_down_arrow_icon"
                                            transform="translate(1.256 4.211)">
                                            <g id="_172566_down_arrow_icon-2" data-name="172566_down_arrow_icon">
                                                <rect id="Rectangle_8653" data-name="Rectangle 8653" width="40.137" height="40.137"
                                                    fill="none" />
                                                <g data-type="innerShadowGroup">
                                                    <g transform="matrix(1, 0, 0, 1, -1.26, -4.21)" filter="url(#Path_18539)">
                                                        <path id="Path_18539-3" data-name="Path 18539"
                                                            d="M13.709,23.476,25.266,38.728,36.822,23.476H29.279C29.279.2,6,1,6,1S21.252,2.1,21.252,23.476Z"
                                                            transform="translate(0.07 4.01)" fill="none" stroke="#24b550"
                                                            stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" />
                                                    </g>
                                                    <g transform="matrix(1, 0, 0, 1, -1.26, -4.21)" filter="url(#Path_18539-2)">
                                                        <path id="Path_18539-4" data-name="Path 18539"
                                                            d="M13.709,23.476,25.266,38.728,36.822,23.476H29.279C29.279.2,6,1,6,1S21.252,2.1,21.252,23.476Z"
                                                            transform="translate(0.07 4.01)" fill="#fff" />
                                                    </g>
                                                    <path id="Path_18539-5" data-name="Path 18539"
                                                        d="M13.709,23.476,25.266,38.728,36.822,23.476H29.279C29.279.2,6,1,6,1S21.252,2.1,21.252,23.476Z"
                                                        transform="translate(-1.184 -0.196)" fill="none" stroke="#24b550"
                                                        stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" />
                                                </g>
                                            </g>
                                        </g>
                                    </svg>

                                </div>

                                <div>
                                    <div class="search-local">
                                        <i class="fa-solid fa-location-dot text-primary ps-2"></i>

                                        <input class="ps-4" type="text" placeholder="Enter your home address">
                                        <button class="btn rounded-pill search-btn-green">
                                            <a href="#" class="text-decoration-none">Select service</a>
                                        </button>
                                    </div>

                                    <button class="btn btn-transparent mt-lg-5 mt-2 px-4">Get Now</button>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-2 col-0"></div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/home_page_images/slider-3.jpg') }}" class="d-block slider-img" alt="...">
                    <div class="carousel-caption d-non d-sm-block">
                        <div class="row text-white">
                            <div class="col-xl-3 col-md-2 col-0"></div>
                            <div class="col-xl-6 col-md-8 col-12">
                                <h1 class="fw-bold mx-xxl-5"><span class="fw-normal">Get</span> Lawn Mowing
                                    <span class="fw-normal">&</span> Snow Plowing. <span class="fw-normal">Instantly.</span>
                                </h1>
                                <div class="d-flex justify-content-center mt-lg-5 mt-1">
                                    <h6 class="me-2 fw-normal">Book a provider for same day service in 5 minutes</h6>

                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="25"
                                        height="30" viewBox="0 0 44.906 52.398">
                                        <defs>
                                            <filter id="Path_18539" x="0" y="0" width="44.906" height="52.398"
                                                filterUnits="userSpaceOnUse">
                                                <feOffset dy="2" input="SourceAlpha" />
                                                <feGaussianBlur stdDeviation="2" result="blur" />
                                                <feFlood flood-opacity="0.161" />
                                                <feComposite operator="in" in2="blur" />
                                            </filter>
                                            <filter id="Path_18539-2" x="0" y="0" width="44.906" height="52.398"
                                                filterUnits="userSpaceOnUse">
                                                <feOffset input="SourceAlpha" />
                                                <feGaussianBlur stdDeviation="1.5" result="blur-2" />
                                                <feFlood flood-opacity="0.161" result="color" />
                                                <feComposite operator="out" in="SourceGraphic" in2="blur-2" />
                                                <feComposite operator="in" in="color" />
                                                <feComposite operator="in" in2="SourceGraphic" />
                                            </filter>
                                        </defs>
                                        <g id="_172566_down_arrow_icon" data-name="172566_down_arrow_icon"
                                            transform="translate(1.256 4.211)">
                                            <g id="_172566_down_arrow_icon-2" data-name="172566_down_arrow_icon">
                                                <rect id="Rectangle_8653" data-name="Rectangle 8653" width="40.137" height="40.137"
                                                    fill="none" />
                                                <g data-type="innerShadowGroup">
                                                    <g transform="matrix(1, 0, 0, 1, -1.26, -4.21)" filter="url(#Path_18539)">
                                                        <path id="Path_18539-3" data-name="Path 18539"
                                                            d="M13.709,23.476,25.266,38.728,36.822,23.476H29.279C29.279.2,6,1,6,1S21.252,2.1,21.252,23.476Z"
                                                            transform="translate(0.07 4.01)" fill="none" stroke="#24b550"
                                                            stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" />
                                                    </g>
                                                    <g transform="matrix(1, 0, 0, 1, -1.26, -4.21)" filter="url(#Path_18539-2)">
                                                        <path id="Path_18539-4" data-name="Path 18539"
                                                            d="M13.709,23.476,25.266,38.728,36.822,23.476H29.279C29.279.2,6,1,6,1S21.252,2.1,21.252,23.476Z"
                                                            transform="translate(0.07 4.01)" fill="#fff" />
                                                    </g>
                                                    <path id="Path_18539-5" data-name="Path 18539"
                                                        d="M13.709,23.476,25.266,38.728,36.822,23.476H29.279C29.279.2,6,1,6,1S21.252,2.1,21.252,23.476Z"
                                                        transform="translate(-1.184 -0.196)" fill="none" stroke="#24b550"
                                                        stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" />
                                                </g>
                                            </g>
                                        </g>
                                    </svg>

                                </div>

                                <div>
                                    <div class="search-local">
                                        <i class="fa-solid fa-location-dot text-primary ps-2"></i>

                                        <input class="ps-4" type="text" placeholder="Enter your home address">
                                        <button class="btn rounded-pill search-btn-green">
                                            <a href="#" class="text-decoration-none">Select service</a>
                                        </button>
                                    </div>

                                    <button class="btn btn-transparent mt-lg-5 mt-2 px-4">Get Now</button>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-2 col-0"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ----- circle-img -------- -->
        <div class="circle-img">
            <a href="#"><img src="{{ asset('assets/home_page_images/header-circle.png') }}" alt="img-not-show"></a>
        </div>
    </header>

    <div class="container-fluid">
        <!-- --- section-1 (green banner)---- -->
        <section class="container-lg section-1 p-4 rounded-3">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-6">
                    <div class="text-center">
                        <img src="{{ asset('assets/home_page_images/circle-1.png') }}" alt="">
                        <h2 class="fw-bold text-white">2519</h2>
                        <h6>Projects</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-6">
                    <div class="text-center">
                        <img src="{{ asset('assets/home_page_images/circle-2.png') }}" alt="">
                        <h3 class="fw-bold text-white">1857</h3>
                        <h6>Clients</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-6 mt-md-0 mt-4">
                    <div class="text-center">
                        <img src="{{ asset('assets/home_page_images/circle-3.png') }}" alt="">
                        <h2 class="fw-bold text-white">756</h2>
                        <h6>Providers</h6>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-6 mt-md-0 mt-4">
                    <div class="text-center">
                        <img src="{{ asset('assets/home_page_images/circle-4.png') }}" alt="">
                        <h2 class="fw-bold text-white">6</h2>
                        <h6>Cities</h6>
                    </div>
                </div>
            </div>
        </section>

        <!-- --- section-2 (app & google-imgs)---- -->
        <section class="container-lg section-2 mt-4">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="mb-4 fw-bold">Manage it all from the APP.</h3>
                    <div class="row">
                        <div class="col-xl-9 col-md-12 col-sm-10 col-12">
                            <p class="me-auto">Download the Mowing and Plowing Customer app and manage everything from
                                your phone. Get live GPS
                                tracking, Push message job alerts, Live customer service, and much more.</p>
                            <div class="d-flex">
                                <div class="btn-group dropend flex-column">
                                    <button type="button" class="btn btn-blue dropdown-toggle rounded-3"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Mobile Number
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                                    </ul>
                                    <span class="text-secondary mt-2">We'll text you a link for the free app</span>
                                </div>

                                <svg class="mt-3" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="80" height="80"
                                    viewBox="0 0 94.482 94.482">
                                    <defs>
                                        <filter id="Path_18539" x="20.905" y="17.26" width="55.025" height="63.724"
                                            filterUnits="userSpaceOnUse">
                                            <feOffset dy="2" input="SourceAlpha" />
                                            <feGaussianBlur stdDeviation="2" result="blur" />
                                            <feFlood flood-opacity="0.161" />
                                            <feComposite operator="in" in2="blur" />
                                        </filter>
                                        <filter id="Path_18539-2" x="20.905" y="17.26" width="55.025" height="63.724"
                                            filterUnits="userSpaceOnUse">
                                            <feOffset input="SourceAlpha" />
                                            <feGaussianBlur stdDeviation="1.5" result="blur-2" />
                                            <feFlood flood-opacity="0.161" result="color" />
                                            <feComposite operator="out" in="SourceGraphic" in2="blur-2" />
                                            <feComposite operator="in" in="color" />
                                            <feComposite operator="in" in2="SourceGraphic" />
                                        </filter>
                                    </defs>
                                    <g id="_172566_down_arrow_icon" data-name="172566_down_arrow_icon"
                                        transform="translate(0 34.583) rotate(-30)">
                                        <g id="_172566_down_arrow_icon-2" data-name="172566_down_arrow_icon"
                                            transform="matrix(0.839, 0.545, -0.545, 0.839, 27.232, 0)">
                                            <rect id="Rectangle_8653" data-name="Rectangle 8653" width="50" height="50"
                                                fill="none" />
                                            <g data-type="innerShadowGroup">
                                                <g transform="matrix(1, -0.05, 0.05, 1, -24.65, -19.7)"
                                                    filter="url(#Path_18539)">
                                                    <path id="Path_18539-3" data-name="Path 18539"
                                                        d="M15.6,29,30,48,44.4,29H35C35,0,6,1,6,1S25,2.373,25,29Z"
                                                        transform="translate(23.58 20.97) rotate(3)" fill="none"
                                                        stroke="#0275d8" stroke-linecap="round" stroke-miterlimit="10"
                                                        stroke-width="2" />
                                                </g>
                                                <g transform="matrix(1, -0.05, 0.05, 1, -24.65, -19.7)"
                                                    filter="url(#Path_18539-2)">
                                                    <path id="Path_18539-4" data-name="Path 18539"
                                                        d="M15.6,29,30,48,44.4,29H35C35,0,6,1,6,1S25,2.373,25,29Z"
                                                        transform="translate(23.58 20.97) rotate(3)" fill="#fff" />
                                                </g>
                                                <path id="Path_18539-5" data-name="Path 18539"
                                                    d="M15.6,29,30,48,44.4,29H35C35,0,6,1,6,1S25,2.373,25,29Z"
                                                    fill="none" stroke="#0275d8" stroke-linecap="round"
                                                    stroke-miterlimit="10" stroke-width="2" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>

                            </div>
                            <div class="d-flex mt-4">
                                <img src="{{ asset('assets/home_page_images/app-store.png') }}" alt="appstor-img-not-show" width="40%" class="me-4">
                                <img src="{{ asset('assets/home_page_images/google-play.png') }}" alt="google-img-not-show" width="40%">
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-0 col-sm-2 col-12"></div>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
        </section>

        <!-- --- section-3 (mobiles)---- -->
        <section class="container-lg section-3 mt-5 pt-xl-4">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="mobile-img">
                    <img src="{{ asset('assets/home_page_images/mobile-1-shadow.png') }}" alt="mobile-img-not-show" class="">
                    </div>
                    <div class="d-flex flex-column ps-2 pe-xl-5 me-xxl-5 me-xl-4 mt-4">
                        <h3 class="border-bottom border-success pb-2 fw-normal">Easy Ordres</h3>

                        <p>No more calling around searching for a lawn care provider. In 5 minutes you can book job have
                            it serviced same day.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mt-sm-0 mt-4">
                    <div class="mobile-img">
                        <img src="{{ asset('assets/home_page_images/mobile-2-shadow.png') }}" alt="mobile-img-not-show" class="">
                    </div>
                    <div class="d-flex flex-column ps-2 pe-xl-5 me-xxl-5 me-xl-4 mt-4">
                        <h3 class="border-bottom border-success pb-2 fw-normal">GPS Tracking</h3>

                        <p>NEW Track your provider to see when they will be arriving to your property. This feature is
                            perfect for snow storms to keep you updated.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mt-md-0 mt-4">
                    <div class="mobile-img">
                        <img src="{{ asset('assets/home_page_images/mobile-3-shadow.png') }}" alt="mobile-img-not-show" class="">
                    </div>
                    <div class="d-flex flex-column ps-2 pe-xl-5 me-xxl-5 me-xl-4 mt-4">
                        <h3 class="border-bottom border-success pb-2 fw-normal">Manage Appointments</h3>

                        <p>Easily manage your jobs through your customer portal or APP. Order Services, Contact
                            Providers, Cancel Service and more.</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mt-md-0 mt-4">
                    <div class="mobile-img">
                        <img src="{{ asset('assets/home_page_images/mobile-4-shadow.png') }}" alt="mobile-img-not-show" class="">
                    </div>
                    <div class="d-flex flex-column ps-2 pe-xl-5 me-xxl-5 me-xl-4 mt-4">
                        <h3 class="border-bottom border-success pb-2 fw-normal">Refer a Friend</h3>

                        <p>Refer a new friend and grt a bonus of up to 50$ in your Mowing and Plowing Cash Wallet.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- --- section-4 (bg-blue-img)---- -->
    <section class="container-fluid section4-bg-img mt-5">
        <div class="container-lg section-4">
            <div class="row py-5">
                <div class="col-md-6">
                    <div class="text-white d-flex flex-column justify-content-between py-lg-5 my-5 h-75">
                        <h2 class="fw-bold h2">Manage all your jobs in one place</h2>
                        <p class="p">With our NEW customer portal you can manage all your properties 24/7.</p>
                        <div class="row">
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 d-flex">

                                <svg xmlns="http://www.w3.org/2000/svg" width="46" height="40.994"
                                    viewBox="0 0 46 40.994">
                                    <path id="_290143_cash_money_payment_wallet_icon"
                                        data-name="290143_cash_money_payment_wallet_icon"
                                        d="M47,40h0a5,5,0,0,1-5,5H6a5,5,0,0,1-5-5V11A4,4,0,0,1,5,7H25.171l8.1-2.934a.99.99,0,0,1,1.268.589L35.391,7H39a4,4,0,0,1,4,4v2h0a4,4,0,0,1,4,4ZM5,9H5a2,2,0,0,0,0,4H8.634c.013-.005.021-.016.034-.021L19.65,9Zm29.078.181L33.016,6.257h0L30.964,7h0L25.453,9h-.01L14.4,13H35.466ZM41,11a2,2,0,0,0-2-2H36.117l1.454,4H41Zm2,4H5a3.955,3.955,0,0,1-2-.555V40a3,3,0,0,0,3,3H42a3,3,0,0,0,3-3V33H41a4,4,0,0,1,0-8h4V17A2,2,0,0,0,43,15Zm2,16V27H41a2,2,0,0,0,0,4Zm-4-3h2v2H41Z"
                                        transform="translate(-1 -4.006)" fill="#fff" fill-rule="evenodd" />
                                </svg>
                                <div class="ms-3">Wallet Feature
                                </div>
                                <div class="vl ms-lg-0 ms-5"></div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 d-flex mt-md-0 mt-4">

                                <svg xmlns="http://www.w3.org/2000/svg" width="33.661" height="40.035"
                                    viewBox="0 0 33.661 40.035">
                                    <g id="Group_8336" data-name="Group 8336" transform="translate(-70.099 -229.251)">
                                        <path id="Path_19898" data-name="Path 19898"
                                            d="M119.516,229.251a22.363,22.363,0,0,1,3.654,1.285,11.148,11.148,0,0,1,5.031,14.477,61.9,61.9,0,0,1-5.352,10.39c-1.367,2.213-2.819,4.374-4.236,6.556-.137.21-.3.4-.492.649-.145-.169-.254-.274-.337-.4a98,98,0,0,1-8.818-14.978,19.9,19.9,0,0,1-1.755-5.223c-.638-4.547,1.162-8.176,4.827-10.889a11.763,11.763,0,0,1,4.666-1.871Zm-5.808,10.739a4.389,4.389,0,1,0,4.438-4.589A4.5,4.5,0,0,0,113.708,239.99Z"
                                            transform="translate(-31.183)" fill="#fff" />
                                        <path id="Path_19899" data-name="Path 19899"
                                            d="M92.617,404.581l.266-1.965a1.759,1.759,0,0,1,.459-.052,22.859,22.859,0,0,1,6.581,1.852,11.02,11.02,0,0,1,2.467,1.613c1.872,1.686,1.807,3.864-.081,5.542a11.5,11.5,0,0,1-3.957,2.137,31.924,31.924,0,0,1-8.874,1.622A37.579,37.579,0,0,1,75.9,413.836a12.189,12.189,0,0,1-4.156-2.093c-2.158-1.776-2.2-4.075-.085-5.916a8.6,8.6,0,0,1,1.271-.9,21.746,21.746,0,0,1,8.046-2.366l.322,2.014a25.414,25.414,0,0,0-2.549.518c-1.51.466-3.008.98-4.476,1.561a4.786,4.786,0,0,0-1.453,1.029,1.307,1.307,0,0,0,.054,2.206,8.734,8.734,0,0,0,1.885,1.228A22.931,22.931,0,0,0,82.286,413a42.68,42.68,0,0,0,9.2,0,23.235,23.235,0,0,0,7.677-1.933,8.329,8.329,0,0,0,1.931-1.295,1.251,1.251,0,0,0-.008-2.089,8.281,8.281,0,0,0-1.794-1.222,20.235,20.235,0,0,0-5.655-1.7Z"
                                            transform="translate(0 -146.121)" fill="#fff" />
                                    </g>
                                </svg>
                                <div class="ms-3">
                                    GPS Tracking
                                </div>
                                <div class="vl ms-lg-0 ms-5"></div>
                            </div>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-12 d-flex mt-lg-0 mt-4">

                                <svg xmlns="http://www.w3.org/2000/svg" width="42" height="40" viewBox="0 0 51 40">
                                    <g id="Group_8337" data-name="Group 8337" transform="translate(-317.395 -344.451)">
                                        <path id="Path_19900" data-name="Path 19900"
                                            d="M319.282,353.536c9.159-7.852,19.634-10.721,31.44-8.19a34.346,34.346,0,0,1,16.576,8.968c.087.082.175.164.259.25.957.975,1.1,1.976.4,2.761s-1.691.719-2.732-.166c-1.425-1.213-2.8-2.5-4.314-3.588a31.5,31.5,0,0,0-36.1.052c-1.353.973-2.585,2.117-3.871,3.186-.276.229-.52.5-.812.7a1.654,1.654,0,0,1-2.269-.167,1.713,1.713,0,0,1-.038-2.311C318.248,354.508,318.766,354.06,319.282,353.536Z"
                                            fill="#fff" />
                                        <path id="Path_19901" data-name="Path 19901"
                                            d="M367.32,366.6a5.848,5.848,0,0,1,.7.924,1.576,1.576,0,0,1-.306,1.989,1.514,1.514,0,0,1-1.959.265,5.931,5.931,0,0,1-1.019-.819,24.372,24.372,0,0,0-32.174-1.444c-.717.566-1.348,1.243-2.042,1.84-.974.84-1.947.858-2.625.084a1.832,1.832,0,0,1,.334-2.671,27.425,27.425,0,0,1,17.952-8.019C354.2,358.3,361.17,360.943,367.32,366.6Z"
                                            transform="translate(-4.949 -7.101)" fill="#fff" />
                                        <path id="Path_19902" data-name="Path 19902"
                                            d="M339.423,378.9a20.121,20.121,0,0,1,25.4-1.483,26.1,26.1,0,0,1,2.514,2.172,1.739,1.739,0,0,1,.271,2.557,1.7,1.7,0,0,1-2.6-.108,16.938,16.938,0,0,0-23.754-.2,3.415,3.415,0,0,1-1.157.777,1.457,1.457,0,0,1-1.756-.636,1.611,1.611,0,0,1,.047-2.013C338.659,379.631,338.995,379.343,339.423,378.9Z"
                                            transform="translate(-10.139 -14.516)" fill="#fff" />
                                        <path id="Path_19903" data-name="Path 19903"
                                            d="M349.3,392.063a13.6,13.6,0,0,1,18.607.053c.922.91,1.032,1.878.3,2.641-.712.743-1.722.685-2.676-.153a10.1,10.1,0,0,0-13.9-.012c-.968.845-1.965.911-2.678.178-.753-.775-.618-1.777.369-2.728C349.382,391.987,349.438,391.929,349.3,392.063Z"
                                            transform="translate(-15.676 -21.871)" fill="#fff" />
                                        <path id="Path_19904" data-name="Path 19904"
                                            d="M367.2,413.918a4.484,4.484,0,1,1-6.311-6.371,4.543,4.543,0,0,1,6.332.052A4.5,4.5,0,0,1,367.2,413.918Z"
                                            transform="translate(-21.119 -30.79)" fill="#fff" />
                                    </g>
                                </svg>
                                <div class="ms-3">
                                    Live jobs Alerts
                                </div>
                            </div>
                            <div class="col-xl-3 col-0"></div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="my-lg-0 my-md-5">
                        <img src="{{ asset('assets/home_page_images/dashboard-img.png') }}" alt="" width="100%">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- --- section-5 (video & headings)---- -->
    <section class="container-lg section-5 my-5 py-xl-5">
        <div class="row">
            <div class="col-md-4 pe-xl-5">
                <div class="d-flex flex-column justify-content-between h-100">
                    <div></div>
                    <h2 class="fw-bold pe-xl-5 me-xl-2">Same day Lawn Mowing and Snow PLowing</h2>
                    <p class="pe-xl-5 me-xl-5">Check out why so many of your neighbors use Mowing nad Plowing</p>
                    <img src="{{ asset('assets/home_page_images/grass.png') }}" alt="grass-img-not-show">
                </div>
            </div>
            <div class="col-md-8 mt-md-0 mt-4">
                <div class="py- video-size">
                    <video width="" controls>
                        <source src="{{ asset('assets/home_page_images/mowing&plowing-video.mp4') }}" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </section>

    <!-- --- section-6 (bg-img)---- -->
    <section class="container-fluid section6-bg-img">
        <div class="container-lg py-5">
            <div class="row py-5 mt-lg-2">
                <div class="col-md-6">
                    <div class="d-flex flex-column justify-content-between h-100 text-white">
                        <div class="row">
                            <div class="col-xl-8 col-md-10 pe-lg-4">
                                <h2 class="fw-bold ">Are you a Provider Looking to grow your business?
                                </h2>
                                <p class="">Sign up to become a provider for Mowing and Plowing.
                                    It's Free! Get jobs sent to you directly to your phone daily. Grow you business by
                                    up to
                                    40%
                                    by picking up Lawn Mowing and Snow Plowing Jobs.
                                </p>
                            </div>
                            <div class="col-xl-4 col-md-2"></div>
                        </div>
                        <div class="d-flex">
                            <div class="btn-group dropend flex-column">
                                <button type="button" class="btn btn-white dropdown-toggle rounded-3"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Mobile Number
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Menu item</a></li>
                                    <li><a class="dropdown-item" href="#">Menu item</a></li>
                                    <li><a class="dropdown-item" href="#">Menu item</a></li>
                                </ul>
                                <span class="text-white mt-2">We'll text you a link for the free app</span>
                            </div>
                        </div>
                        <div>
                            <div class="d-flex text-white">
                                <p class="mb-0 pt-1">Download the APP now and Sign Up</p>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="50" height="50" viewBox="0 0 77.475 77.475">
                                    <defs>
                                        <filter id="Path_18539" x="17.123" y="13.488" width="45.509" height="54.319"
                                            filterUnits="userSpaceOnUse">
                                            <feOffset dy="2" input="SourceAlpha" />
                                            <feGaussianBlur stdDeviation="2" result="blur" />
                                            <feFlood flood-opacity="0.161" />
                                            <feComposite operator="in" in2="blur" />
                                        </filter>
                                        <filter id="Path_18539-2" x="17.123" y="13.488" width="45.509" height="54.319"
                                            filterUnits="userSpaceOnUse">
                                            <feOffset input="SourceAlpha" />
                                            <feGaussianBlur stdDeviation="1.5" result="blur-2" />
                                            <feFlood flood-opacity="0.161" result="color" />
                                            <feComposite operator="out" in="SourceGraphic" in2="blur-2" />
                                            <feComposite operator="in" in="color" />
                                            <feComposite operator="in" in2="SourceGraphic" />
                                        </filter>
                                    </defs>
                                    <g id="_172566_down_arrow_icon" data-name="172566_down_arrow_icon"
                                        transform="translate(0 28.358) rotate(-30)">
                                        <g id="_172566_down_arrow_icon-2" data-name="172566_down_arrow_icon"
                                            transform="matrix(0.839, 0.545, -0.545, 0.839, 22.33, 0)">
                                            <rect id="Rectangle_8653" data-name="Rectangle 8653" width="41" height="41"
                                                transform="translate(0 0)" fill="none" />
                                            <g data-type="innerShadowGroup">
                                                <g transform="matrix(1, -0.05, 0.05, 1, -20.21, -16.16)"
                                                    filter="url(#Path_18539)">
                                                    <path id="Path_18539-3" data-name="Path 18539"
                                                        d="M7.352,22.642,18.374,38,29.4,22.642H22.2C22.2-.805,0,0,0,0s14.546,1.11,14.546,22.639Z"
                                                        transform="translate(25.28 18.5) rotate(3)" fill="none"
                                                        stroke="#fff" stroke-linecap="round" stroke-miterlimit="10"
                                                        stroke-width="2" />
                                                </g>
                                                <g transform="matrix(1, -0.05, 0.05, 1, -20.21, -16.16)"
                                                    filter="url(#Path_18539-2)">
                                                    <path id="Path_18539-4" data-name="Path 18539"
                                                        d="M7.352,22.642,18.374,38,29.4,22.642H22.2C22.2-.805,0,0,0,0s14.546,1.11,14.546,22.639Z"
                                                        transform="translate(25.28 18.5) rotate(3)" fill="#fff" />
                                                </g>
                                                <path id="Path_18539-5" data-name="Path 18539"
                                                    d="M7.352,22.642,18.374,38,29.4,22.642H22.2C22.2-.805,0,0,0,0s14.546,1.11,14.546,22.639Z"
                                                    transform="translate(6 0.996)" fill="none" stroke="#fff"
                                                    stroke-linecap="round" stroke-miterlimit="10" stroke-width="2" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                            </div>
                            <div class="d-flex">
                                <img src="{{ asset('assets/home_page_images/app-store.png') }}" alt="appstor-img-not-show" width="40%" class="me-4">
                                <img src="{{ asset('assets/home_page_images/google-play.png') }}" alt="google-img-not-show" width="40%">
                            </div>
                        </div>
                        <div class="">
                            <button class="btn btn-lightgreen btn-lg mt-4 px-5">See More</button>
                        </div>
                        <!-- <div class="col-md-6"></div> -->
                    </div>
                </div>
                <div class="col-md-6 text-center mt-md-0 mt-4 mobile-img">
                    <img src="{{ asset('assets/home_page_images/mobile-5-shadow.png') }}" alt="mobile-img-not-show">
                </div>
            </div>
        </div>
    </section>

    <!-- --- section-7 ((search-bar with map)---- -->
    <section class="container-lg my-5 py-lg-5">
        <div class="row">
            <div class="col-xl-3 col-md-2 col-sm-1 col-0"></div>
            <div class="col-xl-6 col-md-8 col-sm-10 col-12 text-center">
                <div>
                    <h4 class="fw-bold text-cente mx-4">Instantly order Lawn Mowing or Snow Plowing from the top
                        providers
                        in your area.</h4>
                    <div>
                        <div class="search-local mt-5">
                            <i class="fa-solid fa-location-dot text-primary ps-2"></i>
                            <input class="ps-4" type="text" placeholder="Enter your home address">
                            <button class="btn rounded-pill search-btn-green">
                                <a href="#" class="text-decoration-none">Select service</a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="mt-5 pt-4">
                    <h5>Real time Reviews</h5>

                    <div style="width: 100%" class="mt-5">
                        <iframe width="100%" height="400" frameborder="0" scrolling="no" class="rounded-15"
                            marginheight="0" marginwidth="0"
                            src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street,%20Dublin,%20Ireland+(My%20Business%20Name)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"><a
                                href="https://www.maps.ie/distance-area-calculator.html">measure distance on
                                map</a>
                        </iframe>
                    </div>
                </div>

            </div>
            <div class="col-xl-3 col-md-2 col-sm-1 col-0"></div>
        </div>
    </section>

    <!-- --- section-8 (slider)---- -->
    {{-- <section class="container-fluid px-0 mb-5">

        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('assets/home_page_images/2nd-slider-1.png') }}" class="d-block slider2-img" alt="slider-img-not-show">
                    <div class="carousel-caption d-non d-md-bloc">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 px-xl-3">
                                <div class="card text-dark">
                                    <div class="green-bar">
                                    </div>
                                    <div class="card-body">
                                        <div class="text-start mt-2">
                                            <img src="{{ asset('assets/home_page_images/comma-top.png') }}" alt="">

                                            <p class="mt-3">This is an honest company . I received an alert that my job
                                                was cancelled the
                                                day before it was due . I called and Joy in the office told me they
                                                already
                                                found a replacement for me and the job was done on time. Great job
                                                fellas.
                                            </p>
                                        </div>
                                        <div class="text-end">
                                            <img src="{{ asset('assets/home_page_images/comma-bottom.png') }}" alt="">

                                            <div class="d-flex justify-content-end">
                                                <hr class="w-50">
                                            </div>
                                            <div class="me-2">Ken Thomson,</div>
                                            <div class="me-2">Mission Bay</div>
                                        </div>
                                    </div>
                                    <div class="slider-circle-imgs">
                                        <img src="{{ asset('assets/home_page_images/slider-circle-img1.png') }}" alt="circle-img-not-show">
                                    </div>
                                    <img src="{{ asset('assets/home_page_images/card-grass.png') }}" alt="img-not-show">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 px-xl-3">
                                <div class="card text-dark">
                                    <div class="green-bar">
                                    </div>
                                    <div class="card-body">
                                        <div class="text-start mt-2">
                                            <img src="{{ asset('assets/home_page_images/comma-top.png') }}" alt="">

                                            <p class="mt-3">This is an honest company . I received an alert that my job
                                                was cancelled the
                                                day before it was due . I called and Joy in the office told me they
                                                already
                                                found a replacement for me and the job was done on time. Great job
                                                fellas.
                                            </p>
                                        </div>
                                        <div class="text-end">
                                            <img src="{{ asset('assets/home_page_images/comma-bottom.png') }}" alt="">

                                            <div class="d-flex justify-content-end">
                                                <hr class="w-50">
                                            </div>
                                            <div class="me-2">Tom Smithenson,</div>
                                            <div class="me-2">Parkmerced</div>
                                        </div>
                                    </div>
                                    <div class="slider-circle-imgs">
                                        <img src="{{ asset('assets/home_page_images/slider-circle-img2.png') }}" alt="circle-img-not-show">
                                    </div>
                                    <img src="{{ asset('assets/home_page_images/card-grass.png') }}" alt="img-not-show">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 px-xl-3">
                                <div class="card text-dark">
                                    <div class="green-bar">
                                    </div>
                                    <div class="card-body">
                                        <div class="text-start mt-2">

                                            <img src="{{ asset('assets/home_page_images/comma-top.png') }}" alt="">
                                            <p class="mt-3">This is an honest company . I received an alert that my job
                                                was cancelled the
                                                day before it was due . I called and Joy in the office told me they
                                                already
                                                found a replacement for me and the job was done on time. Great job
                                                fellas.
                                            </p>
                                        </div>
                                        <div class="text-end">

                                            <img src="{{ asset('assets/home_page_images/comma-bottom.png') }}" alt="">

                                            <div class="d-flex justify-content-end">
                                                <hr class="w-50">
                                            </div>
                                            <div class="me-2">Tilly Green,</div>
                                            <div class="me-2">Hayes Vally</div>
                                        </div>
                                    </div>
                                    <div class="slider-circle-imgs">
                                        <img src="{{ asset('assets/home_page_images/slider-circle-img3.png') }}" alt="circle-img-not-show">
                                    </div>
                                    <img src="{{ asset('assets/home_page_images/card-grass.png') }}" alt="img-not-show">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/home_page_images/2nd-slider-2.jpg') }}" class="d-block slider2-img" alt="slider-img-not-show">
                    <div class="carousel-caption d-non d-md-bloc">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 px-xl-3">
                                <div class="card text-dark">
                                    <div class="green-bar">
                                    </div>
                                    <div class="card-body">
                                        <div class="text-start mt-2">

                                            <img src="{{ asset('assets/home_page_images/comma-top.png') }}" alt="">
                                            <p class="mt-3">This is an honest company . I received an alert that my job
                                                was cancelled the
                                                day before it was due . I called and Joy in the office told me they
                                                already
                                                found a replacement for me and the job was done on time. Great job
                                                fellas.
                                            </p>
                                        </div>
                                        <div class="text-end">

                                            <img src="{{ asset('assets/home_page_images/comma-bottom.png') }}" alt="">

                                            <div class="d-flex justify-content-end">
                                                <hr class="w-50">
                                            </div>
                                            <div class="me-2">Ken Thomson,</div>
                                            <div class="me-2">Mission Bay</div>
                                        </div>
                                    </div>
                                    <div class="slider-circle-imgs">
                                        <img src="{{ asset('assets/home_page_images/slider-circle-img1.png') }}" alt="circle-img-not-show">
                                    </div>
                                    <img src="{{ asset('assets/home_page_images/card-grass.png') }}" alt="img-not-show">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 px-xl-3">
                                <div class="card text-dark">
                                    <div class="green-bar">
                                    </div>
                                    <div class="card-body">
                                        <div class="text-start mt-2">

                                            <img src="{{ asset('assets/home_page_images/comma-top.png') }}" alt="">
                                            <p class="mt-3">This is an honest company . I received an alert that my job
                                                was cancelled the
                                                day before it was due . I called and Joy in the office told me they
                                                already
                                                found a replacement for me and the job was done on time. Great job
                                                fellas.
                                            </p>
                                        </div>
                                        <div class="text-end">

                                            <img src="{{ asset('assets/home_page_images/comma-bottom.png') }}" alt="">

                                            <div class="d-flex justify-content-end">
                                                <hr class="w-50">
                                            </div>
                                            <div class="me-2">Tom Smithenson,</div>
                                            <div class="me-2">Parkmerced</div>
                                        </div>
                                    </div>
                                    <div class="slider-circle-imgs">
                                        <img src="{{ asset('assets/home_page_images/slider-circle-img2.png') }}" alt="circle-img-not-show">
                                    </div>
                                    <img src="{{ asset('assets/home_page_images/card-grass.png') }}" alt="img-not-show">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 px-xl-3">
                                <div class="card text-dark">
                                    <div class="green-bar">
                                    </div>
                                    <div class="card-body">
                                        <div class="text-start mt-2">

                                            <img src="{{ asset('assets/home_page_images/comma-top.png') }}" alt="">
                                            <p class="mt-3">This is an honest company . I received an alert that my job
                                                was cancelled the
                                                day before it was due . I called and Joy in the office told me they
                                                already
                                                found a replacement for me and the job was done on time. Great job
                                                fellas.
                                            </p>
                                        </div>
                                        <div class="text-end">

                                            <img src="{{ asset('assets/home_page_images/comma-bottom.png') }}" alt="">

                                            <div class="d-flex justify-content-end">
                                                <hr class="w-50">
                                            </div>
                                            <div class="me-2">Tilly Green,</div>
                                            <div class="me-2">Hayes Vally</div>
                                        </div>
                                    </div>
                                    <div class="slider-circle-imgs">
                                        <img src="{{ asset('assets/home_page_images/slider-circle-img3.png') }}" alt="circle-img-not-show">
                                    </div>
                                    <img src="{{ asset('assets/home_page_images/card-grass.png') }}" alt="img-not-show">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('assets/home_page_images/2nd-slider-3.jpg') }}" class="d-block slider2-img" alt="slider-img-not-show">
                    <div class="carousel-caption d-non d-md-bloc">
                        <div class="row">
                            <div class="col-md-4 col-sm-12 px-xl-3">
                                <div class="card text-dark">
                                    <div class="green-bar">
                                    </div>
                                    <div class="card-body">
                                        <div class="text-start mt-2">

                                            <img src="{{ asset('assets/home_page_images/comma-top.png') }}" alt="">
                                            <p class="mt-3">This is an honest company . I received an alert that my job
                                                was cancelled the
                                                day before it was due . I called and Joy in the office told me they
                                                already
                                                found a replacement for me and the job was done on time. Great job
                                                fellas.
                                            </p>
                                        </div>
                                        <div class="text-end">

                                            <img src="{{ asset('assets/home_page_images/comma-bottom.png') }}" alt="">

                                            <div class="d-flex justify-content-end">
                                                <hr class="w-50">
                                            </div>
                                            <div class="me-2">Ken Thomson,</div>
                                            <div class="me-2">Mission Bay</div>
                                        </div>
                                    </div>
                                    <div class="slider-circle-imgs">
                                        <img src="{{ asset('assets/home_page_images/slider-circle-img1.png') }}" alt="circle-img-not-show">
                                    </div>
                                    <img src="{{ asset('assets/home_page_images/card-grass.png') }}" alt="img-not-show">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 px-xl-3">
                                <div class="card text-dark">
                                    <div class="green-bar">
                                    </div>
                                    <div class="card-body">
                                        <div class="text-start mt-2">

                                            <img src="{{ asset('assets/home_page_images/comma-top.png') }}" alt="">
                                            <p class="mt-3">This is an honest company . I received an alert that my job
                                                was cancelled the
                                                day before it was due . I called and Joy in the office told me they
                                                already
                                                found a replacement for me and the job was done on time. Great job
                                                fellas.
                                            </p>
                                        </div>
                                        <div class="text-end">

                                            <img src="{{ asset('assets/home_page_images/comma-bottom.png') }}" alt="">

                                            <div class="d-flex justify-content-end">
                                                <hr class="w-50">
                                            </div>
                                            <div class="me-2">Tom Smithenson,</div>
                                            <div class="me-2">Parkmerced</div>
                                        </div>
                                    </div>
                                    <div class="slider-circle-imgs">
                                        <img src="{{ asset('assets/home_page_images/slider-circle-img2.png') }}" alt="circle-img-not-show">
                                    </div>
                                    <img src="{{ asset('assets/home_page_images/card-grass.png') }}" alt="img-not-show">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 px-xl-3">
                                <div class="card text-dark">
                                    <div class="green-bar">
                                    </div>
                                    <div class="card-body">
                                        <div class="text-start mt-2">

                                            <img src="{{ asset('assets/home_page_images/comma-top.png') }}" alt="">
                                            <p class="mt-3">This is an honest company . I received an alert that my job
                                                was cancelled the
                                                day before it was due . I called and Joy in the office told me they
                                                already
                                                found a replacement for me and the job was done on time. Great job
                                                fellas.
                                            </p>
                                        </div>
                                        <div class="text-end">

                                            <img src="{{ asset('assets/home_page_images/comma-bottom.png') }}" alt="">

                                            <div class="d-flex justify-content-end">
                                                <hr class="w-50">
                                            </div>
                                            <div class="me-2">Tilly Green,</div>
                                            <div class="me-2">Hayes Vally</div>
                                        </div>
                                    </div>
                                    <div class="slider-circle-imgs">
                                        <img src="{{ asset('assets/home_page_images/slider-circle-img3.png') }}" alt="circle-img-not-show">
                                    </div>
                                    <img src="{{ asset('assets/home_page_images/card-grass.png') }}" alt="img-not-show">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section> --}}

    <!-- --- section-9 ---- -->
    <section class="container-lg pt-lg-5 mb-5">
        <div class="row">
            <div class="col-xl-3 col-md-2 col-sm-1 col-0"></div>
            <div class="col-xl-6 col-md-8 col-sm-10 col-12 text-center px-lg-0">
                <h4 class="fw-bold">Save Time and Money by using Mowing and Plowing</h4>
                <p class="pt-2">
                    Mowing and Plowing is an on-demand home service APP with many great features to help you
                    manage one or many of your properties. We know how hard it is to find a good provider so we
                    put them all on one great app.
                </p>
                <p class="pt-2 mb-0">
                    No More Bids ! Just up - Front Pricing
                </p>
                <p>
                    Waiting for bid after bid can not only take time but can become frustrating. We created a
                    system that uses the industries averages and created an instant pricing feature.
                </p>
                <p>
                    Order Lawn Mowing or Snow Plowing near me!
                </p>
            </div>
            <div class="col-xl-3 col-md-2 col-sm-1 col-0"></div>
        </div>
    </section>

    <!-- --- section-10 (locations list)---- -->
    <section class="container-lg section-10 mb-5">
        <div class="row">
            <div class="col-xl-5 col-lg-6 col-md-7 col-sm-9 col-12 text-center">
                <h3 class="">Find local landscapers in your city</h3>
                <hr class="heading-bottom-line mt-1">
            </div>
            <div class="col-xl-7 col-lg-6 col-md-5 col-sm-3 col-12"></div>
        </div>
        <div class="row">
            <span class="ps-md-5 pb-3">Snow removal offered in cities marked with <i class="fa-regular fa-snowflake"></i> </span>
            <div class="col-md-3 col-sm-6 col-12 d-flex flex-column justify-content-between">
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Akron, OH <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Albany, NY <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Atlanta, GA </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Austin, TX </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Boston, MA <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Buffalo, NY <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Chicago, IL <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Charlotte, NC </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Cleveland, OH <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Columbus, OH <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Dallas, TX </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Denver, CO <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Durham, NC </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Grand Rapids, MI <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Indianapolis, IN <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Jacksonville, FL </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Louisville, KY </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Milwaukee, WI <i class="fa-regular fa-snowflake ms-1"></i></a> 
            </div>

            <div class="col-md-3 col-sm-6 col-12 mt-sm-0 mt-4 d-flex flex-column justify-content-between">
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Akron, OH <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Albany, NY <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Atlanta, GA </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Austin, TX </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Boston, MA <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Buffalo, NY <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Chicago, IL <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Charlotte, NC </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Cleveland, OH <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Columbus, OH <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Dallas, TX </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Denver, CO <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Durham, NC </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Grand Rapids, MI <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Indianapolis, IN <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Jacksonville, FL </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Louisville, KY </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Milwaukee, WI <i class="fa-regular fa-snowflake ms-1"></i></a> 
            </div>

            <div class="col-md-3 col-sm-6 col-12 mt-md-0 mt-4 d-flex flex-column justify-content-between">
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Akron, OH <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Albany, NY <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Atlanta, GA </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Austin, TX </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Boston, MA <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Buffalo, NY <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Chicago, IL <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Charlotte, NC </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Cleveland, OH <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Columbus, OH <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Dallas, TX </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Denver, CO <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Durham, NC </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Grand Rapids, MI <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Indianapolis, IN <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Jacksonville, FL </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Louisville, KY </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Milwaukee, WI <i class="fa-regular fa-snowflake ms-1"></i></a> 
            </div>

            <div class="col-md-3 col-sm-6 col-12 mt-md-0 mt-4 d-flex flex-column justify-content-between">
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Akron, OH <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Albany, NY <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Atlanta, GA </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Austin, TX </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Boston, MA <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Buffalo, NY <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Chicago, IL <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Charlotte, NC </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Cleveland, OH <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Columbus, OH <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Dallas, TX </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Denver, CO <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Durham, NC </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Grand Rapids, MI <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Indianapolis, IN <i class="fa-regular fa-snowflake ms-1"></i></a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Jacksonville, FL </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Louisville, KY </a>
                <a href="#" class="text-dark text-decoration-none"><i class="fa-solid fa-location-dot me-1 text-success"></i> Milwaukee, WI <i class="fa-regular fa-snowflake ms-1"></i></a> 
            </div>
            
        </div>
    </section>

    <!-- --- section-11 (online-chat-popup)---- -->
    {{-- <div class="container">
        <div class="row">
            <div class="col-md-12 p-4">
                <input type="checkbox" id="check">
                <label class="chat-btn text-dark" for="check">
                    <i class="fa fa-commenting-o comment"></i>
                    <i class="fa fa-close close"></i>
                </label>
                <div class="wrapper">
                    <div class="chat-header">
                        <h6>Let's Chat - Online</h6>
                    </div>
                    <div class="text-center p-2">
                        <span>Please fill out the form to start chat!</span>
                    </div>
                    <div class="chat-form">
                        <input type="text" class="form-control" placeholder="Name">
                        <input type="text" class="form-control" placeholder="Email">
                        <textarea class="form-control" placeholder="Your Text Message"></textarea>
                        <button class="btn submit-btn btn-success btn-block">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- --- dark-gray footer ---- -->
    <footer class="conatiner-fluid bg-gray">
        <div class="container-lg">
            <div class="row py-5">
                <div class="col-lg-5 col-md-6 text-white">
                    <img src="{{ asset('assets/home_page_images/logo.png') }}" alt="logo-img-not-show">
                    <p class="mt-4 mb-5 fs-14 footer-p">
                        Mowing and Plowing ON-Demand service APP is currently
                        available in select cities during our beta testing. We will
                        continue to grow from city to city in order to ensure each
                        customer gets the highest quality of Lawn Mowing and
                        Snow Plowing services they deserve.
                    </p>
                </div>
                <div class="col-lg-3 col-md-3 text-white">
                    <h6 class="fw-normal pb-2">Mowing & Plowing</h6>
                    <hr class="border-green-1">

                    <ul class="list-unstyled fs-13 mt-4">
                        <li class="mt-2"><a href="#" class="text-decoration-none text-white">About Us</a></li>
                        <li class="mt-2"><a href="#" class="text-decoration-none text-white">Contact</a></li>
                        <li class="mt-2"><a href="#" class="text-decoration-none text-white">Services</a></li>
                        <li class="mt-2"><a href="#" class="text-decoration-none text-white">FAQ</a></li>
                        <li class="mt-2"><a href="#" class="text-decoration-none text-white">Work with us</a></li>
                        <li class="mt-2"><a href="#" class="text-decoration-none text-white">Blog</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 text-white">
                    <h6 class="fw-normal pb-2">Contact</h6>
                    <hr class="border-green-2">
                    <div class="mt-4">
                        <a href="#" class="text-white text-decoration-none d-flex"><i class="fa-solid fa-location-dot me-2 pt-1"></i>
                        <div class="fs-14">500 Terry Francois Street <br> San Francisco, CA 94158</div> </a>
                    </div>  
                    <div class="my-3">
                        <a href="#" class="text-white text-decoration-none d-flex"><i class="fa-solid fa-phone-volume me-2 pt-1"></i> <div class="fs-14">123-456-7890</div> </a>
                    </div>
                    <h6 class="mb-4 fw-normal ms-4">Connect with us</h6>
                    <div class="row text-white ms-4">
                        <div class="col-md-6 col-6 d-flex justify-content-between px-0">
                            <a href="#" class="text-white"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#" class="text-white"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#" class="text-white"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="text-white"><i class="fa-brands fa-pinterest"></i></a>
                            <a href="#" class="text-white"><i class="fa-brands fa-youtube"></i></a>
                        </div>
                        <div class="col-md-6 col-6"></div>
                    </div>
                </div>
                <div class="col-lg-1"></div>

                <!-- ------ Apple & google btns ------- -->

                <div class="col-xl-6 col-12">
                    <div class="my-4">
                        <a href="#" class="text-green text-decoration-none">Download the APP now and Sign Up</a>
                    </div>
                    <div class="footer-btns">
                        <a href="#" class="text-decoration-none">
                            <button class="btn btn-sm border-white text-white d-flex px-4 rounded-3">
                                <i class="fa-brands fa-apple fs-1 me-4 pt-1"></i>
                                <div class="fs-13">Download on the <br> <span class="fs-5">App Store</span> </div>
                            </button>
                        </a>
                        <a href="#" class="text-decoration-none ms-3">
                            <button class="btn btn-sm border-white text-white d-flex justify-content-between px-4 rounded-3">
                                <img src="{{ asset('assets/home_page_images/google play icon.png') }}" alt="" width="20%" class="pt-2">
                                <div class="fs-13">Get it on the <br> <span class="fs-5">Google Play</span> </div>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-xl-6 col-0"></div>


                
                <!-- ------ Locations in paragraph ------- -->
                <div class="col-lg-10 text-white locations-names fs-14 pt-5">
                    Cleveland, Mento , Euclid, Tampa, Cleveland Heights, St. Petersburg, South Euclid, Akron, OH , Albany, NY , Atlanta, GA , Austin, TX , Boston, MA , Buffalo, NY , Chicago, IL, Charlotte, NC , Cleveland, OH , Columbus, OH , Dallas, TX , Denver, CO , Durham, NC , Grand Rapids, MI , Indianapolis, IN, Jacksonville, FL , Louisville, KY , Milwaukee, WI , Cleveland, Mento , Euclid, Tampa, Cleveland Heights, St. Petersburg, South Euclid, Akron, OH , Albany. NY, Atlanta, GA , Austin, TX , Boston, MA , Buffalo, NY , Chicago, IL, Charlotte, NC , Cleveland, OH , Columbus, OH , Dallas, TX , Denver, CO , Durham, NC , Grand Rapids, MI , Indianapolis, IN, Jacksonville, FL , Louisville, KY , Milwaukee, WI.
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </footer>

    <!-- --- black footer ---- -->
    <footer class="container-fluid bg-dark black-footer p-4">
        <div class="container-lg">
            <div class="row">
                <div class="col-md-4 col-sm-12 col-12 d-flex justify-content-around fs-14 me-aut">
                    <div>
                        <a href="#" class="text-white text-decoration-none">Privacy Policy</a>
                    </div>
                    <div>
                        <a href="#" class="text-white text-decoration-none">Terms & Conditions</a>
                    </div>
                </div>
                <div class="col-md-2 col-0"></div>
                <div class="col-md-6 col-sm-12 col-12 fs-14 mt-md-0 mt-4">
                    <div class="text-white copy-right"><a href="#" class="text-decoration-none"></a>Copyright <i class="fa-regular fa-copyright"></i> 2022 MowingPLowing. All right reserved.</div>
                </div>
            </div>
        </div>
    </footer>









    <script>

        const getTimeRemaining = (endTime) => {
            const time = Date.parse(endTime) - Date.parse(new Date());
            const seconds = Math.floor((time / 1000) % 60);
            const minutes = Math.floor((time / 1000 / 60) % 60);
            const hours = Math.floor((time / (1000 * 60 * 60)) % 24);
            const days = Math.floor(time / (1000 * 60 * 60 * 24));

            return {
                'total': time,
                'days': days,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        };

        const addZero = (num) => {
            if (num <= 9) {
                return '0' + num;
            } else {
                return num;
            }
        };

        const setClock = (selector, endtime) => {

            const timer = document.querySelector(".container1");
            const days = timer.querySelector("#days");
            const hours = timer.querySelector("#hours");
            const minutes = timer.querySelector("#minutes");
            const seconds = timer.querySelector("#seconds");
            const timeInterval = setInterval(updateClock, 1000);

            updateClock();

            function updateClock() {
                const t = getTimeRemaining(endtime);

                days.textContent = addZero(t.days);
                hours.textContent = addZero(t.hours);
                minutes.textContent = addZero(t.minutes);
                seconds.textContent = addZero(t.seconds);

                if (t.total <= 0) {
                    days.textContent = "00";
                    hours.textContent = "00";
                    minutes.textContent = "00";
                    seconds.textContent = "00";
                    clearInterval(timeInterval);
                }

            }
        };

        setClock('.container1', '2024-12-31');
    </script>

    <!-- icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <!-- --- js ---- -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script> -->

    <!-- <script>

        const getTimeRemaining = (endTime) => {
            const time = Date.parse(endTime) - Date.parse(new Date());
            const seconds = Math.floor((time / 1000) % 60);
            const minutes = Math.floor((time / 1000 / 60) % 60);
            const hours = Math.floor((time / (1000 * 60 * 60)) % 24);
            const days = Math.floor(time / (1000 * 60 * 60 * 24));

            return {
                'total': time,
                'days': days,
                'hours': hours,
                'minutes': minutes,
                'seconds': seconds
            };
        };

        const addZero = (num) => {
            if (num <= 9) {
                return '0' + num;
            } else {
                return num;
            }
        };

        const setClock = (selector, endtime) => {

            const timer = document.querySelector(".container1");
            const days = timer.querySelector("#days");
            const hours = timer.querySelector("#hours");
            const minutes = timer.querySelector("#minutes");
            const seconds = timer.querySelector("#seconds");
            const timeInterval = setInterval(updateClock, 1000);

            updateClock();

            function updateClock() {
                const t = getTimeRemaining(endtime);

                days.textContent = addZero(t.days);
                hours.textContent = addZero(t.hours);
                minutes.textContent = addZero(t.minutes);
                seconds.textContent = addZero(t.seconds);

                if (t.total <= 0) {
                    days.textContent = "00";
                    hours.textContent = "00";
                    minutes.textContent = "00";
                    seconds.textContent = "00";
                    clearInterval(timeInterval);
                }

            }
        };

        setClock('.container1', '2024-12-31');
    </script> -->

</body>

</html>
