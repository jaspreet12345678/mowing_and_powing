@extends('layouts.client')

@section('title',"About us")

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
                <h3>About Us</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">
                        <i class="icofont icofont-live-support fs-6"></i>
                    </a></li>
                    <li class="breadcrumb-item">About us</li>
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
                    <div class="card border h-100">
                        <div class="card-body px-4">
                            <h4 class="pb-2">About us</h4>
                            @php
                                $aboutUs = \App\Models\AboutUs::first()
                            @endphp
                            <p>{!! $aboutUs ? $aboutUs->description : '' !!}</p>
                            <div class="text-center mt-5">
                                <button class="btn btn-green w-50 mt-4 fw-normal">Learn more</button>
                            </div>
                        </div>
                    </div>
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

@endpush
