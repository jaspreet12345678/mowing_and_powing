@extends('layouts.admin')

@section('title','Company Settings')

@push('vendor-styles')
@endpush

@push('page-styles')
@endpush

@section('body')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Company Settings</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Company settings</li>
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
            <form class="theme-form mega-form" action="{{ route('admin.company-settings.update',['company_setting'=>$settings->id ?? 1]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card-body">
                        <div class="mb-3">
                        <label class="col-form-label">Name</label>
                        <input class="form-control" type="text" placeholder="Company Name" name="name" value="{{ $settings->name ?? '' }}">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Logo</label>
                        <input class="form-control" type="file" name="logo">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">Favicon</label>
                        <input class="form-control" type="file" name="favicon">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('vendor-scripts')
@endpush

@push('page-scripts')
@endpush
