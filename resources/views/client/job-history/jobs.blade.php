@extends('layouts.client')

@section('title')
    {{ $pageTitle }}
@endsection

@push('vendor-styles')

@endpush

@push('page-styles')

<style>
    .text-blue{
        color: #0275D8;
    }
    .bg-blue {
        background: #0275D8;
        border: 1px solid #0275D8;
    }
    tbody tr td p{
        color: #2c323f !important;
    }
    tbody tr td{
        padding: 1rem;
        font-size: 12px;
        border-top: 1px solid #c9c9c9;
    }
    tbody tr td span{
        font-size: 12px;
    }
    tbody tr td .btn{
        padding: 5px;
    }
    .text-green{
        color: #24B550;
    }
    .btn-green{
        background: #24B550;
        color: #ffffff;
        border: 1px solid #24B550;
    }
    .bg-lightgreen{
        background: #B2FFCA;
        color: #2c323f !important;
        border-radius: 50rem;
    }
    .bg-lightyellow{
        background: #E8E8E8;
        color: #2c323f !important;
        border-radius: 50rem;
    }
</style>

@endpush

@section('body')

<!--- heading & li start --->
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>{{ $pageTitle }}</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">
                        <i class="icofont icofont-prescription"></i>
                    </a></li>
                    <li class="breadcrumb-item">Job History</li>
                    <li class="breadcrumb-item">{{ $pageTitle }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid table starts-->
<div class="container-fluid list-products">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body p-0 text-center">
                    <div class="table-responsive product-table rounded-3">
                    <table class="w-100" id="">
                        <thead class="bg-blue text-white">
                        <tr>
                            <th class="p-3">Address</th>
                            <th class="p-3">Service</th>
                            <th class="p-3">Price</th>
                            @if ($pageSlug == 'cancelled-jobs')
                                <th class="p-3">Cancellation charges</th>
                                <th class="p-3">Refund Amount</th>
                                <th class="p-3">Refund status</th>
                            @else
                                <th class="p-3">Provider</th>
                                <th class="p-3">Recurring status</th>
                                <th class="p-3">Date</th>
                            @endif
                            <th class="p-3">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            function detailsRoute($id,$slug){
                                return $slug == 'ongoing-jobs' || $slug == 'gps-track-service' ? route('job-history.ongoing-jobs.details',$id) : route('job-history.jobs.details',$id);
                            }
                        @endphp
                        @foreach ($jobs as $job)
                            <tr>
                                <td>
                                    <p>{{ $job->property->address }}</p>
                                    {{-- <span class="bg-lightyellow px-2 py-1">10 Mins (25 Miles) <i class="fa fa-map-marker text-blue fs-6"></i></span> --}}
                                </td>
                                <td>{{ $job->category->name }}</td>
                                <td class="text-green">${{ $job->grand_total }}</td>
                                @if ($pageSlug == 'cancelled-jobs')
                                    <td class="text-danger">${{ $job->cancellation_charges ?? "---" }}</td>
                                    <td class="text-success">${{ $job->grand_total - $job->cancellation_charges }}</td>
                                    <td>
                                        @if ($job->is_refunded == 1)
                                            <span class="bg-lightgreen px-2 py-1">Refunded</span></td>
                                        @else
                                            ---
                                        @endif
                                @else
                                    <td class="{{ $job->assigned_to && $job->provider ?: 'text-danger' }}">{{ $job->assigned_to && $job->provider ? $job->provider->first_name.' '.$job->provider->last_name : 'Not assigned' }}</td>
                                    <td><span class="bg-lightgreen px-2 py-1">{{ $job->service_type == 1 ? 'One time' : 'Every '.$job->period->duration.' Days' }}</span></td>
                                    <td>{{ $job->date }}</td>
                                @endif
                                <td>
                                    <button class="btn text-danger btn-xs {{ $job->status == 3 || $job->status == 4 ? 'd-none' : '' }}" type="button" data-bs-toggle="modal" title="" data-bs-target="#modal-opener" data-title="Warning" data-url="{{ route('job-history.jobs.cancel-warning',['id'=>$job->id]) }}">Cancel</button>
                                    <button class="btn text-dark btn-xs {{ $job->status != 3  ? 'd-none' : (!$job->rating ? 'd-none' : '') }}" type="button">Already rated</button>
                                    <a href="{{ route('job-history.rate-the-job',$job->id) }}" class="btn btn-dark btn-xs my-1 {{ $job->status != 3 ? 'd-none' : ($job->rating ? 'd-none' : '') }}" data-original-title="btn btn-xs" title="">Rate this job</a>
                                    <a href="{{ detailsRoute($job->id,$pageSlug) }}" class="btn btn-primary btn-xs my-1" data-original-title="btn btn-xs" title="">See Details</a>
                                    <button class="btn text-success btn-xs {{ $job->status == 3 && $job->status_by_customer == 1  ? '' : 'd-none' }}" type="button">You marked this job as Completed</button>
                                    <a href="{{ route('job-history.mark-job-as-completed',$job->id) }}" class="btn btn-success btn-xs my-1 {{ $job->status == 3 && $job->status_by_customer != 1 ? '' : 'd-none' }}" data-original-title="btn btn-xs" title="">Mark this job as Completed</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
