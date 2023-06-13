<style>
    .d-down-1 {
        margin-right: 60px;
    }

    .d-down-1 .dropdown-toggle:after {
        top: 50%;
    }

    .d-down-1 .dropdown-menu .dropdown-item {
        opacity: 10;
    }

    .d-down-1 .dropdown-menu .d-flex img {
        border-radius: 50%;
        margin: 10px 15px;
    }

    .d-down-1 .dropdown-menu .d-flex .dropdown-item {
        font-size: 12px
    }

    .d-down-1 .dropdown-menu .d-flex .dropdown-item:hover {
        color: #24B550 !important;
    }

    .border-top-blue {
        border-top: 5px solid #0275D8 !important;
    }
</style>
<div class="page-header">
    <div class="header-wrapper row m-0">
        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper">
                <a href=""><img class="img-fluid"src="{{ asset($company->logo ?? '') }}" alt=""></a>
            </div>
            <div class="toggle-sidebar">
                <div class="status_toggle sidebar-toggle d-flex">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g>
                            <g>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M21.0003 6.6738C21.0003 8.7024 19.3551 10.3476 17.3265 10.3476C15.2979 10.3476 13.6536 8.7024 13.6536 6.6738C13.6536 4.6452 15.2979 3 17.3265 3C19.3551 3 21.0003 4.6452 21.0003 6.6738Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.3467 6.6738C10.3467 8.7024 8.7024 10.3476 6.6729 10.3476C4.6452 10.3476 3 8.7024 3 6.6738C3 4.6452 4.6452 3 6.6729 3C8.7024 3 10.3467 4.6452 10.3467 6.6738Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M21.0003 17.2619C21.0003 19.2905 19.3551 20.9348 17.3265 20.9348C15.2979 20.9348 13.6536 19.2905 13.6536 17.2619C13.6536 15.2333 15.2979 13.5881 17.3265 13.5881C19.3551 13.5881 21.0003 15.2333 21.0003 17.2619Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M10.3467 17.2619C10.3467 19.2905 8.7024 20.9348 6.6729 20.9348C4.6452 20.9348 3 19.2905 3 17.2619C3 15.2333 4.6452 13.5881 6.6729 13.5881C8.7024 13.5881 10.3467 15.2333 10.3467 17.2619Z"
                                    stroke="#130F26" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </g>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        <div class="left-side-header col ps-0 d-none d-md-block">
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
                    </svg>
                </span>
                <!-- ------ search-bar ------ -->

                <input class="form-control" type="text" placeholder="Search here.." aria-label="search"
                    aria-describedby="basic-addon1">
            </div>
        </div>
        <div class="nav-right col-10 col-sm-6 pull-right right-header p-0">
            <ul class="nav-menus">
                <!-- ------ services dropdown ------ -->
                <div class="dropdown d-down-1">
                    <button class="btn dropdown-toggle bg-white fs-6" type="button" id="dropdownMenuButton2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Order Services
                    </button>
                    <ul class="dropdown-menu dropdown-menu-dark border-5 border-top-blue bg-white "
                        aria-labelledby="dropdownMenuButton2">
                        <div class="d-flex">
                            <div>
                                <a class="dropdown-item text-dark bg-white pb-4"
                                    href="{{ route('lawn-mowing.start') }}">
                                    <img src="{{ asset('assets/images/lawn-mowing.png') }}" alt="img"
                                        width="50px" height="50px" class="">
                                    <li>Lawn Mowing</li>
                                </a>
                            </div>
                            <div>
                                <a class="dropdown-item text-dark bg-white pb-4"
                                    href="{{ route('snow-plowing.start') }}">
                                    <img src="{{ asset('assets/images/snow-plowing.png') }}" alt="img"
                                        width="50px" height="50px" class="">
                                    <li>Snow Plowing</li>
                                </a>
                            </div>
                        </div>
                    </ul>
                </div>
                <!-- <div class="dropdown">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                    Dropdown button
                    </button>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Link 1</a></li>
                    <li><a class="dropdown-item" href="#">Link 2</a></li>
                    <li><a class="dropdown-item" href="#">Link 3</a></li>
                    </ul>
                </div> -->

                <!-- ------ saved-items icon-btn ------ -->

                {{-- <li class="onhover-dropdown">
                    <div class="notification-box">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <g>
                                    <path d="M8.54248 9.21777H15.3975" stroke="#130F26" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M11.9702 2.5C5.58324 2.5 4.50424 3.432 4.50424 10.929C4.50424 19.322 4.34724 21.5 5.94324 21.5C7.53824 21.5 10.1432 17.816 11.9702 17.816C13.7972 17.816 16.4022 21.5 17.9972 21.5C19.5932 21.5 19.4362 19.322 19.4362 10.929C19.4362 3.432 18.3572 2.5 11.9702 2.5Z"
                                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="onhover-show-div bookmark-flip">
                        <div class="flip-card">
                            <div class="flip-card-inner">
                                <div class="front dropdown-title">
                                    <h3 class="mb-2">Bookmark</h3>
                                    <ul class="bookmark-dropdown pb-0">
                                        <li class="p-0">
                                            <div class="row">
                                                <div class="col-4 text-center">
                                                    <div class="bookmark-content">
                                                        <div class="bookmark-icon"><i
                                                                data-feather="file-text"></i></div>
                                                        <h5 class="mt-2"> <a href="base-input.html">Forms</a>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-center">
                                                    <div class="bookmark-content">
                                                        <div class="bookmark-icon"><i data-feather="user"></i>
                                                        </div>
                                                        <h5 class="mt-2"> <a
                                                                href="user-profile.html">Profile</a></h5>
                                                    </div>
                                                </div>
                                                <div class="col-4 text-center">
                                                    <div class="bookmark-content">
                                                        <div class="bookmark-icon"><i data-feather="server"></i>
                                                        </div>
                                                        <h5 class="mt-2"> <a
                                                                href="datatable-basic-init.html">Tables</a></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="text-center"><a class="flip-btn btn btn-primary"
                                                id="flip-btn" href="javascript:void(0)">Add New Bookmark</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="back dropdown-title">
                                    <ul>
                                        <li>
                                            <div class="bookmark-dropdown flip-back-content">
                                                <input type="text" placeholder="search...">
                                            </div>
                                        </li>
                                        <li><a class="f-w-700 d-block flip-back" id="flip-back"
                                                href="javascript:void(0)">Back</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li> --}}

                <!-- ------ notifiaction icon-btn ------ -->
                <li class="onhover-dropdown">
                    <div class="notification-box">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                        </svg>
                        <span
                            class="badge rounded-pill badge-warning notification-count {{ $unreadNotificationsCount ?: 'd-none' }}">{{ $unreadNotificationsCount }}</span>
                    </div>
                    <div class="onhover-show-div notification-dropdown" id="notification-dropdown">
                        <div class="dropdown-title">
                            <h3>Notifications</h3><a class="f-right" href="cart.html"> <i data-feather="bell">
                                </i></a>
                        </div>
                        <ul class="custom-scrollbar" id="notifications">
                            @foreach ($notifications as $notification)
                                <li>
                                    <div class="media">
                                        <div class="notification-img bg-light-primary"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g>
                                                    <g>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M11.9961 2.51416C7.56185 2.51416 5.63519 6.5294 5.63519 9.18368C5.63519 11.1675 5.92281 10.5837 4.82471 13.0037C3.48376 16.4523 8.87614 17.8618 11.9961 17.8618C15.1152 17.8618 20.5076 16.4523 19.1676 13.0037C18.0695 10.5837 18.3571 11.1675 18.3571 9.18368C18.3571 6.5294 16.4295 2.51416 11.9961 2.51416Z"
                                                            stroke="#130F26" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path
                                                            d="M14.306 20.5122C13.0117 21.9579 10.9927 21.9751 9.68604 20.5122"
                                                            stroke="#130F26" stroke-width="1.5"
                                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </g>
                                                </g>
                                            </svg></div>
                                        <div class="media-body">
                                            <h5> <a class="f-14 m-0">{{ $notification->title }}</a></h5>
                                            <p>{{ $notification->content }}</p>
                                            <div class="text-end">
                                                <p class="fs-12">
                                                    {{ Carbon\Carbon::parse($notification->created_at)->format('m/d/Y h:i a') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <li class="p-0"><a class="btn btn-primary"
                                    href="{{ route('notifications.index') }}">Check all</a></li>
                        </ul>
                    </div>
                </li>

                <!-- ------ profile icon-btn ------ -->

                <li class="profile-nav onhover-dropdown pe-0 py-0 me-0">
                    <div class="media profile-media">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g>
                                <g>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.55851 21.4562C5.88651 21.4562 2.74951 20.9012 2.74951 18.6772C2.74951 16.4532 5.86651 14.4492 9.55851 14.4492C13.2305 14.4492 16.3665 16.4342 16.3665 18.6572C16.3665 20.8802 13.2505 21.4562 9.55851 21.4562Z"
                                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M9.55849 11.2776C11.9685 11.2776 13.9225 9.32356 13.9225 6.91356C13.9225 4.50356 11.9685 2.54956 9.55849 2.54956C7.14849 2.54956 5.19449 4.50356 5.19449 6.91356C5.18549 9.31556 7.12649 11.2696 9.52749 11.2776H9.55849Z"
                                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M16.8013 10.0789C18.2043 9.70388 19.2383 8.42488 19.2383 6.90288C19.2393 5.31488 18.1123 3.98888 16.6143 3.68188"
                                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M17.4608 13.6536C19.4488 13.6536 21.1468 15.0016 21.1468 16.2046C21.1468 16.9136 20.5618 17.6416 19.6718 17.8506"
                                        stroke="#130F26" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li><a href="{{ route('editProfile') }}"><i data-feather="user"></i><span>Edit
                                    Profile</span></a>
                        </li>
                        {{-- <li><a href="#"><i data-feather="settings"></i><span>Settings</span></a>
                        </li>
                        <li><a href="#"><i data-feather="user"></i><span>Accounts</span></a>
                        </li> --}}
                        <li>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">@csrf</form>
                            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="" data-feather="power"></i>Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <script class="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">
            <div class="ProfileCard-avatar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
            </div>
    <div class="ProfileCard-details">
    <div class="ProfileCard-realName">name</div>
    </div>
    </div>
  </script>
        <script class="empty-template" type="text/x-handlebars-template">
            <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
        </script>
    </div>
</div>

<!-- Meta Pixel Code -->
<script>
    ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '950906358893798');
    fbq('track', 'PageView');
</script>

<noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=950906358893798&ev=PageView&noscript=1" /></noscript>
<!-- End Meta Pixel Code -->
