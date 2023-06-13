@extends('layouts.client')

@section('title','Recurring Jobs')

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
                <h3>Recurring Jobs</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="">
                        <i class="icofont icofont-prescription"></i>
                    </a></li>
                    <li class="breadcrumb-item">Recurring Jobs</li>
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
                            <th class="p-3">Recurring status</th>
                            <th class="p-3">Next order on</th>
                            <th class="p-3">Status</th>
                            <th class="p-3">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            function detailsRoute($id,$slug){
                                return $slug == 'ongoing-jobs' ? route('job-history.ongoing-jobs.details',$id) : route('job-history.jobs.details',$id);
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
                                <td><span class="bg-lightgreen px-2 py-1">{{ 'Every '.$job->on_every.' Days' }}</span></td>
                                <td>{{ $job->date }}</td>
                                <td class="{{ $job->status == 'Active' ? 'text-success' : 'text-danger' }}">{{ $job->status }}</td>
                                <td>
                                    @if ($job->status != 'Cancel')
                                        <button class="btn text-danger btn-xs" type="button" data-bs-toggle="modal" title="" data-bs-target="#modal-opener" data-title="Warning" data-url="{{ route('recurring-jobs.cancel-warning',['id'=>$job->id]) }}">Cancel</button>
                                    @endif
                                    <a href="{{ route('recurring-jobs.show',$job->id) }}" class="btn btn-primary btn-xs" data-original-title="btn btn-xs" title="">See Details</a>
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
