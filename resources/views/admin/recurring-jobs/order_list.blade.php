@extends('layouts.admin')

@section('title', 'Admins')

@push('vendor-styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endpush

@push('page-styles')
@endpush

@section('body')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Orders</h3>
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
                ajax: "{{ route('admin.recurring-jobs.order_list',$id)}}",
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
                        name: 'username.first_name'
                    },
                    {
                        data: 'category',
                        name: 'category.name'
                    },
                    {
                        data: 'provider',
                        name: 'provider.first_name'
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
                ]
            });

        });
    </script>
@endpush
