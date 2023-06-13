@extends('layouts.client')

@section('title','Ongoing Job Details')

@push('vendor-styles')

@endpush

@push('page-styles')

<style>
    .gmap_canvas {
        overflow: hidden;
        background: none !important;
        width: 100%;
        height: 400px;
    }

    .gmap_iframe {
        width: 100% !important;
        height: 400px !important;
    }
    .dots-content p {
        line-height: 0;
    }
    .bg-blue {
        background: #0275D8;
        border: 1px solid #0275D8;
    }
    tbody tr td p{
        color: #2c323f !important;
    }
    tbody tr{
        border: 1px solid #c9c9c9;
    }
    tbody tr td{
        padding: 1rem;
        font-size: 12px;
    }
    tbody tr td span{
        font-size: 12px;
    }
    tbody tr td .btn{
        padding: 5px;
    }
    .text-parrot{
        color: #58D109;
    }
    .bg-lightgreen{
        background: #B2FFCA;
        color: #2c323f !important;
        border-radius: 50rem;
    }
    .vl{
        position: relative;
        border-left: 3px solid #58D109;
        height: 100%;
    }
    .dots{
        position: absolute;
        left: -10px;
        font-size: 1.2rem;
        top: -1px;
    }
</style>

@endpush

@section('body')

<!--- heading & li start --->
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Ongoing Jobs Details</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">
                        <i class="icofont icofont-prescription"></i>
                    </a></li>
                    <li class="breadcrumb-item">Job History</li>
                    <li class="breadcrumb-item">Ongoing Jobs</li>
                    <li class="breadcrumb-item">Details</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid table starts-->
<div class="container-fluid list-products">
    <div class="card">
        <div class="card-body px-0">
            <div class="row pb-3">
                <div class="col-md-12 text-center">
                    <h5>Track your service</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive product-table rounded-3">
                            <table class="w-100" id="">
                                <thead class="bg-blue text-white">
                                    <tr>
                                        <th class="p-3">Address</th>
                                        <th class="p-3">Service</th>
                                        <th class="p-3">Price</th>
                                        <th class="p-3">Provider</th>
                                        <th class="p-3">Recurring status</th>
                                        <th class="p-3">Date</th>
                                        <th class="p-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $job->property->address }}</td>
                                        <td>{{ $job->category->name }}</td>
                                        <td class="text-success">${{ $job->grand_total }}</td>
                                        <td class="{{ $job->assigned_to && $job->provider ?: 'text-danger' }}">{{ $job->assigned_to && $job->provider ? $job->provider->first_name.' '.$job->provider->last_name : 'Not assigned' }}</td>
                                        <td> <span class="bg-lightgreen px-2 py-1">{{ $job->service_type == 1 ? 'One time' : 'Every '.$job->period->duration.' Days' }}</span></td>
                                        <td>{{ $job->date }}</td>
                                        <td>
                                            <a href="{{ route('job-history.jobs.details',$job->id) }}" class="btn btn-primary btn-xs"  data-original-title="btn btn-xs" title="">See Details</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="row h-100">
                        <div class="col-md-10">
                            <div class="vl ms-5">
                                <div class="dots d-flex flex-column justify-content-between h-100">
                                    <i class="fa fa-circle text-parrot"></i>
                                    <i class="fa {{ $job->on_the_way ? 'fa-circle text-parrot' : 'fa-circle-o bg-white' }}"></i>
                                    <i class="fa {{ $job->at_location_and_started_job ? 'fa-circle text-parrot' : 'fa-circle-o bg-white' }}"></i>
                                    <i class="fa {{ $job->finished_job  ? 'fa-circle text-parrot' : 'fa-circle-o bg-white' }}"></i>
                                </div>
                                <div class="dots-content d-flex flex-column justify-content-between h-100 ms-4 py-2">
                                    <p>Provider has accepted your service request.</p>
                                    <p>{{ $job->on_the_way ? 'Provider is on the way' : '' }}</p>
                                    <p>{{ $job->at_location_and_started_job ? 'Provider has reached your location and started job' : '' }}</p>
                                    <p>{{ $job->finished_job ? 'Provider has finished the job' : '' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('job-history.providers-chat.index',$job->id)}}">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="85" height="85" viewBox="0 0 85 85">
                                    <defs>
                                    <filter id="Ellipse_68" x="0" y="0" width="85" height="85" filterUnits="userSpaceOnUse">
                                        <feOffset dy="2" input="SourceAlpha"/>
                                        <feGaussianBlur stdDeviation="2.5" result="blur"/>
                                        <feFlood flood-opacity="0.161"/>
                                        <feComposite operator="in" in2="blur"/>
                                    </filter>
                                    <filter id="Ellipse_68-2" x="0" y="0" width="85" height="85" filterUnits="userSpaceOnUse">
                                        <feOffset dy="3" input="SourceAlpha"/>
                                        <feGaussianBlur stdDeviation="3" result="blur-2"/>
                                        <feFlood flood-opacity="0.161" result="color"/>
                                        <feComposite operator="out" in="SourceGraphic" in2="blur-2"/>
                                        <feComposite operator="in" in="color"/>
                                        <feComposite operator="in" in2="SourceGraphic"/>
                                    </filter>
                                    </defs>
                                    <g id="Group_7948" data-name="Group 7948" transform="translate(-896.5 -484.5)">
                                    <g id="Group_7433" data-name="Group 7433" transform="translate(571 -55)">
                                        <g id="Group_7947" data-name="Group 7947">
                                        <g data-type="innerShadowGroup">
                                            <g transform="matrix(1, 0, 0, 1, 325.5, 539.5)" filter="url(#Ellipse_68)">
                                            <g id="Ellipse_68-3" data-name="Ellipse 68" transform="translate(7.5 5.5)" fill="#dcffe7" stroke="#e7f7ec" stroke-width="1">
                                                <ellipse cx="35" cy="35" rx="35" ry="35" stroke="none"/>
                                                <ellipse cx="35" cy="35" rx="34.5" ry="34.5" fill="none"/>
                                            </g>
                                            </g>
                                            <ellipse id="Ellipse_68-4" data-name="Ellipse 68" cx="35" cy="35" rx="35" ry="35" transform="translate(333 545)" fill="#dcffe7"/>
                                            <g transform="matrix(1, 0, 0, 1, 325.5, 539.5)" filter="url(#Ellipse_68-2)">
                                            <ellipse id="Ellipse_68-5" data-name="Ellipse 68" cx="35" cy="35" rx="35" ry="35" transform="translate(7.5 5.5)" fill="#fff"/>
                                            </g>
                                            <g id="Ellipse_68-6" data-name="Ellipse 68" transform="translate(333 545)" fill="none" stroke="#e7f7ec" stroke-width="1">
                                            <ellipse cx="35" cy="35" rx="35" ry="35" stroke="none"/>
                                            <ellipse cx="35" cy="35" rx="34.5" ry="34.5" fill="none"/>
                                            </g>
                                        </g>
                                        </g>
                                        <g id="Group_7946" data-name="Group 7946">
                                        <g id="Group_7945" data-name="Group 7945">
                                            <g id="Group_7944" data-name="Group 7944">
                                            <g id="Group_7943" data-name="Group 7943">
                                                <g id="Group_6133" data-name="Group 6133" transform="translate(345.777 558.635)">
                                                <path id="Path_15272" data-name="Path 15272" d="M387.118,174.964c-1.227,0-2.288-.062-3.34.014a3.892,3.892,0,0,1-3.948-3.3,6.828,6.828,0,0,1-.136-1.442q-.015-8.622,0-17.244a4.4,4.4,0,0,1,3.186-4.621,5.63,5.63,0,0,1,1.522-.172q12.934-.015,25.867,0a4.312,4.312,0,0,1,4.678,4.618q.054,8.758,0,17.517c-.02,2.917-1.836,4.629-4.761,4.631-4.507,0-9.014,0-13.584,0-2.009,2.016-4.029,4.056-6.068,6.076a6.1,6.1,0,0,1-1.273,1,1.229,1.229,0,0,1-1.952-.846,8.372,8.372,0,0,1-.177-1.8C387.1,177.955,387.118,176.511,387.118,174.964Zm10.3-14.7a2.075,2.075,0,0,0-2.136,1.992,2.055,2.055,0,0,0,4.108.077A2.077,2.077,0,0,0,397.413,160.26Zm-4.716,2.014a2.028,2.028,0,0,0-2-2.019,2.036,2.036,0,1,0,2,2.019Zm11.343-2.019a2.032,2.032,0,1,0,1.979,2.049A2.014,2.014,0,0,0,404.04,160.256Z" transform="translate(-379.684 -148.191)" fill="#0ad117"/>
                                                <path id="Path_15273" data-name="Path 15273" d="M456.382,213.236c0,1.54.014,2.956-.007,4.373a9.463,9.463,0,0,1-.152,1.71,1.286,1.286,0,0,1-2.156.92,6.374,6.374,0,0,1-1.107-.927c-2.016-2-4.02-4.02-6.139-6.143H431.865l2.952-2.828h13.451l5.119,5.232v-5.205h6.655a2.08,2.08,0,0,0,.828-2.025q.009-7.3.005-14.609c0-.847.014-1.694-.006-2.541-.03-1.263-.527-1.754-1.766-1.774-.387-.006-.775,0-1.24,0V186.6c2.7-.555,4.971.6,5.693,2.921a5.856,5.856,0,0,1,.248,1.692q.026,8.665.008,17.331a4.844,4.844,0,0,1-1.465,3.77,3.235,3.235,0,0,1-2.291.925C458.88,213.228,457.7,213.236,456.382,213.236Z" transform="translate(-419.235 -177.198)" fill="#545454"/>
                                                </g>
                                            </g>
                                            </g>
                                        </g>
                                        </g>
                                    </g>
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="me-4">
                        {{-- <img src="{{ asset('assets/images/ongoing-map.png') }}" alt="" width="100%" height="100%"> --}}
                        <div class="gmap_canvas">
                                @if ($job->on_the_way)
                                    <iframe class="gmap_iframe" frameborder="0" scrolling="no" id="gmap_iframe"
                                        marginheight="0" marginwidth="0"
                                        src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q={{isset($job->provider->providerDetails->last_known_lat) ? $job->provider->providerDetails->last_known_lat : ''  }},{{isset($job->provider->providerDetails->last_known_lng) ? $job->provider->providerDetails->last_known_lng : ''  }}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                                    </iframe>
                                @else
                                    Provider's location is not available until provider is on the way.
                                @endif
                        </div>
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
    // Loading from resources/js/bootstrap.js => public/js/app.js
    let onTheWay = "{{ $job->on_the_way }}"
    if(onTheWay){
        Echo.private(`order-live-chat.{{ $job->id }}`)
            .listen('.ProviderLiveLocationUpdated', (data) => {
                $('.gmap_canvas').html(`<iframe class="gmap_iframe" frameborder="0" scrolling="no" id="gmap_iframe"
                    marginheight="0" marginwidth="0"
                    src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=${data.location.lat},${data.location.lng}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                </iframe>`)
            });
    }
</script>
@endpush
