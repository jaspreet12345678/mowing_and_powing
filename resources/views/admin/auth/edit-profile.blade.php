@extends('layouts.admin')

@section('title','Dashboard')

@push('vendor-styles')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/date-picker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/photoswipe.css') }}">
@endpush

@push('page-styles')

<style>
    .pb-11{
        padding-bottom: 11rem !important;
    }
    .img-circle {
	border-radius: 50%;
	width: 150px;
	height: 150px;
	border: 2px solid #8e9681;
	padding: 5px;
}
</style>

@endpush

@section('body')

<!--- heading & li start --->
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Profile</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""></a>
                <i class="far fa-user-circle"></i>
                </a></li>
                <li class="breadcrumb-item">Profile</li>
                <li class="breadcrumb-item">Edit Profile</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">
            <!-- --- My Profile start--- -->
            <div class="col-xl-4 mb-5">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h4 class="card-title">My Profile</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.update-profile')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                          <div class="row mb-2">
                            <div class="profile-title">
                                <div class="media d-flex">
                                    <img  src="{{asset($activeUser->image)  }}"  class="img-circle" >
                                    <div class="media-body ms-4">
                                    <h3 class="mb-1 f-20 txt-primary fw-normal">{{ $activeUser->name}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input class="form-control" readonly type="email" name="email" value="{{ $activeUser->email }}" >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input class="form-control" readonly type="text" name="phone_number" value="{{ $activeUser->phone_number }}">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Profile  start-->
            <div class="col-xl-8 mb-5">
                    <div class="card h-100">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Edit Profile</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm- col-md-7">
                                <div class="mb-3">
                                    <label class="form-label">Name</label>
                                    <input class="form-control" name="name" value="{{ $activeUser->name }}">
                                </div>
                            </div>
                            <div class="col-sm- col-md-5"></div>
                            <div class="col-md-7">

                            </div>
                            <div class="col-sm- col-md-5"></div>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input class="form-control" name="password" type="password" autocomplete="off">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input class="form-control" name="password_confirmation" type="password" placeholder="Confirm password">
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm- col-md-5"></div>

                            <div class="col-md-7">

                            </div>
                            <div class="col-sm- col-md-5"></div>

                            <div class="col-sm- col-md-7">

                            </div>
                            <div class="col-md-5"></div>

                            <div class="col-md-7">

                            </div>
                            <div class="col-md-5"></div>

                            <div class="col-md-7">
                                <div class="">
                                    <label class="form-label">Image</label>
                                    <input class="form-control" type="file" name="image" >
                                </div>
                            </div>
                            <div class="col-md-5"></div>

                            <div class="col-md-6 mt-4"></div>
                            <div class="col-md-6 mt-4">
                                <div class="text-end">
                                    <button class="btn btn-primary" type="submit">Update Profile</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <!-- Container-fluid Ends-->
            </div>
        </div>
    </div>
</div>


@endsection

@push('vendor-scripts')

@endpush

@push('page-scripts')

@endpush
