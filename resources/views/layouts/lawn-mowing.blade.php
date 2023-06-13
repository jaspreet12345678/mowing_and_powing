<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="{{ $company->name ?? '' }} admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, {{ $company->name ?? '' }} admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">

    <!-- ######## fontawesome link ####### -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" href="{{ asset( $company->favicon ?? '') }}"
        type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset( $company->favicon ?? '') }}"
        type="image/x-icon">
    <title>@yield('title') - Lawn Mowing</title>

    @include('sections.lawn-mowing-styles')

    @stack('page-styles')

</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="loader">
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-bar"></div>
            <div class="loader-ball"></div>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">

            <!-- Page Sidebar Start-->
            @include('sections.lawn-mowing-sidebar')
            <!-- Page Sidebar Ends-->
            <div class="page-body">
                @yield('body')
            </div>
        </div>
    </div>

    <!-- Modal Opener -->
    {{-- <div class="modal modal-slide-in new-user-modal fade" id="modal-opener">
        <div class="modal-dialog">

        </div>
    </div> --}}

    <div class="modal fade bd-example-modal-lg show" id="modal-opener">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3></h3>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"
                        data-bs-original-title="" title=""></button>
                </div>
                <div class="modal-body">...</div>
            </div>
        </div>
    </div>

    @include('sections.lawn-mowing-footer')

    @include('sections.lawn-mowing-scripts')

    @include('sections.notification-scripts')

    <script>
        $(function () {
            'use strict';

            var modal = document.getElementById('modal-opener')
            modal.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                var button = event.relatedTarget
                // Extract info from data-bs-* attributes
                var url = button.getAttribute('data-url')
                var title = button.getAttribute('data-title')
                $.ajax({
                    url: url,
                    success: function (data) {
                        $('#modal-opener .modal-body').html(data);
                        $('#modal-opener h3').html(title);
                        $("#modal-opener").modal('show');
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        $.notify('<i class="fa fa-warning"></i>' + data.message, {
                            type: 'danger',
                            allow_dismiss: true,
                            delay: 10000,
                            showProgressbar: true,
                            timer: 10,
                            animate: {
                                enter: 'animated fadeInDown',
                                exit: 'animated fadeOutUp'
                            }
                        });
                    }
                });
            })
        });

    </script>

    @stack('page-scripts')

</body>

</html>
