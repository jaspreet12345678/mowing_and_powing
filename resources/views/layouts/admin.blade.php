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
    <link rel="icon" href="{{ asset( $company->favicon ?? '') }}"
        type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset( $company->favicon ?? '') }}"
        type="image/x-icon">
    <title>@yield('title') - Admin</title>

    @include('sections.admin-styles')

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
        @include('sections.admin-header')
        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            @include('sections.admin-sidebar')
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

    @include('sections.admin-footer')

    @include('sections.admin-scripts')

    @include('sections.notification-scripts')

    <script>

(       function() {
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
