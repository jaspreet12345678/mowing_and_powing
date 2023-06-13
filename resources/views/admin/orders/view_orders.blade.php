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

        .images:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        #image-viewer {
            display: none;
            position: fixed;
            z-index: 999;
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
            width: auto;
            height: auto;
            max-width: 100vw;
            max-height: 100vh;
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
                    <h3>Order Details</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="">
                                <i class="icofont icofont-prescription"></i>
                            </a></li>
                        <li class="breadcrumb-item">Order History</li>
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
                                <h5 class="mb-0 fw-normal">Order Details</h5>
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
                                                    <h6 class="mb-0">Order Status</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    <h6 class="mb-0">

                                                        {{ $jobDetails->status == 1 ? 'Pending' : ($jobDetails->status == 2 ? 'accepted' : ($jobDetails->status == 4 ? 'canceled' : 'completed')) }}
                                                    </h6>
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
                                                    <h6 class="mb-0">Date</h6>
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

                                        @if (isset($jobDetails->service_for))
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Service Type</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">{{ $jobDetails->service_for }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif()
                                        @if ($jobDetails->subcategory_id)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Car Type</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">{{ ucfirst($jobDetails->car->name) }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($jobDetails->color_id)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Color</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">
                                                            {{ ucfirst(isset($jobDetails->color->name) ? $jobDetails->color->name : '') }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($jobDetails->car_number)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Plate number</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">{{ $jobDetails->car_number }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($jobDetails->schedule->name ?? false)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Schedule time</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">
                                                            {{ isset($jobDetails->schedule->name) ? $jobDetails->schedule->name : '' }}
                                                            ({{ isset($jobDetails->schedule->time) ? $jobDetails->schedule->time : '' }})
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($jobDetails->snowDepth->name ?? false)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Snow Depth</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">{{ $jobDetails->snowDepth->name }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($jobDetails->sidewalk_amount)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Sidewalk</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">Yes</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($jobDetails->driveway)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Driveway</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">{{ $jobDetails->driveway }} Cars</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if (isset($jobDetails->period))
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Recurring status</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">
                                                            {{ $jobDetails->service_type == 1 ? 'One time' : 'Every ' . $jobDetails->period->duration . ' Days' }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($jobDetails->lawnHeight->name ?? false)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Lawn height</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">{{ $jobDetails->lawnHeight->name }}</h6>
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



                                        @if ($jobDetails->cleanUp)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Yard cleanup</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">{{ $jobDetails->cleanUp->name }}</h6>
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
                                                        <h6 class="mb-0">Lawn Size Amount</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">${{ $jobDetails->lawn_size_amount }}</h6>
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


                                        @if ($jobDetails->lawn_height_amount)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Lawn Height Amount</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">${{ $jobDetails->lawn_height_amount }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif


                                        @if ($jobDetails->cleanup_amount)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">CleanUP Amount</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">${{ $jobDetails->cleanup_amount }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($jobDetails->sidewalk_amount)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Sidewalk Price</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">
                                                            ${{ isset($jobDetails->sidewalk_amount) ? $jobDetails->sidewalk_amount : '0' }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif()

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
                                                        <h6 class="mb-0">${{ $jobDetails->cornerLot->price }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($jobDetails->driveway_amount)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Driveway Price</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">
                                                            ${{ isset($jobDetails->driveway_amount) ? $jobDetails->driveway_amount : '0' }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif()
                                        @if ($jobDetails->walkway_amount)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Walkway Price</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">
                                                            ${{ isset($jobDetails->walkway_amount) ? $jobDetails->walkway_amount : '0' }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif()

                                        @if ($jobDetails->snow_depth_amount)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Snow Depth Amount</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">
                                                            ${{ $jobDetails->snow_depth_amount }}
                                                        </h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif()

                                        @if ($jobDetails->admin_fee)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Admin Commission</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">${{ $jobDetails->admin_commission }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        @if ($jobDetails->provider_amount)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Provider Amount</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">${{ $jobDetails->provider_amount }}</h6>
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


                                        @if ($jobDetails->tax_perc)
                                            <hr class="my-0">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4">
                                                        <h6 class="mb-0">Tax Rate-{{ $jobDetails->tax_perc }}%</h6>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-6">
                                                    <div class="p-4 text-end">
                                                        <h6 class="mb-0">${{ $jobDetails->tax }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <hr class="my-0">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4">
                                                    <h6 class="mb-0">Tip</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    ${{ isset($jobDetails->tip) ? $jobDetails->tip : '0' }}</h6>
                                                </div>
                                            </div>
                                        </div>

                                        <hr class="my-0">
                                        <div class="row">
                                            <div class="mt-5 pt-5 px-1">
                                                <div style="margin: 8px; margin-top: -90px;"
                                                    class="border-2 shadow rounded-3 bg-dark py-2 px-4 d-flex justify-content-between">
                                                    <p class="mb-0">Grand Total</p>
                                                    <p class="mb-0">${{ $jobDetails->grand_total }}</p>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- @if ($jobDetails->total_amount)
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
                                        @endif() --}}



                                    </div>
                                    <div class="col-md-7">
                                        @if (count($jobDetails->images) != 0)
                                            <div class="row pt-4 px-2">
                                                <div class="col-md-3">
                                                    <h6>{{ $jobDetails->service_for ?? 'Lawn' }} images</h6>
                                                </div>
                                                <div class="col-md-9 ps-0">
                                                    <div class="card">
                                                        <div class="card-body p-2 shadow d-flex flex-wrap gap-15">
                                                            @foreach ($jobDetails->images as $image)
                                                                <div class="images">
                                                                    <img src="{{ asset($image->image) }}" alt=""
                                                                        width="100px">
                                                                </div>
                                                            @endforeach
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
                                                            <span
                                                                class="float-start">{{ $jobDetails->on_the_way ? 'On his way' : '' }}</span>
                                                            <span
                                                                class="float-end">{{ $jobDetails->finished_job ? 'Finished Job' : '' }}</span>
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
                                                            <span
                                                                class="">{{ $jobDetails->at_location_and_started_job ? 'Started Job' : '' }}</span>
                                                        </div>
                                                        <div class="col-md-4"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row px-2 pt-4">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9 mt-4">
                                                <div>
                                                    <form method="post"
                                                        action="{{ route('admin.order.change-order-status') }}">
                                                        @csrf
                                                        <div class="px-1">
                                                            <select required style="width: 100%;"
                                                                class="border-2 shadow rounded-3 bg-dark py-2 px-4 d-flex justify-content-between"
                                                                name="status">
                                                                <option>Change Status</option>
                                                                <option value="on_the_way">On the way </option>
                                                                <option value="started_job">Started</option>
                                                                <option value="finished_job">Completed</option>
                                                            </select>
                                                            <input type="hidden" value="{{ $jobDetails->id }}"
                                                                name="order_id">
                                                            <button type="submit"
                                                                class="btn btn-primary js-programmatic-enable p-2 mt-4 float-end">
                                                                Change Job Status</button>
                                                        </div>
                                                    </form>
                                                </div>


                                     {{-- -------------- Update Customer Instructions--------- --}}
                                                <form method="post"
                                                    action="{{ route('admin.order.update-customer-instruction') }}">
                                                    @csrf
                                                    <div class="mt-5 pt-5 px-1">
                                                        <p class="mb-2 py-3" style="font-size: 20px; display: block;">
                                                            <strong>Customer Instruction :-</strong>
                                                            <input type="hidden" value="{{ $jobDetails->id }}"
                                                                name="hidden_id">
                                                            <textarea class="form-control" name="instruction" placeholder="write here instructions">{{ isset($jobDetails->instructions) ? $jobDetails->instructions : '' }}</textarea><button type="submit"
                                                                class="btn btn-info mt-2">update</button>

                                                        </p>
                                                        <div class="col-md-12 pb-3">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-3"></div>
                                                {{-- <div class="col-md-9 d-flex justify-content-between px-3">
                                                        <button type="submit"
                                                        class="btn btn-primary px-3 js-programmatic-enable p-2 mt-4">
                                                        Change Job Status</button>

                                                        <button type="submit"
                                                        class="btn btn-primary px-3 js-programmatic-enable p-2 mt-4">
                                                        Cancel Job</button>

                                                        <button type="submit"
                                                        class="btn btn-primary px-3 js-programmatic-enable p-2 mt-4">
                                                        Repost</button>
                                                </div> --}}
                                                {{-- <div class="col-md-4">
                                                    <button type="submit"
                                                        class="btn btn-primary js-programmatic-enable p-2 mt-4 float-end">
                                                        Change Job Status</button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit"
                                                        class="btn btn-primary js-programmatic-enable p-2 mt-4 float-end">
                                                        Cancel Job</button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="submit"
                                                        class="btn btn-primary js-programmatic-enable p-2 mt-4 float-end">
                                                        Repost</button>
                                                </div> --}}
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="image-viewer">
                                <img class="modal-content" id="full-image">
                            </div>

                            {{-- ----- 2 buttons -------- --}}
                            {{-- <div class="row">
                                <div class="col-md-12 d-flex justify-content-center">
                                    @if ($jobDetails->status == 3 || $jobDetails->status == 4)
                                        <button type="button" class="btn btn-green py-2 px-5 fw-normal"
                                            data-bs-toggle="modal" title=""
                                            data-bs-target="#myModal">Reorder</button>
                                    @endif --}}

                            <!-- The Modal start-->
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <!-- Modal Header -->
                                        <div class="modal-header flex-column px-4">
                                            <div class="col-md-12">
                                                <h6 class="text-end text-muted">Sep 10 at 9:46 AM</h6>
                                                <div class="text-center py-2">
                                                    <div data-rmiz-wrap="visible" class="images">
                                                        <img src="{{ asset('assets/images/client.png') }}"
                                                            alt="client-img">
                                                    </div>
                                                    <h4 class="text-dark fw-normal px-5 pt-4 mb-0">John doe
                                                        completed
                                                        his job.</h4>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer justify-content-center py-3">
                                            <button class="btn btn-green w-25 fw-normal" type="button"
                                                data-original-title="btn" title="">Accept</button>
                                            <button class="btn btn-danger w-25 fw-normal" type="button"
                                                data-original-title="btn"title="">Decline</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 px-1">
                <div class="card border mx-4">
                    <div class="card-header bg-primary text-center">
                        <h5 class="mb-0 fw-normal">Provider Details</h5>
                    </div>
                    <div class="card-body px-0 pt-0">
                        <div class="row">
                            <div class="col-md-5 border-2 border-end pe-0">
                                @if ($jobDetails->total_amount)
                                    <hr class="my-0">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4">
                                                <h6 class="mb-0"><strong>Provider Name</strong></h6>
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
                                @endif()

                                <hr class="my-0">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <div class="p-4">
                                            <h6 class="mb-0"><strong>Phone Number</strong></h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-6">
                                        <div class="p-4 text-end">
                                            <h6 class="mb-0">
                                                {{ $jobDetails->assigned_to ? $jobDetails->provider->phone_number : 'Not assigned' }}
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                {{-- ----- btns ---- --}}
                                <div class="d-flex justify-content-between px-4">
                                    @if ($jobDetails->status == 1)
                                        <button type="submit" data-bs-toggle='modal' data-title="Assign Provider"
                                            data-bs-target='#modal-opener'
                                            data-url="{{ route('admin.order.provider-assign', ['id' => $jobDetails->id]) }}"
                                            class="btn btn-primary px-3 js-programmatic-enable p-2 mt-4">
                                            Assign Provider</button>
                                    @endif()


                                    @if ($jobDetails->on_the_way == null)
                                        <button type="submit" data-bs-toggle='modal' data-title="Cancel job"
                                            data-bs-target='#modal-opener'
                                            data-url="{{ route('admin.order.jobs.cancel-warning', ['id' => $jobDetails->id]) }}"
                                            class="btn btn-primary px-3 js-programmatic-enable p-2 mt-4">
                                            Cancel Job</button>
                                    @endif()

                                    @if ($jobDetails->on_the_way == null)
                                        <button type="submit" data-bs-toggle='modal' data-title="RePost job"
                                            data-bs-target='#modal-opener'
                                            data-url="{{ route('admin.order.jobs.re_post_job', ['id' => $jobDetails->id]) }}"
                                            class="btn btn-primary px-3 js-programmatic-enable p-2 mt-4">
                                            Repost</button>
                                    @endif()

                                    @if ($jobDetails->assigned_to != null)
                                        <button type="submit" data-bs-toggle='modal' data-title="Remove Provider"
                                            data-bs-target='#modal-opener'
                                            data-url="{{ route('admin.order.jobs.remove_provider_warning', ['id' => $jobDetails->id]) }}"
                                            class="btn btn-primary px-3 js-programmatic-enable p-2 mt-4">
                                            Remove Provider</button>
                                    @endif()
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="row pt-4 px-2">
                                    <div class="col-md-12 ps-0">
                                        <div class="card">
                                            <h6><strong>Before Service images :</strong></h6>
                                            <div
                                                class="card-body p-2 shadow d-flex overflow-scroll">
                                                @foreach ($jobDetails->providerimages as $image)
                                                    @if ($image->type == 'before')
                                                        <div data-rmiz-wrap="visible" class="images me-4">
                                                            <img src="{{ asset($image->image) }}" alt=""
                                                                width="100px" height="60px">
                                                        </div>
                                                    @endif()
                                                @endforeach
                                            </div>

                                        </div>
                                        @if ($jobDetails->assigned_to)
                                            <span type="btn" data-title="Before Service Image" data-bs-toggle='modal'
                                                data-bs-target='#modal-opener'
                                                data-url="{{ route('admin.order.upload_before_service_image', ['order_id' => $jobDetails->id, 'provider_id' => $jobDetails->provider->id, 'type' => 'before']) }}"><i
                                                    class="fa fa-upload"></i></span>
                                        @endif()
                                    </div>
                                </div>
                                <div class="row pt-4 px-2">
                                    <div class="col-md-12 ps-0">
                                        <div class="card">
                                            <h6><strong>After Service images :</strong></h6>
                                            <div
                                                class="card-body p-2 shadow d-flex overflow-scroll">
                                                @foreach ($jobDetails->providerimages as $image)
                                                    @if ($image->type == 'after')
                                                        <div data-rmiz-wrap="visible" class="images me-4">
                                                            <img src="{{ asset($image->image) }}" alt=""
                                                                width="100px" height="60px">
                                                        </div>
                                                    @endif()
                                                @endforeach
                                            </div>
                                        </div>
                                        @if ($jobDetails->assigned_to)
                                            <span type="btn" data-title="After Service Image" data-bs-toggle='modal'
                                                data-bs-target='#modal-opener'
                                                data-url="{{ route('admin.order.upload_before_service_image', ['order_id' => $jobDetails->id, 'provider_id' => $jobDetails->provider->id, 'type' => 'after']) }}"><i
                                                    class="fa fa-upload"></i></span>
                                        @endif()
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
