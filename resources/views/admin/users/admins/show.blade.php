@extends('layouts.admin')

@section('title', 'Admin Profile')

@push('vendor-styles')
    <link rel="stylesheet" type="text/css" href="cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    {{--
<link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css"> --}}


    <link rel="">
@endpush

@push('page-styles')
@endpush
<style>
    /* Style the Image Used to Trigger the Modal */
    img {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }

    img:hover {
        opacity: 0.7;
    }

    /* The Modal (background) */
    #image-viewer {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.9);
    }

    .modal-content {
        margin: auto;
        display: block;
        width: 100%;
        max-width: 700px;
    }

    .modal-content {
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }

        to {
            transform: scale(1)
        }
    }


    #image-viewer .close:hover,
    #image-viewer .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    @media only screen and (max-width: 700px) {
        .modal-content {
            width: 50%;
        }
    }
</style>
@section('body')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Admins Profile</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                    data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item">Admins</li>
                        <li class="breadcrumb-item active">Admins Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div id="image-viewer">
        <img class="modal-content" id="full-image">
    </div>
    <div class="container-fluid">
        <div class="user-profile">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="card profile-header p-3" style="height: 200px">
                        <div class="body text-center">
                            <div class="profile-image mb-3">
                                <div data-rmiz-wrap="visible" class="images"> <img
                                        src="{{ asset($customer->image) }}" class="rounded-circle" alt=""
                                        style="height: 108px; width: 108px;">
                                </div>
                            </div>
                            <div>
                                <h4 class="mb-0 user-info-color">
                                    <strong>{{ isset($customer->name) ? $customer->name : '' }}</strong>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4 p-4">
                        <div class="header ">
                            <h2 class="user-info-color">Info</h2>
                        </div>
                        <div class="py-2"><small class="text-muted user-info-color ">Email address: </small>
                            <p class="user-info-color mb-0">{{ isset($customer->email) ? $customer->email : '' }}</p>
                            <hr class="mt-2">
                            <small class="text-muted user-info-color">Mobile: </small>
                            <p class="user-info-color mb-0">
                                {{ isset($customer->phone_number) ? $customer->phone_number : '' }}</p>
                            <hr class="mt-2">
                            <small class="text-muted user-info-color">Address: </small>
                            <p class="m-b-0 user-info-color">{{ isset($customer->address) ? $customer->address : '' }}
                            </p>
                            <hr class="mt-2">
                        </div>

                    </div>

                </div>

                {{-- ----- tab ----- --}}

                <div class="col-lg-8">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                 

                    </ul>

                    <div class="tab-pane show active fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <div>
                                        <h4 class="card-title add" style="position: relative;">Profile Information</h4>
                                        <form action="{{ route('admin.update-profile') }}" method="post"
                                            enctype="multipart/form-data" class="row forms-sample">
                                            @csrf
                                            <div class="col-md-6 form-group mb-4"><label for="exampleInputFirstname1">
                                                    Name</label>
                                                <input type="text"
                                                    value="{{ isset($customer->name) ? $customer->name : '' }}"
                                                    name="name" class="form-control form-control" style="color: gray;">
                                                <p class="errorMessage"></p>
                                            </div>

                                            <div class="col-md-6 form-group mb-4"><label for="exampleInputEmail1">Email
                                                    address</label>
                                                <input name="email" type="email" readonly
                                                    value="{{ isset($customer->email) ? $customer->email : '' }}"
                                                    id="exampleInputEmail11" class="form-control form-control"
                                                    style="color: gray;">
                                            </div>

                                            <div class="col-md-6 form-group mb-4"><label for="exampleInputContact"
                                                    style="display: flex;">Phone Number<span style="text-align: center;">
                                                        <div class="verify">Verified</div>
                                                    </span></label><input placeholder="Enter Phone Number"
                                                    name="phone_number" type="tel" id="exampleInputContact"
                                                    class="form-control form-control"
                                                    value="{{ isset($customer->phone_number) ? $customer->phone_number : '' }}"
                                                    style="color: gray;"></div>

                                            <div class="col-md-6 form-group mb-4"><label for="exampleInputprofile">Choose
                                                    Profile Image</label><input name="image" type="file"
                                                    id="exampleInputprofile" class="form-control form-control-file">
                                            </div>
                                            <div class="col-md-6 form-group mb-4"><label
                                                    for="exampleInputpassword">Password</label><input
                                                    placeholder="Password" type="password" name="password"
                                                    class="form-control form-control">
                                                <p class="errorMessage"></p>
                                            </div>
                                            <div class="col-md-6 form-group mb-4"><label
                                                    for="exampleInputPassword2">Confirm Password</label><input
                                                    placeholder="Confirm Password" name="password_confirmation"
                                                    type="password" id="exampleInputPassword2"
                                                    class="form-control form-control">
                                                <p class="errorMessage"></p>
                                            </div>
                                            <div class="col-md-6"></div>
                                            <div class="col-md-12 text-end">
                                                <button type="submit" class="btn btn-primary mr-2 btn-submit">Update
                                                </button>
                                                {{-- <button class="btn btn-light btn-cancel"><a
                                                        href="/admin/users/profile/1843">Cancel</a> </button> --}}
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="card mt-4 p-4">
                    <h2 class="page-title user-title my-4 profile-head">User Property</h2>
                    @if ($customer->address)
                        <div class="row">
                            <div class="col-sm-3">
                                <div data-rmiz-wrap="visible" class="images"><img class="area-img1"
                                        src="https://mowingandplowing.com/mowingplowing//properties/1673165491792.png">
                                </div>
                                <p class="text-center" style="width: 150px;">
                                    {{ isset($customer->address) ? $customer->address : '' }}</p>
                            </div>
                        </div>
                    @endif()
                </div>
            </div>
        </div>
    </div>
@endsection
@push('vendor-scripts')
    {{-- <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script> --}}
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
@endpush

@push('page-scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        $(".images img").click(function() {
            $("#full-image").attr("src", $(this).attr("src"));
            $('#image-viewer').show();
        });

        $("#image-viewer").click(function() {
            $('#image-viewer').hide();
        });
    </script>
@endpush
