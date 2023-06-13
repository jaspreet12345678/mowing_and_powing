@php
    $notifications = App\Models\Notification::whereReceiverId($activeUser->id)->latest()->take(5)->get();
    $unreadNotificationsCount = App\Models\Notification::whereReceiverId($activeUser->id)->whereStatus("0")->count();
@endphp
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
    <title>@yield('title')</title>

    @include('sections.client-styles')

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
        @include('sections.client-header')
        <!-- Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">

            <!-- Page Sidebar Start-->
            @include('sections.client-sidebar')
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

    @include('sections.client-footer')

    @include('sections.client-scripts')

    @include('sections.notification-scripts')

    <script>

        function formValidations() {
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    console.log('loaded submit')
                    if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }

        (function() {
            'use strict';
            window.addEventListener('load', function() {
                formValidations()
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

                        formValidations()
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

            $('#notification-dropdown').mouseenter(function(){

                let unreadNotificationsCount = "{{ $unreadNotificationsCount }}"

                if(!$('.notification-count').hasClass('d-none')){
                    $.ajax({
                        url: "{{ route('notifications.update-status') }}",
                        type: 'get',
                        success: (res) => {
                            $('.notification-count').each(function() {
                                $(this).text(0)
                                $(this).addClass('d-none')
                            });
                        },
                        error: (error)=>{
                            errorMessage(error.responseText)
                        }
                    })
                    $('#notification-count').remove()
                }
            })

        });

        Echo.private(`notifications.{{ $activeUser->id }}`)
        .listen('.NewNotification', ({notification}) => {
            $('.notification-count').each(function() {
                $(this).text(parseInt($(this).text()) + 1)
                $(this).removeClass('d-none')
            });

            $('#notifications').prepend(`
                <li>
                    <div class="media">
                        <div class="notification-img bg-light-primary"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g>
                                                <g>
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M11.9961 2.51416C7.56185 2.51416 5.63519 6.5294 5.63519 9.18368C5.63519 11.1675 5.92281 10.5837 4.82471 13.0037C3.48376 16.4523 8.87614 17.8618 11.9961 17.8618C15.1152 17.8618 20.5076 16.4523 19.1676 13.0037C18.0695 10.5837 18.3571 11.1675 18.3571 9.18368C18.3571 6.5294 16.4295 2.51416 11.9961 2.51416Z"
                                                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path d="M14.306 20.5122C13.0117 21.9579 10.9927 21.9751 9.68604 20.5122"
                                                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </g>
                                            </g>
                                        </svg></div>
                        <div class="media-body">
                            <h5> <a class="f-14 m-0" href="user-profile.html">${notification.title}</a></h5>
                            <p>${notification.content}</p>
                            <div class="text-end">
                                <p class="fs-12">
                                    ${ new Date().toLocaleString('en-US', {timeZone: "America/New_York",month: '2-digit',day: '2-digit',year: 'numeric', hour: '2-digit', minute: '2-digit', hour12: true }) }
                                </p>
                            </div>
                        </div>
                    </div>
                </li>
            `)

            notify(notification.title,notification.content)
        });
    </script>

    @stack('page-scripts')

</body>

</html>
