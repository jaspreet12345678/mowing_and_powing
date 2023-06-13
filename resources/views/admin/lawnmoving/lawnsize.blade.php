@extends('layouts.admin')

@section('title','Admins')

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
                <h3>Lawn Size</h3>
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
                  <table class="display datatables" id="server-side-datatable">
                    <button data-bs-toggle='modal' data-bs-target='#modal-opener' data-url="{{ route('admin.generalsettings.lawnmoving.add-lawn-size') }}" style="font-size:12px; float: right">Add <i class="fa fa-plus"></i></button>
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>7 days price</th>
                        <th>10 days price</th>
                        <th>14 days price</th>
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
    $(function () {
    
    var table = $('#server-side-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{route('admin.generalsettings.lawnmoving.get-lawn-data') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'price', name: 'price'},
            {data: 'seven_days_price', name: 'seven_days_price'},
            {data: 'ten_days_price', name: 'ten_days_price'},
            {data: 'fourteen_days_price', name: 'fourteen_days_price'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
</script>
@endpush
