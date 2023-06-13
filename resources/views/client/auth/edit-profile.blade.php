@extends('layouts.client')

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
                        <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="profile-title">
                                <div class="media d-flex">
                                    <img class="img-70 rounded-circle" height="70" alt="" src="{{asset($activeUser->image) }}">
                                    <div class="media-body ms-4">
                                    <h3 class="mb-1 f-20 txt-primary fw-normal">{{ $activeUser->first_name.' '.$activeUser->last_name }}</h3>
                                    <p class="f-12">{{ $activeUser->type }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input class="form-control" type="email" name="email" value="{{ $activeUser->email }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone Number</label>
                            <input class="form-control" type="text" name="phone_number" value="{{ $activeUser->phone_number }}" readonly>
                        </div>
                        <div class="mb-3">
                            <a href="{{ route('delete-account') }}" class="btn btn-danger">Delete Account</a>
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
                                    <label class="form-label">First Name</label>
                                    <input class="form-control" name="first_name" value="{{ $activeUser->first_name }}">
                                </div>
                            </div>
                            <div class="col-sm- col-md-5"></div>
                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input class="form-control" name="last_name" value="{{ $activeUser->last_name }}">
                                </div>
                            </div>
                            <div class="col-sm- col-md-5"></div>
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input class="form-control" name="password" type="password" placeholder="Password">
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Country</label>
                                            <select class="form-control text-muted">
                                                <option value="0">Country</option>
                                                <option value="1">Germany</option>
                                                <option value="2">Canada</option>
                                                <option value="3">Usa</option>
                                                <option value="4">Aus</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">State</label>
                                            <input class="form-control" name="state" type="text" placeholder="State" value="{{ $activeUser->state }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm- col-md-5"></div>

                            <div class="col-sm- col-md-7">
                                <div class="row">
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input class="form-control" type="text" name="city" placeholder="City" value="{{ $activeUser->city }}">
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">ZIP Code</label>
                                        <input class="form-control" type="number" placeholder="ZIP Code">
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5"></div>

                            <div class="col-md-7">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input class="form-control" type="text" name="address" placeholder="Enter Address..." value="{{ $activeUser->address }}">
                                </div>
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
<script src="{{ asset('assets/js/chart/knob/knob.min.js') }}"></script>
<script src="{{ asset('assets/js/chart/knob/knob-chart.js') }}"></script>
<script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
<script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
<script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
<script src="{{ asset('assets/js/photoswipe/photoswipe.min.js') }}"></script>
<script src="{{ asset('assets/js/photoswipe/photoswipe-ui-default.min.js') }}"></script>
<script src="{{ asset('assets/js/photoswipe/photoswipe.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/handlebars.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/typeahead.bundle.js') }}"></script>
<script src="{{ asset('assets/js/typeahead/typeahead.custom.js') }}"></script>
<script src="{{ asset('assets/js/typeahead-search/handlebars.js') }}"></script>
<script src="{{ asset('assets/js/typeahead-search/typeahead-custom.js') }}"></script>
<script src="{{ asset('assets/js/height-equal.js') }}"></script>
@endpush

@push('page-scripts')

@endpush
