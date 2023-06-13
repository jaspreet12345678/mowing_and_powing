@extends('layouts.client')

@section('title','Recurring Job Details')

@push('vendor-styles')

@endpush

@push('page-styles')

<style>
    .gap-15{
        gap: 15px;
    }
    .text-blue {
        color: #0275D8;
    }
    .fs-14 {
        font-size: 14px;
    }
    .fs-15 {
        font-size: 15px;
    }
    .fs-10 {
        font-size: 10px;
    }
    .text-green{
        color: #24B550;
    }
    .border {
        border: 1px solid #d4d7da !important;
    }
    /* .btn-green{
        background: #24B550 !important;
        color: #ffffff !important;
        border: 1px solid #24B550 !important;
    } */
    .btn-green{
        background: #24B550 !important;
        color: #ffffff !important;
        border: 1px solid #24B550 !important;
    }
    .modal-dialog {
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
                <h3>Recurring Job Details</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">
                        <i class="icofont icofont-prescription"></i>
                    </a></li>
                    <li class="breadcrumb-item">Recurring Jobs</li>
                    <li class="breadcrumb-item">Details</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!--- card content start --->

<div class="conatiner-fluid">
    <div class="card border">
        <div class="card-body ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card border">
                        <div class="card-header bg-primary text-center">
                            <h5 class="mb-0 fw-normal">Service Details</h5>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <div class="row">
                                <div class="col-md-5 border-2 border-end pe-0">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4">
                                                <h6 class="mb-0">Status</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4 text-end">
                                                 <h6 class="mb-0 {{ $jobDetails->status == 'Active' ? 'text-success' : 'text-danger' }}">{{ $jobDetails->status }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-0">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4">
                                                <h6 class="mb-0">Recurring Status</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4 text-end">
                                                 <h6 class="mb-0">Every {{ $jobDetails->on_every }} days</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-0">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4">
                                                <h6 class="mb-0">Next order on</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4 text-end">
                                                 <h6 class="mb-0">{{ $jobDetails->date }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-0">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4">
                                                <h6 class="mb-0">Service</h6>
                                            </div>
                                        </div>
                                         <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4 text-end">
                                                 <h6 class="mb-0">{{ $jobDetails->category->name }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($jobDetails->gate_code)
                                        <hr class="my-0">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4">
                                                    <h6 class="mb-0">Gate code</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    <h6 class="mb-0">{{ $jobDetails->gate_code }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($jobDetails->lawnSize->name ?? false)
                                        <hr class="my-0">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4">
                                                    <h6 class="mb-0">Lawn size</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    <h6 class="mb-0">{{ $jobDetails->lawnSize->name }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($jobDetails->cornerLot)
                                        <hr class="my-0">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4">
                                                    <h6 class="mb-0">Corner lot</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    <h6 class="mb-0">Yes</h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if ($jobDetails->fence)
                                        <hr class="my-0">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4">
                                                    <h6 class="mb-0">Fence</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    <h6 class="mb-0">{{ $jobDetails->fence->name }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <hr class="my-0">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4">
                                                <h6 class="mb-0">Grand Total</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4 text-end">
                                                 <h6 class="mb-0">${{ $jobDetails->grand_total }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-0">
                                </div>
                                <div class="col-md-7">
                                    @php
                                        $order = \App\Models\Order::whereOrderId($jobDetails->order_id)->first();
                                    @endphp
                                    @if (count($order->images) != 0)
                                        <div class="row pt-4 px-2">
                                            <div class="col-md-3">
                                                <h6>{{ $order->service_for ?? 'Lawn' }} images</h6>
                                            </div>
                                            <div class="col-md-9 ps-0">
                                                <div class="card">
                                                    <div class="card-body p-2 shadow d-flex flex-wrap gap-15">
                                                        @foreach ($order->images as $image)
                                                            <img src="{{ asset($image->image) }}" alt="" width="100px">
                                                        @endforeach
                                                        {{-- <img src="{{ asset('assets/images/upcoming-img-2.png') }}" alt="" width="100px" height="100px">
                                                        <img src="{{ asset('assets/images/upcoming-img-3.png') }}" alt="" width="100px" height="100px">
                                                        <img src="{{ asset('assets/images/upcoming-img-4.png') }}" alt="" width="100px" height="100px"> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row px-2 pt-4">
                                        <div class="col-md-3">
                                            <h6>Service location</h6>
                                        </div>
                                        <div class="col-md-9 ps-0">
                                            <div class="border rounded-2 px-2 pt-3 pb-0 d-flex gap-15 flex-wrap">
                                                <h6 class="fs-14">Address:</h6>
                                                <h6 class="text-green fs-15">{{ $jobDetails->property->address }}</h6>
                                                <h6 class="text-blue">
                                                    <i class="fa fa-map-marker fs-5"></i>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-4 mt-4 px-2">
                                        <div class="col-md-3">
                                            <h6>Status</h6>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="px-3">
                                                <div class="row border py-1 px-0 bg-dark rounded-3">
                                                    <div class="col-md-2"></div>
                                                    <div class="col-md-8 px-0">
                                                        <span class="float-start">{{ $jobDetails->on_the_way ? 'On his way' : '' }}</span>
                                                        <span class="float-end">{{ $jobDetails->finished_job ? 'Finished Job' : '' }}</span>
                                                    </div>
                                                    <div class="col-md-2"></div>

                                                    <div class="u-pearl current col-3">
                                                        <div class="u-pearl-number"></div>
                                                    </div>
                                                    <div class="u-pearl current col-3">
                                                        <div class="u-pearl-number"></div>
                                                    </div>
                                                    <div class="u-pearl current col-3">
                                                        <div class="u-pearl-number"></div>
                                                    </div>
                                                    <div class=" current col-3">
                                                        <div class="u-pearl-number-4"></div>
                                                        <span class="u-pearl-title"></span>
                                                    </div>
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4 text-center">
                                                        <span class="">{{ $jobDetails->at_location_and_started_job ? 'Started Job' : '' }}</span>
                                                    </div>
                                                    <div class="col-md-4"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row px-2 pt-4">
                                        @if ($jobDetails->instructions)
                                            <div class="col-md-12 pb-2 mt-4">
                                                <h6 class="border-bottom pb-4">Instructions:</h6>
                                            </div>
                                            <div class="col-md-12 pb-3">
                                                <h6><span><i class="fa-solid fa-circle fs-10 me-2"></i></span>{{ $jobDetails->instructions }}</h6>
                                            </div>
                                        @endif
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9 ps-0 mt-4">
                                            <div class="border-2 shadow rounded-3 bg-dark py-2 px-4 d-flex justify-content-between">
                                                <p class="mb-0">Total Price</p>
                                                <p class="mb-0">${{ $jobDetails->grand_total }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ----- 2 buttons -------- --}}
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    @if ($jobDetails->status == 3 || $jobDetails->status == 4)
                        <button type="button" class="btn btn-green py-2 px-5 fw-normal" data-bs-toggle="modal" title="" data-bs-target="#myModal">Reorder</button>
                    @endif

                    <!-- The Modal start-->
                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header flex-column px-4">
                                    <div class="col-md-12">
                                        <h6 class="text-end text-muted">Sep 10 at 9:46 AM</h6>
                                        <div class="text-center py-2">
                                            <img src="{{ asset ('assets/images/client.png') }}" alt="client-img">
                                            <h4 class="text-dark fw-normal px-5 pt-4 mb-0">John doe completed his job.</h4>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer justify-content-center py-3">
                                    <button class="btn btn-green w-25 fw-normal" type="button" data-original-title="btn" title="">Accept</button>
                                    <button class="btn btn-danger w-25 fw-normal" type="button" data-original-title="btn"title="">Decline</button>
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




@endsection

@push('vendor-scripts')

@endpush

@push('page-scripts')

@endpush
