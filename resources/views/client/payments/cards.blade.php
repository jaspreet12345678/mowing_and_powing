@extends('layouts.client')

@section('title','Cards')

@push('vendor-styles')

@endpush

@push('page-styles')

<style>
    .text-blue{
        color: #1d97ff !important;
    }
    .bg-lightred{
        background: #F6F6F6;
    }
    .bg-lightgreen{
        background: #B2FFCA;
    }
    .fs-12{
        font-size: 12px;
    }
    .btn-blue{
        background: #1d97ff;
        border: 1px solid #1d97ff;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 26px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 0px;
        bottom: 0px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
        border: 2px solid #d9d9d9;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>

@endpush

@section('body')

<!--- heading & li start --->
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Payments</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""></a>
                <i class="fa-regular fa-credit-card"></i>
                </a></li>
                <li class="breadcrumb-item">Payments</li>
                <li class="breadcrumb-item">Cards</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="conatiner-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-end">
                        <a href="{{route('payments.add-card-index')}}" type="button" class="btn btn-outline-info border float-end py-2 bg-white">
                        <i class="fa fa-plus pe-2" aria-hidden="true"></i> Add payment method</a>
                    </div>
                </div>
            </div>

            {{-- ------ 2 horizontal cards ------ --}}
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="card border rounded h-100">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <div>
                                <h3 class="text-blue">M&P <i class="bg-primary px-1 rounded">Pay</i></h3>
                                <span class="mb-0">USD {{ $wallet->amount ?? '0.00' }}</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="p-4">
                                <p>Any service charges exceeding your M&P balance will be charge to your default payment method</p>
                            </div>
                            <div class="card-footer border-top pt-5">
                                <div class="col-md-12 d-flex justify-content-around">
                                    <div class="me-sm-5">
                                        <h3 class="text-blue mt-2">M&P <i class="bg-primary px-1 rounded">Pay</i></h3>
                                    </div>
                                    <div>
                                        <a href="{{route('payments.wallet-system')}}" type="button" class="btn btn-outline-info border float-end py-2 bg-white"> Add M&P Cash</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border rounded h-100">
                        <div class="card-body px-0">
                            <h6 class="px-4 mb-4 pb-2">Payment Methods</h6>
                            @foreach ($cards as $card)
                                <div class="d-flex justify-content-between px-4">
                                    <span><i class="text-blue fs-6 fw-bold">{{ strtoupper($card->brand) }}</i> **** **** **** {{$card->last4}}</span>
                                    @if($card->is_default == '1')
                                        <div>
                                            <i class="fas fa-check fa-2x text-success"></i>
                                        </div>
                            @else
                                        <div class="dropdown">
                                            <i class="fas fa-ellipsis-h" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                            <ul class="dropdown-menu bg-white" aria-labelledby="dropdownMenuButton1">
                                                <li><a class="dropdown-item" href="{{route('payments.cards.default',$card->id)}}">Make it as default</a></li>
                                                <li><a class="dropdown-item" href="#" id="delete-data" data-url={{route('payments.cards.delete',$card->id)}}>Delete</a></li>
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                                <hr>
                            @endforeach
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
