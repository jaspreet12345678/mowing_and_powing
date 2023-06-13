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
                    <h3>Providers Payment</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                    data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">General Setting</li>
                        <li class="breadcrumb-item active">Lawn Mowing</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Container-fluid starts-->
    <div class="container-fluid crypto-dash">
        <div class="row">
          
            <div class="col-xl-3 col-md-6 dash-lg-50">
            <a href="{{ route('admin.payproviders.payment-status', ['status' => 'needpayment']) }}">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <h1 class="font-secondary">Pending</h1>
                            </div>
                            <div class="media-end">
                                <h1>{{ $total_pending }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="crypto-dashborad-chart">
                            <div id="ripple-chart"></div>
                        </div>
                    </div>
                </div>
            </a>
            </div>
            <div class="col-xl-3 col-md-6 dash-lg-50">
             <a href="{{ route('admin.payproviders.paid-providers', ['status' => 'approvedpayment']) }}">
                <div class="card crypto-chart overflow-hidden">
                    <div class="card-header card-no-border">
                        <div class="media">
                            <div class="media-body">
                                <h1 class="font-info">Approved</h1>
                            </div>
                            <div class="media-end">
                                <h1>{{ $total_approved }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="crypto-dashborad-chart">
                            <div id="ethereum-chart"></div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-xl-3 col-md-6 dash-lg-50">
              <a href="{{ route('admin.payproviders.paid-providers', ['status' => 'rejectpayment']) }}">
                <div class="card crypto-chart">
                    <div class="card-header card-no-border bg-transparent" styles="border-radius: 15px;">
                        <div class="media">
                            <div class="media-body">
                                <h1 class="font-warning">Rejected</h1>
                            </div>
                            <div class="media-end">
                                <h1>{{ $total_reject }}</h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="crypto-dashborad-chart">
                            <div id="litecoin-chart"></div>
                        </div>
                    </div>
                </div>
                </a>
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
                                        <th>Provider</th>
                                        <th>Amount</th>
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

                ajax: "{{ route('admin.payproviders.payment-status', ['status' => $status]) }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'order_id',
                        name: 'order_id'
                    },

                    {
                        data: 'provider',
                        name: 'provider'
                    },
                    {
                        data: 'provideramount',
                        name: 'provideramount'
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                    {
                        data: 'Detail',
                        name: 'Detail',

                    },
                ]
            });

        });
    </script>
@endpush
