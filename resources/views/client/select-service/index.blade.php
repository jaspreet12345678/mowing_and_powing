<!DOCTYPE html>
<html>

<head>
    <title>Select Service</title>
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
           height: 92vh;
       }

       .address-card {
           background-color: rgba(99, 98, 231, 0.1);
           height: auto;
           /* display: -webkit-box; */
           display: -ms-flexbox;
           /* display: flex; */
           -webkit-box-align: center;
           -ms-flex-align: center;
           align-items: center;
           -webkit-box-pack: center;
           -ms-flex-pack: center;
           /* justify-content: center; */
           /* min-height: 100vh; */
           margin: 0 auto;
           padding: 130px 0px 0 0;
       }

       /* .d-down-1{
           margin-right: 30px;
       } */

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
                <img class="img-fluid " src="{{$company->logo ?? ''}}" alt="logo" width="150">
            </a>
        </div>
    </nav>
    <!-- Page Header Ends  -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12 p-0 bg-skyblue h-100vh ">
                <div class="address-card">
                    <div class="login-form">
                        <h2>Select service</h2>
                        <p class="mt-3 text-start">Kindly choose between Lawn mowing and Snow plowing.</p>

                        <div class="d-flex flex-column justify-content-between mt-5 w-100">
                            <form action="{{ route('lawn-mowing.start-order') }}" method="post" id="lawn-mowing-form">
                                @csrf
                                <input type="hidden" name="address" value="{{ $address }}">
                                <input type="hidden" name="lat" value="{{ $lat }}">
                                <input type="hidden" name="lng" value="{{ $lng }}">
                                <div>
                                    <a class="dropdown-item text-dark bg-white pb-4 text-center" href="#" id="lawn-mowing">
                                        <img src="{{ asset('assets/images/lawn-mowing.png') }}" alt="img" width="50px" height="50px" class="">
                                        <h4>Lawn Mowing</h4>
                                    </a>
                                </div>
                            </form>
                            <hr>
                            <form method="post" id="snow-plowing-form">
                                @csrf
                                <input type="hidden" name="address" value="{{ $address }}">
                                <input type="hidden" name="lat" value="{{ $lat }}">
                                <input type="hidden" name="lng" value="{{ $lng }}">
                                <div>
                                    <a class="dropdown-item text-dark bg-white pb-4 text-center">
                                        <img src="{{ asset('assets/images/snow-plowing.png') }}" alt="img" width="50px" height="50px" class="">
                                        <h4>Snow Plowing</h4>
                                    </a>
                                </div>
                                <div>
                                    <a class="btn btnGray snow-plowing-service" data-type="home" href="#">Home</a>
                                    <a class="btn btnGray snow-plowing-service" data-type="business" href="#">Business</a>
                                    <a class="btn btnGray snow-plowing-service" data-type="car" href="#">Car</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <img class="w-100" src="../assets/images/green.png" alt="grass-img">
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12 col-12 p-0 ">
                <img class="img-fluid h-100vh w-100" src="../assets/images/pexels-gustavo-fring.png" alt="">
            </div>

        </div>
    </div>

    <!-- latest jquery-->
    <script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/notify/bootstrap-notify.min.js') }}"></script>

    @stack('vendor-scripts')

    @include('sections.notification-scripts')

    <script>
        $(function() {

            // window.addEventListener('message', (event) => {
            //     if (event.data?.category) {
            //         if(event.data.category == 'lawn-mowing') {
            //             $('#lawn-mowing-form').submit()
            //         } else {
            //             $('#snow-plowing-form').attr('action',"{{ route('snow-plowing.address.post',['type'=>'_type_']) }}".replace('_type_',event.data.type))
            //             $('#snow-plowing-form').submit()
            //         }
            //     }
            // });

            $('#lawn-mowing').click(function(){
                // $.ajax({
                //     url: "{{ route('auth-check') }}",
                //     type: 'get',
                //     success: function(res){
                //         if(res.authenticated){
                //             $('#lawn-mowing-form').submit()
                //         } else {
                            
                    $('#lawn-mowing-form').submit()

                            localStorage.setItem('redirectCategory', 'lawn-mowing');
                            localStorage.setItem('redirectType', '');
                            localStorage.setItem('address', "{{ $address }}");
                            localStorage.setItem('lat', "{{ $lat }}");
                            localStorage.setItem('lng', "{{ $lng }}");
                            //window.location = "{{ route('web.login') }}"
                            // window.open("{{ route('web.login') }}",'_blank','location=yes,height=800,width=800,scrollbars=yes,status=yes');
                //         }
                //     },
                //     error: function(err){
                //         errorMessage(err.responseJSON)
                //     }
                // })
            })

            $('.snow-plowing-service').click(function(){
                let that = this
                // $.ajax({
                //     url: "{{ route('auth-check') }}",
                //     type: 'get',
                //     success: function(res){
                //         if(res.authenticated){
                //             $('#snow-plowing-form').attr('action',"{{ route('snow-plowing.address.post',['type'=>'_type_']) }}".replace('_type_',$(that).data('type')))
                //             $('#snow-plowing-form').submit()
                //         } else {

                            $('#snow-plowing-form').attr('action',"{{ route('snow-plowing.address.post',['type'=>'_type_']) }}".replace('_type_',$(that).data('type')))
                            $('#snow-plowing-form').submit()

                            localStorage.setItem('redirectCategory', 'snow-plowing');
                            localStorage.setItem('redirectType', $(that).data('type'));
                            localStorage.setItem('address', "{{ $address }}");
                            localStorage.setItem('lat', "{{ $lat }}");
                            localStorage.setItem('lng', "{{ $lng }}");
                            //window.location = "{{ route('web.login') }}"
                            // window.open("{{ route('web.login') }}", '_blank', 'location=yes,height=800,width=800,scrollbars=yes,status=yes');
                //         }
                //     },
                //     error: function(err){
                //         errorMessage(err.responseJSON)
                //     }
                // })

            })

        });
   </script>

</body>

</html>