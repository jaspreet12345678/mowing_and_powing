@extends('layouts.client')

@section('title',"Provider's Chat")

@push('vendor-styles')

@endpush

@push('page-styles')

<style>
    .bg-skyblue {
        background: #d3ebff !important;
        color: #2c323f !important;
    }
    .fs-12{
        font-size: 12px;
        letter-spacing: 0px
    }
    .btn-lightgray{
        background: #A8A8A8 ;
        color: #ffffff;
        border: 1px solid #A8A8A8;
    }
    .btn-green{
        background: #24B550;
        color: #ffffff;
        border: 1px solid ##24B550;
    }
    .btn-blue{
        background: #0275D8;
        color: #ffffff;
        border: 1px solid #0275D8;
    }
</style>

@endpush

@section('body')

<!--- heading & li start --->
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Job History</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">
                        <i class="icofont icofont-prescription fs-6"></i>
                    </a></li>
                    <li class="breadcrumb-item">Job History</li>
                    <li class="breadcrumb-item">Review</li>
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
                <div class="col-md-5 ">
                    <div class="card border h-100">
                        <div class="card-body px-3">
                            <h4 class="text-center pb-3">Share your experience</h4>
                            <div class="p-3 rounded-3">
                                <div class="py-2">
                                    <span class="">Rate the service</span>
                                    <span class="float-end text-muted">
                                        <i class="fa-sharp fa-solid fa-star text-warning"></i>
                                        <i class="fa-sharp fa-solid fa-star text-warning"></i>
                                        <i class="fa-sharp fa-solid fa-star text-warning"></i>
                                        <i class="fa-sharp fa-solid fa-star text-warning"></i>
                                        <i class="fa-regular fa-star text-muted"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="my-3">
                                <h5 class="pt-4">Comment</h5>
                                <textarea rows="4" cols="50" class="w-100 rounded-3 p-2" placeholder="What did you like or did'nt like this service? Share as many details as you can."></textarea>
                                <div class="row">
                                    <div class="col-md-12 fs-12 text-end text-muted pe-4">0/1000 Characters</div>
                                </div>
                            </div>
                            <div class="text-center mt-4 d-flex justify-content-center">
                                <div class="mt-4 me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="44.661" height="49.016"
                                    viewBox="0 0 44.661   49.016" class="fs-2">
                                    <defs>
                                    <filter id="Path_15843" x="0.547" y="4.895" width="44.114" height="44.121" filterUnits="userSpaceOnUse">
                                        <feOffset dy="6" input="SourceAlpha"/>
                                        <feGaussianBlur stdDeviation="3" result="blur"/>
                                        <feFlood flood-opacity="0.161"/>
                                        <feComposite operator="in" in2="blur"/>
                                        <feComposite in="SourceGraphic"/>
                                    </filter>
                                    <filter id="Path_15843-2" x="0.547" y="4.895" width="44.114" height="44.121" filterUnits="userSpaceOnUse">
                                        <feOffset dy="-2" input="SourceAlpha"/>
                                        <feGaussianBlur stdDeviation="3" result="blur-2"/>
                                        <feFlood flood-opacity="0.161" result="color"/>
                                        <feComposite operator="out" in="SourceGraphic" in2="blur-2"/>
                                        <feComposite operator="in" in="color"/>
                                        <feComposite operator="in" in2="SourceGraphic"/>
                                    </filter>
                                    <filter id="Path_15843-3" x="0" y="4.895" width="44.113" height="44.121" filterUnits="userSpaceOnUse">
                                        <feOffset dy="6" input="SourceAlpha"/>
                                        <feGaussianBlur stdDeviation="3" result="blur-3"/>
                                        <feFlood flood-opacity="0.161"/>
                                        <feComposite operator="in" in2="blur-3"/>
                                        <feComposite in="SourceGraphic"/>
                                    </filter>
                                    <filter id="Path_15843-4" x="0" y="4.895" width="44.113" height="44.121" filterUnits="userSpaceOnUse">
                                        <feOffset dy="3" input="SourceAlpha"/>
                                        <feGaussianBlur stdDeviation="3" result="blur-4"/>
                                        <feFlood flood-opacity="0.161" result="color-2"/>
                                        <feComposite operator="out" in="SourceGraphic" in2="blur-4"/>
                                        <feComposite operator="in" in="color-2"/>
                                        <feComposite operator="in" in2="SourceGraphic"/>
                                    </filter>
                                    </defs>
                                    <g id="Group_7412" data-name="Group 7412" transform="translate(-1065.968 -814.811)">
                                    <circle id="Ellipse_102" data-name="Ellipse 102" cx="20" cy="20" r="20" transform="translate(1068 814.811)" fill="#deefff"/>
                                    <g id="Group_6377" data-name="Group 6377" transform="translate(1075.515 822.705)">
                                        <g data-type="innerShadowGroup">
                                        <g transform="matrix(1, 0, 0, 1, -9.55, -7.89)" filter="url(#Path_15843)">
                                            <path id="Path_15843-5" data-name="Path 15843" d="M2181.177,1151.734c-.27-3.081.909-5.088,3.325-5.743a4.671,4.671,0,0,1,3.967,8.286c-2.014,1.453-4.328,1.152-6.442-.882l-8.467,4.232v2.521l8.48,4.244a4.745,4.745,0,0,1,3.978-1.778,4.5,4.5,0,0,1,2.75,1.12,4.67,4.67,0,0,1-4.239,8.055,4.576,4.576,0,0,1-2.839-2.166,4.687,4.687,0,0,1-.485-3.568l-8.572-4.287a4.7,4.7,0,0,1-4.112,1.769,4.535,4.535,0,0,1-3.083-1.576,4.669,4.669,0,0,1,.179-6.342c1.946-1.972,4.53-1.848,7.046.37Zm4.573-4.014a2.782,2.782,0,1,0,2.755,2.808A2.8,2.8,0,0,0,2185.75,1147.719Zm-14.016,11.182a2.782,2.782,0,1,0-2.8,2.768A2.8,2.8,0,0,0,2171.734,1158.9Zm11.208,8.319a2.781,2.781,0,1,0,2.833-2.728A2.8,2.8,0,0,0,2182.942,1167.22Z" transform="translate(-2154.74 -1137.93)" fill="#7cc0fb"/>
                                        </g>
                                        <g transform="matrix(1, 0, 0, 1, -9.55, -7.89)" filter="url(#Path_15843-2)">
                                            <path id="Path_15843-6" data-name="Path 15843" d="M2181.177,1151.734c-.27-3.081.909-5.088,3.325-5.743a4.671,4.671,0,0,1,3.967,8.286c-2.014,1.453-4.328,1.152-6.442-.882l-8.467,4.232v2.521l8.48,4.244a4.745,4.745,0,0,1,3.978-1.778,4.5,4.5,0,0,1,2.75,1.12,4.67,4.67,0,0,1-4.239,8.055,4.576,4.576,0,0,1-2.839-2.166,4.687,4.687,0,0,1-.485-3.568l-8.572-4.287a4.7,4.7,0,0,1-4.112,1.769,4.535,4.535,0,0,1-3.083-1.576,4.669,4.669,0,0,1,.179-6.342c1.946-1.972,4.53-1.848,7.046.37Zm4.573-4.014a2.782,2.782,0,1,0,2.755,2.808A2.8,2.8,0,0,0,2185.75,1147.719Zm-14.016,11.182a2.782,2.782,0,1,0-2.8,2.768A2.8,2.8,0,0,0,2171.734,1158.9Zm11.208,8.319a2.781,2.781,0,1,0,2.833-2.728A2.8,2.8,0,0,0,2182.942,1167.22Z" transform="translate(-2154.74 -1137.93)" fill="#fff"/>
                                        </g>
                                        </g>
                                    </g>
                                    <g id="Group_6378" data-name="Group 6378" transform="translate(1074.968 822.705)">
                                        <g data-type="innerShadowGroup">
                                        <g transform="matrix(1, 0, 0, 1, -9, -7.89)" filter="url(#Path_15843-3)">
                                            <path id="Path_15843-7" data-name="Path 15843" d="M2181.177,1151.734c-.27-3.081.909-5.088,3.325-5.743a4.671,4.671,0,0,1,3.967,8.286c-2.014,1.453-4.328,1.152-6.442-.882l-8.467,4.232v2.521l8.48,4.244a4.745,4.745,0,0,1,3.978-1.778,4.5,4.5,0,0,1,2.75,1.12,4.67,4.67,0,0,1-4.239,8.055,4.576,4.576,0,0,1-2.839-2.166,4.687,4.687,0,0,1-.485-3.568l-8.572-4.287a4.7,4.7,0,0,1-4.112,1.769,4.535,4.535,0,0,1-3.083-1.576,4.669,4.669,0,0,1,.179-6.342c1.946-1.972,4.53-1.848,7.046.37Zm4.573-4.014a2.782,2.782,0,1,0,2.755,2.808A2.8,2.8,0,0,0,2185.75,1147.719Zm-14.016,11.182a2.782,2.782,0,1,0-2.8,2.768A2.8,2.8,0,0,0,2171.734,1158.9Zm11.208,8.319a2.781,2.781,0,1,0,2.833-2.728A2.8,2.8,0,0,0,2182.942,1167.22Z" transform="translate(-2155.28 -1137.93)" fill="#0275d8"/>
                                        </g>
                                        <g transform="matrix(1, 0, 0, 1, -9, -7.89)" filter="url(#Path_15843-4)">
                                            <path id="Path_15843-8" data-name="Path 15843" d="M2181.177,1151.734c-.27-3.081.909-5.088,3.325-5.743a4.671,4.671,0,0,1,3.967,8.286c-2.014,1.453-4.328,1.152-6.442-.882l-8.467,4.232v2.521l8.48,4.244a4.745,4.745,0,0,1,3.978-1.778,4.5,4.5,0,0,1,2.75,1.12,4.67,4.67,0,0,1-4.239,8.055,4.576,4.576,0,0,1-2.839-2.166,4.687,4.687,0,0,1-.485-3.568l-8.572-4.287a4.7,4.7,0,0,1-4.112,1.769,4.535,4.535,0,0,1-3.083-1.576,4.669,4.669,0,0,1,.179-6.342c1.946-1.972,4.53-1.848,7.046.37Zm4.573-4.014a2.782,2.782,0,1,0,2.755,2.808A2.8,2.8,0,0,0,2185.75,1147.719Zm-14.016,11.182a2.782,2.782,0,1,0-2.8,2.768A2.8,2.8,0,0,0,2171.734,1158.9Zm11.208,8.319a2.781,2.781,0,1,0,2.833-2.728A2.8,2.8,0,0,0,2182.942,1167.22Z" transform="translate(-2155.28 -1137.93)" fill="#fff"/>
                                        </g>
                                        </g>
                                    </g>
                                    </g>
                                </svg></div>
                                <button class="btn btn-blue h-25 mt-4 fw-normal">Submit</button>
                            </div>
                            <div class="text-center mt-5">
                                <button class="btn btn-green fw-normal">Rate our App</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="empty-box h-25"></div>
                    <div class="text-center">
                        <img src="{{ asset ('assets/images/star-rating.png') }}" alt="star-rating-img" width="60%">
                    </div>
                    <div class="empty-box h-25"></div>
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

@endpush
