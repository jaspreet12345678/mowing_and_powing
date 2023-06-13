@extends('layouts.client')

@section('title', 'Add Card')

@push('vendor-styles')
@endpush

@push('page-styles')
    <style>
        .text-blue {
            color: #0275D8;
        }

        .fs-12 {
            font-size: 12px;
        }

        .btn-blue {
            background: #0275D8;
            border: 1px solid #0275D8;
            color: #fff

        }
        .btn-blue:hover {
            background: #0368c0;
            border: 1px solid #0368c0;
            color: #fff

        }

        .btn-green {
            background: #24B550;
            border: 1px solid #24B550;
            color: #fff
        }
        .btn-green:hover {
            background: #20a348;
            border: 1px solid #20a348;
            color: #fff
        }

        .dot {
            height: 30px;
            width: 30px;
            /* background-color: : #fff6f6; */
            border-radius: 50%;
            display: inline-block;
            padding-left: 7px;
            padding-top: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            color: #24B550;
        }

        .fs-14 {
            font-size: 14px;
        }
        .stripe-img{
            text-align: end;    
        }
        @media (max-width: 768px) {
            .heading {
                text-align: center;
            }
            .stripe-img{
                text-align: center;
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
                    <h3>Payments</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href=""></a>
                            <i class="fa-regular fa-credit-card"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Payments</li>
                        <li class="breadcrumb-item">Add Card</li>
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
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="d-flex">
                                    <div class="dot me-3">
                                        <i class="fas fa-university fs-6"></i>
                                    </div>
                                    <h3 class="pt-1">Add Credit or Debit Card</h3>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">

                                <div class="mt-4">
                                    <h5>How would you like to pay?</h5>
                                    <p>This method will be used for service payments</p>
                                </div>

                                {{-- <div class="">

                                    <div class="card-header pb-0">
                                    <h6 class="fs-5 mb-0">Add card</h6>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @include('client.payments.__card-form')
                                </div> --}}


                                <div>
                                    @include('client.payments.__card-form')
                                </div>


                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12 mt-md-0 mt-4">
                                <div class="row py-4">
                                    <div class="col-xxl-2 col-xl-0"></div>
                                    <div class="col-xxl-5 col-xl-6 col-lg-4 col-md-5 col-sm-6 col-12 text-center pe-xl-0 px-lg-0">
                                        <h3 class="text-blue mt-2">M&P <i class="bg-primary px-1 rounded">Pay</i></h3>
                                    </div>
                                    <div class="col-xxl-5 col-xl-6 col-lg-8 col-md-7 col-sm-6 col-12 text-center mt-sm-0 mt-4">
                                        <a href="{{ route('payments.wallet-system') }}" type="button"
                                            class="btn btn-outline-info border py-2 bg-white"> Add M&P
                                            Cash</a>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-center py-5">
                                    <img src="{{ asset('assets/images/payment-img81.png') }}" alt="payment-img81.png"
                                        width="50%">
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
