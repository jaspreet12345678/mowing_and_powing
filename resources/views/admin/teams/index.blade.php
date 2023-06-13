@extends('layouts.admin')

@section('title','Teams')

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
                <h3>Teams</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Teams</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
      <div class="col">
        <div class="row">
          <div class="col-sm-12 mb-3 text-end">
            <button class="btn btn-pill btn-primary btn-air-primary" type="button" data-title="Invite team member" data-bs-toggle="modal" data-bs-target="#modal-opener" data-url="{{ route('admin.teams.invite.index') }}">Invite team member</button>
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
                        <th>Role</th>
                        <th>Email</th>
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

        $('#server-side-datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('admin.teams.data') }}",
            "columns": [
                { data: 'id' },
                { data: '' },
                { data: 'email' },
                { data: '' },
            ],
            columnDefs:[
                {
                    // Role
                    targets: 1,
                    render: function (data, type, full, meta) {
                    return full.roles[0].name;
                    }
                },
                {
                    // Actions
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function (data, type, full, meta) {
                    let destroy = "{{route("admin.teams.destroy",["team"=>"__id__"])}}".replace('__id__',full.id)
                    return (
                        '<button data-url="' + destroy +'" id="delete-data" class="btn btn-danger">Delete</button>'
                    );
                    }
                }
            ],
        });
    });
</script>
@endpush
