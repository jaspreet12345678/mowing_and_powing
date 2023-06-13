@extends('layouts.admin')

@section('title', 'Admin Profile')

@push('vendor-styles')
    <link rel="stylesheet" type="text/css" href="cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link rel="">
@endpush
@push('page-styles')
@endpush
<style>
   .pac-container {
        z-index: 1051 !important;
    }
    .fa-clipboard:before {
        content: "" none;
    }
    .btn-green{
        background: #24B550;
        border: 1px solid #24B550;
    }
    .modal-dialog {
        max-width: 500px;
        margin: 18rem auto;
    }

    @media (min-width: 769px) and (max-width: 992px) {
        .order-history table {
            /* width: 715px; */
            /* overflow: auto; */
        }
        .btn-green {
            /* margin-top: 10px; */
        }
    }
    @media (min-width: 577px) and (max-width: 768px) {
        .order-history table {
            /* width: 540px; */
            /* overflow: auto; */
        }
        .btn-green {
            /* margin-top: 10px; */
        }
    }
    @media (min-width: 426px) and (max-width: 576px) {
        .order-history table {
            /* width: 400px; */
            /* overflow: auto; */
        }
        .btn-green {
            /* margin-top: 10px; */
        }
    }
    @media (min-width: 376px) and (max-width: 425px) {
        .order-history table {
            /* width: 300px; */
            /* overflow: auto; */
        }
        .btn-green {
            /* margin-top: 10px; */
        }
    }
    @media (min-width: 320px) and (max-width: 375px) {
        .order-history table {
            /* width: 280px; */
            /* overflow: auto; */
        }
        .btn-green {
            /* margin-top: 10px; */
        }
    }

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

    {{-- ------ data-table style -------  --}} .dataTables_wrapper {
        position: relative !important;
    }

    .dataTables_filter {
        margin-left: 75% !important;
        position: absolute !important;
        bottom: 21rem !important;
    }

    .dataTables_wrapper .dataTables_paginate {
        margin-left: 0px !important;
        padding: 10px !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        margin: 10px !important;
        color: #007eff !important;
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
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        display: none;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
@section('body')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Customer Profile</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                    data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item">Admins</li>
                        <li class="breadcrumb-item active">Customer Profile</li>
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
                                <div data-rmiz-wrap="visible" class="images"> <img src="{{ asset($customer->image) }}"
                                        class="rounded-circle" alt="" style="height: 108px; width: 108px;">
                                </div>
                            </div>
                            <div>
                                <h4 class="mb-0 user-info-color">
                                    <strong>{{ isset($customer->first_name) ? $customer->first_name . $customer->last_name : '' }}</strong>
                                </h4>
                            </div>
                        </div>
                    </div>
                {{-- *************************** Basic Information *******************************--}}
                    <div class="card mt-4 p-4">
                        <div class="header ">
                            <h2 class="user-info-color">Basic Info</h2>
                        </div>
                        <div class="card shadow-none">
                            <strong class="text-muted user-info-color mb-3">Email address: </strong>
                            <span
                                class="user-info-color border-bottom">{{ isset($customer->email) ? $customer->email : '' }}</span>
                            <strong class="text-muted user-info-color my-3">Mobile: </strong>
                            <span class="user-info-color border-bottom">
                                {{ isset($customer->phone_number) ? $customer->phone_number : '' }}</span>
                            <strong class="text-muted user-info-color my-3">Address: </strong>
                            <span
                                class="m-b-0 user-info-color border-bottom">{{ isset($customer->address) ? $customer->address : '' }}
                            </span>
                        </div>

                    </div>

                    {{-- ******************* Wallet Amount ****************************** --}}
                    <div class="card mt-4 p-4">
                        <div class="header ">
                            <h2 class="user-info-color">Wallet Amount</h2>
                        </div>

                        <div class="card shadow-none">
                            <strong class="text-muted user-info-color mb-3">Amount: </strong>
                            <span
                                class="border-bottom">{{ isset($customer->wallet) ? $customer->wallet->amount : '0' }}</span>

                            <strong class="text-muted user-info-color my-3">Auto Refill: </strong>
                            <div class="border-bottom pb-2">
                                <div class="switch">
                                    @if ($customer->wallet)
                                        @if ($customer->wallet->auto_refill == '1')
                                            <input type="checkbox" checked>
                                        @elseif($customer->wallet->auto_refill == '0')
                                            <input type="checkbox">
                                        @endif()
                                        <div class="slider round"></div>
                                    @else
                                        <input type="checkbox">
                                        <div class="slider round"></div>
                                    @endif()
                                </div>
                            </div>
                            <strong class="text-muted user-info-color my-3">Auto Refill Amount: </strong>
                            <span
                                class="m-b-0 user-info-color border-bottom">{{ isset($customer->wallet->$customer->wallet) ? $customer->wallet->$customer->wallet : '0' }}
                            </span>
                        </div>

                    </div>

                </div>

                {{--************ ----- tab -----***************** --}}
                <div class="col-lg-8">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        {{-- Showing Tabs Name --}}
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Orders</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#favorite_provider" type="button" role="tab" aria-controls="profile"
                                aria-selected="false">Favorite Provider</button>
                        </li>
                    </ul>

                    {{-- Showing Recoreds of Tabs --}}
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active mt-4" id="home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="card">
                                <div class="card-body">
                                    <table class="myTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Order Id</th>
                                                <th>Order Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($order_detail))
                                                @foreach ($order_detail as $key => $orders)
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td>{{ $orders->order_id }}</td>
                                                        <td>{{ $orders->date }}</td>
                                                        @if ($orders->status == 1)
                                                            <td>Pending</td>
                                                        @elseif($orders->status == 2)
                                                            <td>Accepted</td>
                                                        @elseif($orders->status == 3)
                                                            <td>Completed</td>
                                                        @elseif($orders->status == 4)
                                                            <td>Canceled</td>
                                                        @endif()
                                                        <td><a href="{{ route('admin.order.view-detail', ['id' => $orders->id, 'status' => $orders->status]) }}"
                                                                class='btn btn-primary btn-pill px-2'>See Detail</a>
                                                        </td>
                                                    </tr>
                                                @endforeach()
                                            @endif()
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade   mt-4" id="favorite_provider" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="card">
                                <div class="card-body">
                                    <table class="myTable" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (!empty($fav_provider))
                                                @foreach ($fav_provider as $key => $user)
                                                    <tr>
                                                        <td>{{ ++$key }}</td>
                                                        <td>{{ $user->user->first_name }}</td>
                                                        <td>{{ $user->user->email }}</td>
                                                        <td>{{ $user->user->type }}</td>
                                                        <td><a href="{{ route('admin.users.providers.show', ['id' => $user->user->id]) }}"
                                                                class='btn btn-primary btn-pill px-2'>See Detail</a>
                                                        </td>
                                                    </tr>
                                                @endforeach()
                                            @endif()
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <div>
                                            <h4 class="card-title add" style="position: relative;">Basic Information</h4>
                                            <form action="{{ route('admin.users.edit-profile') }}" method="post"
                                                enctype="multipart/form-data" class="row forms-sample">
                                                @csrf
                                                <div class="col-md-6 form-group mb-4"><label
                                                        for="exampleInputFirstname1">First
                                                        Name</label>
                                                    <input type="text"
                                                        value="{{ isset($customer->first_name) ? $customer->first_name : '' }}"
                                                        name="first_name" class="form-control form-control"
                                                        style="color: gray;">
                                                    <p class="errorMessage"></p>
                                                </div>
                                                <div class="col-md-6 form-group mb-4"><label
                                                        for="exampleInputLastname1">Last
                                                        Name</label>
                                                    <input type="text"
                                                        value="{{ isset($customer->last_name) ? $customer->last_name : '' }}"
                                                        id="exampleInputEmail11" class="form-control form-control"
                                                        name="last_name" style="color: gray;">
                                                    <p class="errorMessage"></p>
                                                </div>
                                                <div class="col-md-6 form-group mb-4"><label
                                                        for="exampleInputEmail1">Email
                                                        address</label>
                                                    <input name="email" type="email" readonly
                                                        value="{{ isset($customer->email) ? $customer->email : '' }}"
                                                        id="exampleInputEmail11" class="form-control form-control"
                                                        style="color: gray;">
                                                </div>
                                                <div class="col-md-6 form-group mb-4"><label for="exampleInputContact"
                                                        style="display: flex;">Phone Number<span
                                                            style="text-align: center;">
                                                            <div class="verify">Verified</div>
                                                        </span></label><input placeholder="Enter Phone Number"
                                                        name="phone_number" type="tel" id="exampleInputContact"
                                                        class="form-control form-control"
                                                        value="{{ isset($customer->phone_number) ? $customer->phone_number : '' }}"
                                                        style="color: gray;"></div>
                                                <div class="col-md-6 form-group mb-4"><label
                                                        for="exampleInputAddress">Address</label><input placeholder=""
                                                        autocomplete="on" name="address" type="text" id="location"
                                                        value="{{ isset($customer->address) ? $customer->address : '' }}"
                                                        class="form-control form-control">
                                                    <p class="errorMessage">* Address is required</p>

                                                       <input type="hidden" class="form-control" name="lat" id="lat"
                                             required="">
                                         <input type="hidden" class="form-control" name="lng" id="lng"
                                             required="">
                                                </div>
                                                <div class="col-md-6 form-group mb-4"><label
                                                        for="exampleInputprofile">Choose
                                                        Profile Image</label><input name="image" type="file"
                                                        id="exampleInputprofile" class="form-control form-control-file">
                                                </div>
                                                <div class="col-md-6 form-group mb-4"><label
                                                        for="exampleInputpassword">Password</label><input
                                                        placeholder="Password" type="password" name="password"
                                                        class="form-control">
                                                    <p class="errorMessage"></p>
                                                </div>
                                                <div class="col-md-6 form-group mb-4"><label
                                                        for="exampleInputPassword2">Confirm Password</label><input
                                                        placeholder="Confirm Password" name="password_confirmation"
                                                        type="password" class="form-control">
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
                </div>

           {{-- -------********  Property **************------------- --}}
                <div class="card mt-4 p-4">
                  <button type="button" class="btn btn-outline-info border float-end mt-5 py-2 bg-white" data-bs-toggle='modal' data-bs-target='#modal'>
                    <i class="fa fa-plus pe-2" aria-hidden="true"></i> Add property</button>
                    <h2 class="page-title user-title my-4 profile-head">User Property</h2>
               <div class="row">
                <div class="order-history table-responsive wishlist">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Map</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer->Property as $properties)
                            <tr>
                                <td><img class="img-fluid" src="{{ asset('assets/images/map-img.png') }}"  alt="#"></td>
                                <td>
                                    <div class="product-name">
                                        <a href="#"><h6>{{ $properties->address }}</h6></a>
                                    </div>
                                </td>
                                <td>
                                    @if ($properties->orders->count() === 0)
                                        <button type="button" data-url="{{ route('admin.generalsettings.snow-plowing.delete-property',$properties->id) }}" id="delete-data" class="btn btn-outline-danger shadow-sm text-dark me-2">Delete</button>
                                    @endif

                                    <!-- The Modal start-->
                                    <div class="modal" id="myModal">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header justify-content-center py-5">
                                                <h4 class="modal-title text-dark fw-normal">Are you sure you want delete</h4>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer justify-content-around py-5">
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                                                <button type="button" class="btn btn-green text-white" data-bs-dismiss="modal">Yes</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content px-3">
            <div class="modal-header border-bottom-0">
                <p class="modal-title f-20 text-dark" id="modalLabel">Add address</p>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('admin.properties._add-property')
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
            $('.myTable').DataTable();
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
    <script type="text/javascript">
    var script = document.createElement("script");
    script.src = "https://maps.google.com/maps/api/js?key="+"{{ config('google.GOOGLE_MAPS_APIKEY') }}"+"&libraries=places";
    script.type = "text/javascript";
    script.addEventListener('load', function() {

        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {

            var input = document.getElementById('location');
            var options = {componentRestrictions: {country: ["us"]}};
            var autocomplete = new google.maps.places.Autocomplete(input,options);


            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                $('#lat').val(place.geometry['location'].lat());
                $('#lng').val(place.geometry['location'].lng());
            });
        }
    });

    document.head.appendChild(script);
</script>
@endpush
