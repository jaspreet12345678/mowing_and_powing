@extends('layouts.client')

@section('title','FAQs')

@push('vendor-styles')

@endpush

@push('page-styles')

<style>
    .vl {
        border-left: 3px solid #0275D8;
        height: 100%;
        position: relative;
    }
    .dots{
        position: absolute;
        bottom: 0rem;
        left: 25px;
    }
    .dot {
        height: 25px;
        width: 25px;
        background-color: #E6F3FF;
        border:1px solid #0275D8;
        border-radius: 50%;
        display: inline-block;
        padding-left: 8px;
        padding-top: 2px;
    }
    .d-2 {
        margin-top: 85px;
    }
    .d-3 {
        margin-top: 190px;
    }
    .d-4 {
        margin-top: 180px;
    }

    @media (min-width: 320px ) and (max-width: 575px){
        .dots {
            left: 0px;
        }
    }
</style>

@endpush

@section('body')

<!--- heading & li start --->
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>FAQs</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">
                        </a>
                            <i class="icofont icofont-live-support fs-6"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">FAQs</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center fw-normal">FAQs</h3>
                    <div class="row pt-5">
                        <div class="col-lg-1 col-md-1 col-sm-1 col-1">
                            <div class="vl mx-md-4 mx-sm-4 col-4"></div>
                            <div class="dots d-flex flex-column justify-content h-100">
                                <div class="dot d-1">1</div>
                                <div class="dot d-2">2</div>
                                <div class="dot d-3">3</div>
                                <div class="dot d-4">4</div>
                            </div>

                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-11 col-10">
                            @foreach (\App\Models\Faq::whereType('customer')->get() as $faq)
                                <div class="mt-3">
                                    <h5>{{ $faq->question }}</h5>
                                    <p>{!! $faq->answer !!}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="d-flex justify-content-center py-5 mt-5">
                                <img src="{{asset('assets/images/FAQs.png')}}" alt="image-not-show" width="80%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection

@push('vendor-scripts')

@endpush

@push('page-scripts')

@endpush
