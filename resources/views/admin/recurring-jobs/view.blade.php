@extends('layouts.admin')

@section('title', 'Admins')

@section('title', 'Job Details')

@push('vendor-styles')
@endpush

@push('page-styles')
    <style>
        .gap-15 {
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

        .text-green {
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
        .btn-green {
            background: #24B550 !important;
            color: #ffffff !important;
            border: 1px solid #24B550 !important;
        }

        .modal-dialog {
            margin: 18rem auto;
        }
    </style>
    <style>
        /* Style the Image Used to Trigger the Modal */
        img {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        img:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        #image-viewer {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            margin: auto;
            display: block;
            width: 100%;
            max-width: 700px;
        }

        .modal-content {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }


        #image-viewer .close:hover,
        #image-viewer .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 50%;
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
                    <h3>Recurring History</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">
                                <i class="icofont icofont-prescription"></i>
                            </a></li>
                        <li class="breadcrumb-item">Recurring History</li>
                        <li class="breadcrumb-item">Orders</li>
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
                                <h5 class="mb-0 fw-normal">Recurring Details</h5>
                            </div>
                            <div class="card-body px-0 pt-0">
                                <div class="row">
                                    <div class="col-md-5 border-2 border-end pe-0">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4">
                                                    <h6 class="mb-0">Order ID</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    <h6 class="mb-0">{{ $jobDetails->order_id }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-0">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4">
                                                    <h6 class="mb-0">Service Provider</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    <h6 class="mb-0">
                                                        {{ $jobDetails->assigned_to ? $jobDetails->provider->first_name . ' ' . $jobDetails->provider->last_name : 'Not assigned' }}
                                                    </h6>
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
                                                    <h6 class="mb-0">Lawn Mowing</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="my-0">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4">
                                                    <h6 class="mb-0">Service Delivery</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    <h6 class="mb-0">{{ 'Every ' . $jobDetails->on_every . ' Days' }}</h6>
                                                </div>
                                            </div>
                                        </div>


                                        <hr class="my-0">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4">
                                                    <h6 class="mb-0">Schedule Date</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    <h6 class="mb-0"> <?php echo date('Y-m-d', strtotime($jobDetails->date)); ?></h6>

                                                </div>
                                            </div>
                                        </div>

                                        @if (isset($jobDetails->status))
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Subscription Status</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0"><strong>{{ $jobDetails->status }}</strong></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif()

                                        <hr class="my-0">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4">
                                                    <h6 class="mb-0">Reason</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    <h6 class="mb-0">
                                                        {{ isset($jobDetails->status_reason) ? $jobDetails->status_reason : '' }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>

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

                                        @if ($jobDetails->lawn_size_amount)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">lawn Size</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">
                                                            {{ isset($jobDetails->lawn_size_amount) ? $jobDetails->lawn_size_amount : '' }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif()

                                        @if ($jobDetails->fence_amount ?? false)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Fence</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">{{ $jobDetails->fence_amount }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($jobDetails->corner_lot_amount)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Corner lot</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">${{ $jobDetails->corner_lot_amount }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($jobDetails->fence_amount)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Fence</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">${{ $jobDetails->fence_amount }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if (isset($jobDetails->on_demand_fee))
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">On Demand Fee</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">${{ $jobDetails->on_demand_fee }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($jobDetails->admin_fee)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Admin Fee</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">${{ $jobDetails->admin_fee }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($jobDetails->total_amount)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0"><strong>Subtotal</strong></h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">
                                                            ${{ isset($jobDetails->total_amount) ? $jobDetails->total_amount : '0' }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif()

                                        @if ($jobDetails->tax_perc)
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Tax Rate-{{ $jobDetails->tax_perc }}%</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">{{ $jobDetails->tax }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4">
                                                    <h6 class="mb-0">Tip</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    <h6 class="mb-0">
                                                        ${{ isset($jobDetails->tip) ? $jobDetails->tip : '0' }}</h6>
                                                </div>
                                            </div>
                                        </div>


                                        <hr class="my-0">
                                        <div class="mt-5 pt-5 px-1">
                                            <div
                                                class="border-2 shadow rounded-3 bg-dark py-2 px-4 d-flex justify-content-between">
                                                <p class="mb-0">Total Price</p>
                                                <p class="mb-0">${{ $jobDetails->grand_total }}</p>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col-md-7">
                                        <div class="row px-2 pt-4">
                                            <div class="col-md-3">
                                                <h6>Customer Name</h6>
                                            </div>
                                            <div class="col-md-9 ps-0">
                                                <div class="border rounded-2 px-2 pt-3 pb-0 d-flex gap-15 flex-wrap">
                                                    <h6 class="text-green fs-15">
                                                        {{ isset($jobDetails->user->first_name) ? $jobDetails->user->first_name . ' ' . $jobDetails->user->last_name : '' }}
                                                    </h6>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row px-2 pt-4">
                                            <div class="col-md-3">
                                                <h6>Service location</h6>
                                            </div>
                                            <div class="col-md-9 ps-0">
                                                <div class="border rounded-2 px-2 pt-3 pb-0 d-flex gap-15 flex-wrap">
                                                    <h6 class="text-green fs-15">
                                                        {{ isset($jobDetails->property->address) ? $jobDetails->property->address : '' }}
                                                    </h6>
                                                    <h6 class="text-blue">
                                                        <i class="fa fa-map-marker fs-5"></i>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-rmiz-wrap="visible" class="images"><img class="area-img1"
                                                style="height: 100px; margin-left: 60%; margin-top: 2%;"
                                                src="https://mowingandplowing.com/mowingplowing//properties/google-map_1663775850.PNG">
                                        </div>
                                        <div class="row px-2 pt-4">
                                            <div class="col-md-3">
                                                <h6>Customer Instructions</h6>
                                            </div>
                                            <div class="col-md-9 ps-0">
                                                <div class="border rounded-2 px-2 pt-3 pb-0 d-flex gap-15 flex-wrap">
                                                    <h6 class="fs-15">
                                                        {{ isset($jobDetails->instructions) ? $jobDetails->instructions : '' }}
                                                    </h6>
                                                </div>
                                            </div>
                                            <br>

                                            @if ($jobDetails->status == 'Pending' || $jobDetails->status == 'Active')
                                            <div class="col-md-3" style="float:right">
                                                <button type="submit" data-bs-toggle='modal' data-title="Cancel job"
                                                    data-bs-target='#modal-opener'
                                                    data-url="{{ route('admin.recurring-jobs.cancel-warning', ['id' => $jobDetails->id]) }}"
                                                    class="btn btn-primary px-3 js-programmatic-enable p-2 mt-4">
                                                    Cancel Job</button>
                                                    </div>
                                            @endif()
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="image-viewer">
                                <img class="modal-content" id="full-image">
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
    <script>
        $(".images img").click(function() {
            $("#full-image").attr("src", $(this).attr("src"));
            $('#image-viewer').show();
        });

        $("#image-viewer").click(function() {
            $('#image-viewer').hide();
        });
    </script>
@endpush
