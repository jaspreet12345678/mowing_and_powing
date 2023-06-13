@extends('layouts.admin')

@section('title', 'Admins')

@push('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endpush

@push('page-styles')
 <style>
        .card-header {
            padding: 11% !important;
        }
    </style>
@endpush

@section('body')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Recurring Jobs</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                    data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Job</li>
                        <li class="breadcrumb-item active">Recurring Jobs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Container-fluid starts-->
    <div class="container-fluid crypto-dash">
        <div class="row">
            <div class="col-xl-3 col-md-6 dash-lg-50">
            <a href="{{route('admin.recurring-jobs.index',['status'=>'all']) }}">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                     
                                <h1 class="font-primary">Total Jobs</h1>
                            </div>
                            <div class="media-end">
                                <h1>{{$all_jobs}}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="crypto-dashborad-chart">
                            <div id="bitcoin-chart"></div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 dash-lg-50">
                <div class="card crypto-chart overflow-hidden">
                 <a href="{{route('admin.recurring-jobs.index',['status'=>'Active']) }}">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <h1 class="font-info">Active</h1>
                            </div>
                            <div class="media-end">
                                <h1>{{ $active_jobs  }}</h1> 
                             
                            </div>
                        </div>
                    </div>
                    </a>
                    <div class="card-body p-0">
                        <div class="crypto-dashborad-chart">
                            <div id="ethereum-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 dash-lg-50">
                <div class="card crypto-chart overflow-hidden">
                <a href="{{route('admin.recurring-jobs.index',['status'=>'Completed']) }}">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <h1 class="font-info">Completed</h1>
                            </div>
                            <div class="media-end">
                                <h1>{{ $completed_jobs  }}</h1>
                            </div>
                        </div>
                    </div>
                    </a>
                    <div class="card-body p-0">
                        <div class="crypto-dashborad-chart">
                            <div id="ethereum-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 dash-lg-50">
                <div class="card crypto-chart overflow-hidden">
                <a href="{{route('admin.recurring-jobs.index',['status'=>'Pending']) }}">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                
                                <h1 class="font-secondary">Pending</h1>
                            </div>
                            <div class="media-end">
                                 <h1>{{$pending_jobs}}</h1> 
                            </div>
                        </div>
                    </div>
                    </a>
                    <div class="card-body p-0">
                        <div class="crypto-dashborad-chart">
                            <div id="ripple-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 dash-lg-50">
                <div class="card crypto-chart">
                <a href="{{route('admin.recurring-jobs.index',['status'=>'Failed']) }}">
                    <div class="card-header card-no-border bg-transparent" styles="border-radius: 15px;">
                        <div class="media">
                            <div class="media-body">
                                <h1 class="font-warning">Failed</h1>
                            </div>
                            <div class="media-end">
                            <h1>{{$failed_jobs}}</h1>
                                
                            </div>
                        </div>
                    </div>
                    </a>
                    <div class="card-body p-0">
                        <div class="crypto-dashborad-chart">
                            <div id="litecoin-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6 dash-lg-50">
                <div class="card crypto-chart">
                <a href="{{route('admin.recurring-jobs.index',['status'=>'Cancel']) }}">
                    <div class="card-header card-no-border bg-transparent" styles="border-radius: 15px;">
                        <div class="media">
                            <div class="media-body">
                                <h1 class="font-warning">Cancelled</h1>
                            </div>
                            <div class="media-end">
                                <h1>{{$cancel_jobs}}</h1> 
                            </div>
                        </div>
                    </div>
                    </a>
                    <div class="card-body p-0">
                        <div class="crypto-dashborad-chart">
                            <div id="litecoin-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <input type="hidden" value="{{$status}}" id="order_status">
    <div class="container-fluid user-card">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display datatables" id="orders-datatable">

                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Id</th>
                                        <th>User</th>
                                        <th>Recurring Plan</th>
                                        <th>Next Service</th>
                                        <th>Total</th>
                                        <th>Admin Commission</th>
                                        <th>Status</th>
                                        <th>Reason</th>
                                        <th>Last Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('vendor-scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
@endpush

@push('page-scripts')
    <script>
        $(function() {
            var status=$("#order_status").val();
              var url = "{{ route('admin.recurring-jobs.index', ":id") }}";
               url = url.replace(':id', status);
            var table = $('#orders-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: url,
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'order_id',
                        name: 'order_id'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'recurringplan',
                        name: 'recurringplan'

                    },
                    {
                        data: 'nextservice',
                        name: 'nextservice'

                    },
                    {
                        data: 'grand_total',
                        name: 'grand_total'
                    },

                    {
                        data: 'admin_commission',
                        name: 'admin_commission'
                    },

                    {
                        data: 'status',
                        name: 'status'
                    },

                    {
                        data: 'status_reason',
                        name: 'status_reason'
                    },

                    {
                        data: 'updated_at',
                        name: 'updated_at'
                    },

                    {
                        data: '',
                    },

                ],
                columnDefs: [{
                    // Actions
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function(data, type, full, meta) {
                        let details =
                            "{{ route('admin.recurring-jobs.job-detail', ['__id__']) }}"
                            .replace('__id__', full.id)
                        let order_list =
                            "{{ route('admin.recurring-jobs.order_list', ['__id__']) }}"
                            .replace('__id__', full.id)
                        return (
                            '<div class="btn-group">' +
                            '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                            feather.icons['more-vertical'].toSvg({
                                class: 'font-small-4'
                            }) +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-end">' +
                            "<a href=" + details + " class='dropdown-item'>" +
                            feather.icons['file-text'].toSvg({
                                class: 'font-small-4 me-50'
                            }) +
                            'Details</a>' +
                            "<a href=" + order_list + " class='dropdown-item'>" +
                            feather.icons['file-text'].toSvg({
                                class: 'font-small-4 me-50'
                            }) +
                            'OrderList</a></div>' +
                            '</div>' +
                            '</div>'
                        );
                    }
                }],
            });

        });
    </script>
@endpush
