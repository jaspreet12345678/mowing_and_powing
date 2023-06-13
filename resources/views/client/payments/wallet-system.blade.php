@extends('layouts.client')

@section('title','Wallet system')

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
    .form-check-input:focus {
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgb(13 167 253 / 25%);
    }
    .form-check-input:active {
        background: #B2FFCA;
    }

    /* ----- bosex styling ------- */

        .list-group-item {
            padding: 2rem 2.8rem;
        }

        .list-group input[type="radio"] {
            display: none;
        }

        .list-group input[type="radio"] + .list-group-item {
            cursor: pointer;
        }

        .list-group input[type="radio"] + .list-group-item:before {
            content: "";
            color: transparent;
            font-weight: bold;
        }

        .list-group input[type="radio"]:checked + .list-group-item {
            background-color: #B2FFCA;
        }

        .list-group input[type="radio"]:checked + .list-group-item:before {
            color: inherit;
        }
        .list-group {
            display: flex;
            flex-direction: row;
            padding-left: 0;
            margin-bottom: 0;
            border-radius: 0.25rem;
        }

        @media(min-width: 1200px) and (max-width: 1355px){
            .box-responsive{
                width: 100%;
            }
        }
        @media(min-width: 320px) and (max-width: 518px){
            .list-group {
                flex-direction: column !important;
            }
            .responsive-mx-0{
                margin-left: 0px !important;
                margin-right: 0px !important;
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
                </a></li>
                <li class="breadcrumb-item">Payments</li>
                <li class="breadcrumb-item">Wallet system</li>
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
                        <h3 class="text-blue">M&P <i class="bg-primary px-1 rounded">Pay</i> <span class="bg-success p-1 rounded">USD {{$wallet->amount ?? '0.00'}}</span></h3>
                    </div>
                    <div class="">
                        <a href="" class="text-dark" data-bs-toggle='modal' data-bs-target='#modal-opener' data-url={{ route('payments.wallet-system.how-it-works') }}>How it works? <i class="fa-regular fa-circle-question text-primary fs-6 ms-2"></i> </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 box-responsive">
                    <div class="card border">
                        <div class="card-header bg-primary">
                            <h6 class="mb-0">Add M&P Cash</h6>
                        </div>
                        <div class="card-body px-4">
                            <div class="pb-4 ms-2">
                                <span class="fs-6">Choose amount</span>
                            </div>
                            <form action="{{route('payments.wallet-system.checkout') }}">
                                {{-- <div class="row">
                                    <div class="col-12">
                                        <div class="list-group flex-row justify-content-between">
                                            <input type="radio" name="auto_refill_amount" value="25.00" id="Radio1" {{isset($wallet->auto_refill_amount) && $wallet->auto_refill_amount == 25.00 ? 'checked' : ''}}/>
                                            <label class="list-group-item rounded-3" for="Radio1">USD 25.00</label>

                                            <input type="radio" name="auto_refill_amount" value="50.00" id="Radio2" {{isset($wallet->auto_refill_amount) && $wallet->auto_refill_amount == 50.00 ? 'checked' : ''}}/>
                                            <label class="list-group-item rounded-3 mx-3" for="Radio2">USD 50.00</label>

                                            <input type="radio" name="auto_refill_amount" value="100.00" id="Radio3" {{isset($wallet->auto_refill_amount) && $wallet->auto_refill_amount == 100.00 ? 'checked' : ''}}/>
                                            <label class="list-group-item rounded-3" for="Radio3">USD 100.00</label>
                                        </div>
                                    </div>
                                </div> --}}


                                <div class="list-group flex-row justify-content-between">
                                    <input type="radio" name="auto_refill_amount" value="25.00" id="Radio1" {{isset($wallet->auto_refill_amount) && $wallet->auto_refill_amount == 25.00 ? 'checked' : ''}}/>
                                    <label class="list-group-item rounded-3" for="Radio1">USD 25.00</label>

                                    <input type="radio" name="auto_refill_amount" value="50.00" id="Radio2" {{isset($wallet->auto_refill_amount) && $wallet->auto_refill_amount == 50.00 ? 'checked' : ''}}/>
                                    <label class="list-group-item rounded-3 mx-3 responsive-mx-0" for="Radio2">USD 50.00</label>

                                    <input type="radio" name="auto_refill_amount" value="100.00" id="Radio3" {{isset($wallet->auto_refill_amount) && $wallet->auto_refill_amount == 100.00 ? 'checked' : ''}}/>
                                    <label class="list-group-item rounded-3" for="Radio3">USD 100.00</label>
                                </div>


                                <div class="pt-5">
                                    <div class="pb-3 ms-2">
                                        <span class="fs-6">Auto refill</span>
                                    </div>
                                    <div class="row border rounded px-2 py-3 mx-1">
                                        <div class="col-xl-10 col-lg-9 col-md-9 col-sm-10 col-9 pe-lg-0">
                                            <span class="fs-12 pt-1">Automatically add cash when your balance is lower than USD {{ settings('auto_refill_limit') }}. </span>
                                        </div>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-sm-2 col-3 px-lg- px-md- px-sm-3 px-0">
                                            <label class="switch mb-0">
                                                <input type="checkbox" name="auto_refill" id="auto_refill" {{isset($wallet->auto_refill) && $wallet->auto_refill ? 'checked' : ''}}>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="m-2 mt-5">
                                        <label for="exampleFormControlTextarea1" class="form-label">Note:</label>
                                        <p>We will first deduct amount from M&P balance (if there is any) before we use your default card for order payment</p>
                                    </div>
                                    <div class="mt-5 mb-4 d-flex justify-content-center">
                                        <button class="btn btn-primary text-white px-5 mt-4">Checkout</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12 box-responsive">
                    <div class="text-end">
                    <a href="{{route('payments.add-card-index')}}" type="button" class="btn btn-outline-info border float-end mt-5 py-2 bg-white">
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
<script>
    $(function(){
        $('#auto_refill').on('click',function(e){
            e.preventDefault()
            $.ajax({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                url: "{{route('payments.wallet-system.update-wallet-setting') }}",
                type: 'post',
                data: {
                    'auto_refill' : $(this).is(':checked') ? '1' : '0',
                    'auto_refill_amount' : $('input[name="auto_refill_amount"]:checked').val()
                },
                success: function(res){
                    if(res.success){
                        $('#auto_refill').prop("checked", !$('#auto_refill').prop("checked"))
                        successMessage(res.message)
                    }else{
                        errorMessage(res.message)
                    }
                }
            })
        })

        $('input[name="auto_refill_amount"]').on('click',function(){
            $.ajax({
                headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
                url: "{{route('payments.wallet-system.update-wallet-setting') }}",
                type: 'post',
                data: {
                    'auto_refill_amount' : $('input[name="auto_refill_amount"]:checked').val()
                },
            })
        })
    });
</script>
@endpush
