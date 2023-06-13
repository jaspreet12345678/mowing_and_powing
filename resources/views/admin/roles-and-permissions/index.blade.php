@extends('layouts.admin')

@section('title','Roles and Permissions')

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
                <h3>Roles</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Roles and Permissions</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
            <form class="theme-form mega-form" action="{{ route('admin.roles-and-permissions.store') }}" method="post">
                @csrf
                <div class="card-body">
                        <div class="mb-3">
                        <label class="col-form-label">Role</label>
                        <input class="form-control" type="text" required placeholder="Role Name" name="role" value="{{ $settings->name ?? '' }}">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Add Role</button>
                </div>
            </form>
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
                  <table class="display datatables" id="server-side-datatable">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
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
            "ajax": "{{ route('admin.roles-and-permissions.data') }}",
            "columns": [
                { data: 'id' },
                { data: 'name' },
                { data: '' },
            ],
            columnDefs:[
                {
                    // Actions
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function (data, type, full, meta) {
                    let permissions = "{{route("admin.roles-and-permissions.permissions",["role_id"=>"__id__"])}}".replace('__id__',full.id)
                    let edit = "{{route("admin.roles-and-permissions.edit",["roles_and_permission"=>"__id__"])}}".replace('__id__',full.id)
                    let destroy = "{{route("admin.roles-and-permissions.destroy",["roles_and_permission"=>"__id__"])}}".replace('__id__',full.id)
                    return (
                        '<button data-url="' + permissions +'" class="btn btn-dark" type="button" data-title="Permissions" data-bs-toggle="modal" data-bs-target="#modal-opener">Permissions</button>'+
                        '<button data-url="' + edit +'" data-title="Permissions" data-bs-toggle="modal" data-bs-target="#modal-opener" class="btn btn-primary mx-3">Edit</button>'+
                        '<button data-url="' + destroy +'" id="delete-data" class="btn btn-danger">Delete</button>'
                    );
                    }
                }
            ],
        });
    });
</script>
@endpush
