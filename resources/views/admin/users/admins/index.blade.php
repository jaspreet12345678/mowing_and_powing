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
                <h3>Admins</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                data-feather="home"></i></a></li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item active">Admins</li>
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
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Phone #</th>
                        <th>Status</th>
                        <th>Actions</th>
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

        var statusObj = {
          1: { title: 'Active', class: 'badge-success' },
          2: { title: 'Pending', class: 'badge-warning' },
          3: { title: 'Inactive', class: 'badge-danger' }
        };

        $('#server-side-datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('admin.users.admins.data') }}",
            "columns": [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'name' },
                { data: 'phone_number' },
                { data: 'status' },
                { data: '' },
            ],
            columnDefs:[
                {
                    // User full name and Image
                    targets: 1,
                    render: function (data, type, full, meta) {
                    var $name = full['name'],
                        $email = full['email'],
                        $image = full['image'];
                    if ($image) {
                        // For Avatar image
                        let image = "{{asset('__path__')}}".replace('__path__',$image)
                        var $output =
                        '<img src='+ image +' alt="Avatar" height="32" width="32">';
                    } else {
                        // For Avatar badge
                        var stateNum = Math.floor(Math.random() * 6) + 1;
                        var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                        var $state = states[stateNum];
                        $initials = $name.match(/\b\w/g) || [];
                        $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                        $output = '<span class="avatar-content">' + $initials + '</span>';
                    }
                    var colorClass = $image === '' ? ' bg-light-' + $state + ' ' : '';
                    // Creates full output for row
                    var $row_output =
                        '<div class="d-flex justify-content-left align-items-center">' +
                        '<div class="avatar-wrapper">' +
                        '<div class="avatar ' +
                        colorClass +
                        ' me-1">' +
                        $output +
                        '</div>' +
                        '</div>' +
                        '<div class="d-flex flex-column">' +
                        '<a href="" class="user_name text-truncate text-body"><span class="fw-bolder">' +
                        $name +
                        '</span></a>' +
                        '<small class="emp_post text-muted">' +
                        $email +
                        '</small>' +
                        '</div>' +
                        '</div>';
                    return $row_output;
                    }
                },
                {
                    // Role
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return full.roles[0].name;
                    }
                },
                {
                    // User Status
                    targets: 5,
                    render: function (data, type, full, meta) {
                    var $status = full['status'];
                    return (
                        '<span class="badge rounded-pill ' +
                        statusObj[$status].class +
                        '" text-capitalized>' +
                        statusObj[$status].title +
                        '</span>'
                    );
                    }
                },
                {
                    // Actions
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function (data, type, full, meta) {
                    let details = "{{route("admin.users.admins.show",["admin"=>"__id__"])}}".replace('__id__',full.id)
                    let destroy = "{{route("admin.users.admins.destroy",["admin"=>"__id__"])}}".replace('__id__',full.id)
                    return (
                        '<div class="btn-group">' +
                        '<a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">' +
                        feather.icons['more-vertical'].toSvg({ class: 'font-small-4' }) +
                        '</a>' +
                        '<div class="dropdown-menu dropdown-menu-end">' +
                        "<a href="+ details +" class='dropdown-item'>" +
                        feather.icons['file-text'].toSvg({ class: 'font-small-4 me-50' }) +
                        'Details</a>' +
                        '<a data-url="' + destroy +'" id="delete-data" class="dropdown-item delete-record">' +
                        feather.icons['trash-2'].toSvg({ class: 'font-small-4 me-50' }) +
                        'Delete</a></div>' +
                        '</div>' +
                        '</div>'
                    );
                    }
                }
            ],
        });
    });
</script>
@endpush
