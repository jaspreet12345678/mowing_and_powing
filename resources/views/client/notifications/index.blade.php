@extends('layouts.client')

@section('title',"Notifications")

@push('vendor-styles')

@endpush

@push('page-styles')

<style>
    .btn-green{
        background: #24B550;
        color: #ffffff;
        border: 1px solid ##24B550;
    }
</style>

@endpush

@section('body')

<!--- heading & li start --->
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Notifications</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">
                        <i class="icofont icofont-live-support fs-6"></i>
                    </a></li>
                    <li class="breadcrumb-item">Notifications</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Container-fluid chat-card starts-->
<div class="container-fluid">
    <div class="card border shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <ul id="all-notifications">
                        @foreach ($allNotifications as $notification)
                            <li>
                                <div class="media">
                                    <div class="notification-img bg-light-primary rounded-circle"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                                    <div class="media-body ms-4">
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
                            <hr>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-6">
                    <div class="text-center mt-5">
                        <img src="{{ asset ('assets/images/about-us.png') }}" alt="img not show" width="60%">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->




@endsection

@push('vendor-scripts')

@endpush

@push('page-scripts')
<script>
    Echo.private(`notifications.{{ $activeUser->id }}`)
    .listen('.NewNotification', ({notification}) => {
        $('#all-notifications').prepend(`
            <li>
                <div class="media">
                    <div class="notification-img bg-light-primary rounded-circle"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
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
                    <div class="media-body ms-4">
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
            <hr>
        `)

        // successMessage(notification.content)
    });
</script>
@endpush
