@extends('layouts.client')

@section('title','Checkout')

@push('vendor-styles')

@endpush

@push('page-styles')

<style>
    .text-blue {
        color: #0275D8;
    }
    .bg-lightred {
        background: #F6F6F6;
    }
    .bg-lightgreen {
        background: #D9FFE5;
        position: relative;
        border: #B2FFCA;
    }
    .dollar-icon {
        position: absolute;
        bottom: 36px;
        left: 32px;
    }
    .fs-12 {
        font-size: 12px;
    }
    .btn-blue {
        background: #0275D8;
        border: 1px solid #0275D8;
    }
    .modal-dialog {
        max-width: 500px;
        margin: 18rem auto;
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
                <li class="breadcrumb-item">Wallet system</li>
                <li class="breadcrumb-item">Checkout</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="conatiner-fluid">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 py-4 d-flex justify-content-between">
                    <div>
                        <h3 class="text-blue">M&P <i class="bg-primary px-1 rounded">Pay</i> <span class="bg-success p-1 rounded">USD {{$wallet->amount}}</span></h3>
                    </div>
                    <div class="">
                        <a href="" class="text-dark" data-bs-toggle='modal' data-bs-target='#modal-opener' data-url={{ route('payments.wallet-system.how-it-works') }}>How it works? <i class="fa-regular fa-circle-question text-primary fs-6 ms-2"></i> </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card border">
                        <div class="card-header bg-primary">
                            <h6 class="mb-0">Add M&P Cash</h6>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-6">
                                    <div class="p-4 text-center">
                                        <h6 class="mb-0">M & P Cash</h6>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-6">
                                    <div class="p-4 text-center">
                                        <h6 class="mb-0">USD {{ $wallet->auto_refill_amount }}</h6>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-6">
                                    <div class="p-4 text-center">
                                        <h6 class="mb-0">Total</h6>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-6">
                                    <div class="p-4 text-center">
                                        <h6 class="mb-0">USD {{ $wallet->auto_refill_amount }}</h6>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0">
                            <div class="pt-4 px-4">
                                <div class="d-flex justify-content-between border rounded px-2 py-2" data-bs-toggle="modal" data-bs-target="#myModal">
                                    <span class="fs-12 pt-1">Choose payment method</span>
                                    <div>
                                        @if ($defaultCard)
                                            <span><i class="text-blue fs-6 fw-bold">{{ strtoupper($defaultCard->brand) }}</i> **** **** **** {{$defaultCard->last4}}</span>
                                        @else
                                            <img src="{{ asset('assets/images/paypal.jpg') }}" alt="" width="30px">
                                        @endif
                                        <i class="fa-solid fa-angle-down ms-3 text-primary"></i>
                                    </div>
                                </div>

                                {{-- ------ lightgreen banner ----- --}}
                                @if ($wallet->auto_refill)
                                    <div class="bg-lightgreen px-3 py-3 d-flex rounded mt-4">
                                        <i class="fa-solid fa-arrows-rotate fa-3x"> </i>
                                        <span class="text-blue dollar-icon fw-bold fs-6">$</span>
                                        <span class="d-block ms-3 fs-12">This payment method will be automatically charged USD {{$wallet->auto_refill_amount}} When your balance is low USD {{ settings('auto_refill_limit') }}. You can change this later in the payment tab.</span class="d-block ms-2">
                                    </div>
                                @endif

                                <div>
                                    <form action="{{ route('payments.wallet-system.purchase') }}" method="post" class="mt-5 mb-4 d-flex justify-content-center">
                                        @csrf
                                        <input type="hidden" name="card_id" value="{{$defaultCard->card_id ?? ''}}">
                                        <input type="hidden" name="auto_refill_amount" value="{{$wallet->auto_refill_amount ?? ''}}">
                                        <button class="btn btn-blue text-white shadow mt-5 w-50" >Purchase</button>
                                    </form>

                                    <!-- The Modal start-->
                                    <div class="modal" id="myModal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header flex-column px-4">
                                                    <div class="col-md-12 ">
                                                        <div class="text-end">
                                                            <i class="fa-solid fa-circle-xmark fa-2x" data-bs-dismiss="modal"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="text-center">
                                                            <h4 class="text-dark fw-normal my-3">Select payment method</h4>
                                                            <span class="fs-12">This payment method will be default to refill M&P Cash</span>
                                                            @foreach ($cards as $card)
                                                                <form action="{{ route('payments.wallet-system.checkout') }}" id="{{$card->card_id}}">
                                                                    @csrf
                                                                    <input type="hidden" name="default_card_id" value="{{$card->id}}">
                                                                    <div type="submit" onclick="document.getElementById('{{$card->card_id}}').submit()" class="d-flex justify-content-between mt-3">
                                                                        <div class="text-star"><i class="text-blue fs-6 fw-bold">{{ strtoupper($card->brand) }}</i> **** **** **** {{$card->last4}}</div>
                                                                        @if ($card->is_default == '1')
                                                                            <div class="text-en">
                                                                                <i class="fas fa-check fa-2x text-success"></i>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </form>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer justify-content-around py-4">
                                                    <a href="{{route('payments.add-card-index')}}" type="button" class="btn btn-outline-info border float-end bg-white"><i class="fa fa-plus pe-2" aria-hidden="true"></i> Add payment method</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- The Modal end-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-end">
                    <a href="{{route('payments.add-card-index')}}" type="button" class="btn btn-outline-info border float-end mt-4 py-2 bg-white">
                        <i class="fa fa-plus pe-2" aria-hidden="true"></i> Add payment method</a>
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
