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
                    <h3>Review</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                    data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Orders</li>
                        <li class="breadcrumb-item active">Cancel Order</li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

      <!-- Container-fluid starts-->
    <div class="container-fluid crypto-dash">
        <div class="row">
            <div class="col-xl-3 col-md-6 dash-lg-50">
                <div class="card crypto-chart overflow-hidden">
                <a href="{{ route('admin.cancel-jobs.index') }}">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <h1 class="font-primary">Cancel</h1>
                            </div>
                            <div class="media-end">
                                <h1>{{ $total_cancel }}</h1>
                            </div>
                        </div>
                    </div>
                    </a>
                    <div class="card-body p-0">
                        <div class="crypto-dashborad-chart">
                            <div id="bitcoin-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 dash-lg-50">
                <div class="card crypto-chart overflow-hidden">
                <a href="{{ route('admin.cancel-jobs.refunded-job') }}">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <h1 class="font-info">Refunded</h1>
                            </div>
                            <div class="media-end">
                                <h1>{{  $refunded  }}</h1>
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
                <div class="card crypto-chart">
                <a href="{{ route('admin.cancel-jobs.reviewed-job') }}">
                    <div class="card-header card-no-border bg-transparent" styles="border-radius: 15px;">
                        <div class="media">
                            <div class="media-body">
                                <h1 class="font-warning">Under Review</h1>
                            </div>
                            <div class="media-end">
                                <h1>{{ $under_review }}</h1>
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
                                        <th>Order Id</th>
                                        <th>Order Date</th>
                                        <th>Username</th>
                                        <th>Service</th>
                                        <th>Provider</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Detail</th>
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

            var table = $('#orders-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.cancel-jobs.reviewed-job') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'order_id',
                        name: 'order_id'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'provider',
                        name: 'provider'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                      {
                        data: 'Detail',
                        name: 'Detail',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
@endpush
