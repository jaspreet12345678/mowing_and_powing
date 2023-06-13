@extends('layouts.admin')
@section('title',$pageTitle)

@push('vendor-styles')

@endpush

@push('page-styles')

<style>
    .selected {
        color: red !important;
    }
    .bg-blue {
        background: #0275D8;
        border: 1px solid #0275D8;
    }
    .text-green{
        color: #24B550;
    }
    .img-size{
        height: 150%;
    }
    .fs-15{
        font-size: 15px;
    }
    .fs-14{
        font-size: 14px;
    }
</style>

@endpush

@section('body')

<!--- heading & li start --->
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>{{ $pageTitle }}</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">
                        <i class="icofont icofont-prescription"></i>
                    </a></li>
                    @foreach ($breadCrumbs as $breadCrumb)
                        <li class="breadcrumb-item">{{$breadCrumb}}</li>
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Container-fluid cards starts-->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="email-right-aside bookmark-tabcontent">
                <div class="card email-body radius-left">
                    <div class="ps-0">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="pills-created" role="tabpanel" aria-labelledby="pills-created-tab">
                                <div class="card mb-0">
                                    <div class="card-header d-flex justify-content-center">
                                        <h3 class="fw-normal">Providers</h3>
                                    </div>
                                    <div class="card-body pb-0">
                                        <div class="details-bookmark text-center">
                                            <div class="row" id="bookmarkData">
                                                @foreach ($providers as $provider)
                                                    @if ($pageTitle == 'Favorite Providers')
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                                            <div class="card bookmark-card o-hidden border">
                                                                <div class="card-header d-flex justify-content-start details-website">
                                                                    <img class="img-size" src="{{ asset('assets/images/job-history.png') }}" alt="" class="rounded">
                                                                    <div class="favourite-icon favourite_0 "><a href="{{ route('job-history.upcoming-jobs.toggle-favorite-provider',['id'=>2]) }}">
                                                                        @if ($pageTitle == 'Favorite Providers')
                                                                            <i class="fa fa-heart selected"></i>
                                                                        @else
                                                                            <i class="fa fa-heart {{ array_search($provider->user->id,$favorites) !== false ? 'selected' : ''}}"></i>
                                                                        @endif
                                                                    </a></div>
                                                                    <div class="text-start p-4">
                                                                        <h3>{{ $provider->user->first_name.' '.$provider->user->last_name }}</h3>
                                                                        <h6 class="fw-normal fs-15">Rating: <span class="text-green">4.7/5.0</span></h6>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body px-0 pb-0">
                                                                    <div class="d-flex border-bottom-0 px-4">
                                                                        <h5 class="fw-normal fs-15">Service</h5>
                                                                        <h5 class="fw-normal fs-15">Lawn Mowing</h5>
                                                                    </div>
                                                                    <p class="p-4 fs-14 mb-0">7700 Floyd Curl Drive, San Antonio, TX, US</p>
                                                                    <div class="row">
                                                                        <div class="col-md-6 d-flex justify-content-around border-end py-3 border-top">
                                                                            <h6 class="mb-0 fs-15">Price:</h6>
                                                                            <h6 class="mb-0 fs-15">$276.57</h6>
                                                                        </div>
                                                                        <div class="col-md-6 d-flex justify-content-around py-3 border-top">
                                                                            <h6 class="mb-0 fs-15">Date:</h6>
                                                                            <h6 class="mb-0 fs-15">10-13-2022</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="d-flex justify-content-around py-3 border-bottom-0">
                                                                                <button class="btn text-danger" type="button" data-bs-toggle="modal" title="" data-bs-target="#myModal">Cancel</button>
                                                                                <a href="{{ route('favorite-providers.details',['id'=>$provider->user->id]) }}" class="btn btn-primary py-2" data-original-title="btn" title="">See Details</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                                            <div class="card bookmark-card o-hidden border">
                                                                <div class="card-header d-flex justify-content-start details-website">
                                                                    <img class="img-size" src="{{ asset('assets/images/job-history.png') }}" alt="" class="rounded">
                                                                    <div class="favourite-icon favourite_0 "><a href="{{ route('job-history.upcoming-jobs.toggle-favorite-provider',['id'=>2]) }}">
                                                                        <i class="fa fa-heart {{ array_search($provider->id,$favorites) !== false ? 'selected' : ''}}"></i>
                                                                    </a></div>
                                                                    <div class="text-start p-4">
                                                                        <h3>{{ $provider->first_name.' '.$provider->last_name }}</h3>
                                                                        <h6 class="fw-normal fs-15">Rating: <span class="text-green">4.7/5.0</span></h6>
                                                                    </div>
                                                                </div>
                                                                <div class="card-body px-0 pb-0">
                                                                    <div class="d-flex border-bottom-0 px-4">
                                                                        <h5 class="fw-normal fs-15">Service</h5>
                                                                        <h5 class="fw-normal fs-15">Lawn Mowing</h5>
                                                                    </div>
                                                                    <p class="p-4 fs-14 mb-0">7700 Floyd Curl Drive, San Antonio, TX, US</p>
                                                                    <div class="row">
                                                                        <div class="col-md-6 d-flex justify-content-around border-end py-3 border-top">
                                                                            <h6 class="mb-0 fs-15">Price:</h6>
                                                                            <h6 class="mb-0 fs-15">$276.57</h6>
                                                                        </div>
                                                                        <div class="col-md-6 d-flex justify-content-around py-3 border-top">
                                                                            <h6 class="mb-0 fs-15">Date:</h6>
                                                                            <h6 class="mb-0 fs-15">10-13-2022</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="d-flex justify-content-around py-3 border-bottom-0">
                                                                                <button class="btn text-danger" type="button" data-bs-toggle="modal" title="" data-bs-target="#myModal">Cancel</button>
                                                                                <a href="{{ route('admin.favorite-providers.details',['id'=>$provider->id,'type'=>'proposals']) }}" class="btn btn-primary py-2" data-original-title="btn" title="">See Details</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

    <script src="../assets/js/bookmark/jquery.validate.min.js"></script>
    <script src="../assets/js/bookmark/custom.js"></script>

@endpush
