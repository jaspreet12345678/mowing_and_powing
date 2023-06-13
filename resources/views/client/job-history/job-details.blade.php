@extends('layouts.client')

@section('title','Job Details')

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
                <h3>Job Details</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">
                        <i class="icofont icofont-prescription"></i>
                    </a></li>
                    <li class="breadcrumb-item">Job History</li>
                    <li class="breadcrumb-item">Jobs</li>
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
                                                <h6 class="mb-0">Job status</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4 text-end">
                                                 <h6 class="mb-0">{{ $jobDetails->status == 1 ? "Upcoming" : ($jobDetails->status == 2 ? "Ongoing" : ($jobDetails->status == 3 ? "Completed" : ($jobDetails->status == 4 ? "Cancelled" : ""))) }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-0">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4">
                                                <h6 class="mb-0">Job price</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4 text-end">
                                                 <h6 class="mb-0 text-success">${{ $jobDetails->grand_total }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-0">
                                    @if ($jobDetails->status == 4)
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4">
                                                    <h6 class="mb-0">Refund status</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    <h6 class="mb-0">{{ $jobDetails->is_refunded ? "Refunded" : "---" }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-0">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4">
                                                    <h6 class="mb-0">Refund amount</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    <h6 class="mb-0 text-success">${{ $jobDetails->grand_total - $jobDetails->cancellation_charges }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-0">
                                    @endif
                                    @if ($jobDetails->cancellation_charges)
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4">
                                                    <h6 class="mb-0">Cancellation charges</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    <h6 class="mb-0 text-danger">${{ $jobDetails->cancellation_charges }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-0">
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4">
                                                <h6 class="mb-0">Service provider</h6>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6">
                                            <div class="p-4 text-end">
                                                 <h6 class="mb-0">{{ $jobDetails->assigned_to && $jobDetails->provider ? $jobDetails->provider->first_name.' '.$jobDetails->provider->last_name : 'Not assigned' }}</h6>
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
                                                    <h6 class="mb-0">{{ $jobDetails->service_type == 1 ? 'One time' : 'Every '.$jobDetails->period->duration.' Days' }}</h6>
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
                                                    <h6 class="mb-0">{{ $jobDetails->schedule->name }} ({{ $jobDetails->schedule->time }})</h6>
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
                                    @if ($jobDetails->walkway_amount)
                                        <hr class="my-0">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4">
                                                    <h6 class="mb-0">Walkway</h6>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-6">
                                                <div class="p-4 text-end">
                                                    <h6 class="mb-0">Yes</h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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
                                                    <h6 class="mb-0">{{ ucfirst($jobDetails->color->name) }}</h6>
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
                                                                <img src="{{ asset($image->image) }}" alt="" width="100px">
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
                                    @if (count($jobDetails->beforeImages) != 0)
                                        <div class="row pt-4 px-2 mt-5">
                                            <div class="col-md-3">
                                                <h6>Before job images</h6>
                                            </div>
                                            <div class="col-md-9 ps-0">
                                                <div class="card">
                                                    <div class="card-body p-2 shadow d-flex flex-wrap gap-15">
                                                        @foreach ($jobDetails->beforeImages as $image)
                                                            <div class="images">
                                                                <img src="{{ asset($image->image) }}" alt="" width="100px">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @if (count($jobDetails->afterImages) != 0)
                                        <div class="row pt-4 px-2 mt-3">
                                            <div class="col-md-3">
                                                <h6>After job images</h6>
                                            </div>
                                            <div class="col-md-9 ps-0">
                                                <div class="card">
                                                    <div class="card-body p-2 shadow d-flex flex-wrap gap-15">
                                                        @foreach ($jobDetails->afterImages as $image)
                                                            <div class="images">
                                                                <img src="{{ asset($image->image) }}" alt="" width="100px">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="row px-2 pt-4">
                                        <div class="col-md-12 pb-2 mt-4">
                                            <h6 class="border-bottom pb-4">Instructions:</h6>
                                        </div>
                                        <div class="col-md-12 pb-3">
                                            <form action="{{ route('job-history.jobs.details.update',$jobDetails->id) }}" method="post">
                                                @csrf
                                                <textarea class="form-control boxShadow f-12" id="exampleFormControlTextarea1" rows="4" name="instructions">{{ $jobDetails->instructions }}</textarea>
                                                <button class="btn btn-primary mt-3">Update Instructions</button>
                                            </form>
                                        </div>
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
                        @if ($jobDetails->category_id == 1)
                            <a href="{{ route('lawn-mowing.steps',['property_id'=>$jobDetails->property_id]) }}" class="btn btn-green shadow-sm fw-normal text-white">Reorder</a>
                        @else
                            <a href="{{ route('snow-plowing.steps',['type'=>'home','property_id'=>$jobDetails->property_id]) }}" class="btn btn-green shadow-sm fw-normal text-white">Reorder</a>
                        @endif
                    @endif

                    <div class="ms-3">
                        <button class="btn text-success {{ $jobDetails->status == 3 && $jobDetails->status_by_customer == 1  ? '' : 'd-none' }}" type="button">You marked this job as Completed</button>
                        <a href="{{ route('job-history.mark-job-as-completed',$jobDetails->id) }}" class="btn btn-success my-1 {{ $jobDetails->status == 3 && $jobDetails->status_by_customer != 1 ? '' : 'd-none' }}" data-original-title="btn btn-xs" title="">Mark this job as Completed</a>
                    </div>

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

                    @if ($jobDetails->status == 1)
                        <a href="{{ route('job-history.upcoming-jobs.proposals',$jobDetails->id) }}" class="btn btn-green py-2 fw-normal">See proposals</a>
                    @endif
                </div>
            </div>

            <div id="image-viewer">
                <img class="modal-content" id="full-image">
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
