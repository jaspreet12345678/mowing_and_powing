@extends('layouts.admin')

@section('title', 'Admin Profile')

@push('vendor-styles')
    <link rel="stylesheet" type="text/css" href="cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <link href=" https://cdn.jsdelivr.net/npm/jquery-star-rating-plugin@4.11.0/jquery.rating.min.css " rel="stylesheet" />
@endpush

@push('page-styles')
@endpush
    <style>
        .gap-15 {
            gap: 15px;
        }

        .text-blue {
            color: #0275D8;
        }

        .fs-14 {
            font-size: 14px;
        }

        .fs-15 {
            font-size: 15px;
        }

        .fs-10 {
            font-size: 10px;
        }

        .text-green {
            color: #24B550;
        }

        .border {
            border: 1px solid #d4d7da !important;
        }

        /* .btn-green{
                                                                                background: #24B550 !important;
                                                                               color: #ffffff !important;
                                                                                                                                border: 1px solid #24B550 !important;
                                                                                                                            } */
        .btn-green {
            background: #24B550 !important;
            color: #ffffff !important;
            border: 1px solid #24B550 !important;
        }

        .modal-dialog {
            margin: 18rem auto;
        }
    </style>
    <style>
        /* Style the Image Used to Trigger the Modal */
        img {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .images:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        #image-viewer {
            display: none;
            position: fixed;
            z-index: 999;
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
                    <h3>Provider Profile</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                    data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item">Admins</li>
                        <li class="breadcrumb-item active">Provider Profile</li>
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
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Orders</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#detail"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Detail</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#bank_accounts"
                                type="button" role="tab" aria-controls="bank_accounts" aria-selected="false">Bank accounts</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active mt-4" id="home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="card">
                                <div class="card-body">
                                    <table id="myTable" class="table table-striped" style="width:100%">
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

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <div>
                                            <h4 class="card-title add" style="position: relative;">Basic Information</h4>
                                            <form action="{{ route('admin.users.edit-profile') }}" method="post"
                                                enctype="multipart/form-data" class="row forms-sample">
                                                @csrf
                                                <div class="col-md-6 form-group mb-4"><label>First Name</label>
                                                    <input type="text"
                                                        value="{{ isset($customer->first_name) ? $customer->first_name : '' }}"
                                                        name="first_name" class="form-control">
                                                </div>
                                                <div class="col-md-6 form-group mb-4"><label>Last Name</label>
                                                    <input type="text"
                                                        value="{{ isset($customer->last_name) ? $customer->last_name : '' }}"
                                                        class="form-control" name="last_name">
                                                </div>
                                                <div class="col-md-6 form-group mb-4"><label>Email address</label>
                                                    <input name="email" type="email" readonly
                                                        value="{{ isset($customer->email) ? $customer->email : '' }}"
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-6 form-group mb-4"><label>Phone Number<span>
                                                            {{-- <div class="verify">Verified</div> --}}
                                                        </span></label><input placeholder="Enter Phone Number"
                                                        name="phone_number" readonly type="tel" class="form-control"
                                                        value="{{ isset($customer->phone_number) ? $customer->phone_number : '' }}">
                                                </div>
                                                <div class="col-md-6 form-group mb-4"><label>Address*</label>
                                                    <input placeholder="Enter Address " autocomplete="on" name="address" id="location"
                                                        type="text"
                                                        value="{{ isset($customer->address) ? $customer->address : '' }}"
                                                        class="form-control">
                                                </div>

                                                 <input type="hidden" class="form-control" name="lat" id="lat"
                                             required="">
                                         <input type="hidden" class="form-control" name="lng" id="lng"
                                             required="">

                                                <div class="col-md-6 form-group mb-4"><label>Choose
                                                        Profile Image</label><input name="image" type="file"
                                                        class="form-control form-control-file">
                                                </div>

                                                <div class="col-md-6 form-group mb-4"><label>Password</label><input
                                                        type="password" name="password" autocomplete="off"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-6 form-group mb-4"><label>Confirm Password</label><input
                                                        placeholder="Confirm Password" name="password_confirmation"
                                                        type="password" class="form-control">
                                                </div>




                                                <div class="col-md-6"></div>
                                                <div class="col-md-12 text-end">
                                                    <button type="submit" class="btn btn-primary mr-2 btn-submit">Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- ****************** Provider Detail ***************************** --}}
                        <div class="tab-pane fade" id="detail" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <div>
                                            <h4 class="card-title add" style="position: relative;">Provider Detail</h4>
                                            <form action="{{ route('admin.users.edit-profile') }}" method="post"
                                                enctype="multipart/form-data" class="row forms-sample">
                                                @csrf
                                                <div class="col-md-6 form-group mb-4"><label>Company Name</label><input
                                                        value="{{ isset($customer->providerDetails->company_name) ? $customer->providerDetails->company_name : '' }}"
                                                        placeholder="Company name" name="company name" type="text"
                                                        class="form-control">
                                                </div>

                                                <div class="col-md-6 form-group mb-4"><label>Company size</label>
                                                    <select class="form-control" required="" name="company_size"
                                                        id="lang">
                                                        <option
                                                            {{ $customer->providerDetails->company_zise == '1' ? 'selected' : '' }}>
                                                            Just me</option>
                                                        <option
                                                            {{ $customer->providerDetails->company_zise == '2' ? 'selected' : '' }}>
                                                            2-10 People</option>
                                                        <option
                                                            {{ $customer->providerDetails->company_zise == '3' ? 'selected' : '' }}>
                                                            10+ People</option>
                                                    </select>
                                                </div>


                                                <div class="col-md-6 form-group mb-4"><label>Industry Type</label>
                                                    <select class="form-control" required="" name="company_size"
                                                        id="lang">
                                                        <option
                                                            {{ $customer->providerDetails->industry_type == '1' ? 'selected' : '' }}>
                                                            Lawn Mower</option>
                                                        <option
                                                            {{ $customer->providerDetails->industry_type == '2' ? 'selected' : '' }}>
                                                            Snow Plower</option>
                                                        <option
                                                            {{ $customer->providerDetails->industry_type == '3' ? 'selected' : '' }}>
                                                            Both</option>
                                                    </select>
                                                </div>


                                                <div class="col-md-6 form-group mb-4"><label>Company Address</label><input
                                                        value="{{ isset($customer->providerDetails->company_address) ? $customer->providerDetails->company_address : '' }}"
                                                        placeholder="Company name" name="company Address" type="text"
                                                        class="form-control">
                                                </div>

                                                {{-- Portfolio Imnages  --}}
                                                <div class="card">
                                                    <h6><strong>Portfolio Images :</strong></h6>
                                                    <div
                                                        class="card-body p-2 shadow d-flex justify-content-between overflow-scroll">
                                                        @foreach ($customer->portfolioImages as $image)
                                                            <div data-rmiz-wrap="visible" class="images me-4">
                                                                <img src="{{ asset($image->image) }}" alt=""
                                                                    width="100px" height="60px">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                               {{-- License Images --}}
                                                  <div class="card">
                                                    <h6><strong>License Images :</strong></h6>
                                                    <div
                                                        class="card-body p-2 shadow d-flex justify-content-between overflow-scroll">
                                                        @foreach ($customer->providerLicenseImages as $image)
                                                            <div data-rmiz-wrap="visible" class="images me-4">
                                                                <img src="{{ asset($image->license_image) }}" alt=""
                                                                    width="100px" height="60px">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                               {{-- Provider Insurance Images --}}
                                                 <div class="card">
                                                    <h6><strong>Insurance Information Image :</strong></h6>
                                                    <div
                                                        class="card-body p-2 shadow d-flex justify-content-between overflow-scroll">
                                                        @foreach ($customer->insuranceInformationImages as $image)
                                                            <div data-rmiz-wrap="visible" class="images me-4">
                                                                <img src="{{ asset($image->image) }}" alt=""
                                                                    width="100px" height="60px">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="col-md-6"></div>
                                                {{-- <div class="col-md-12 text-end">
                                                    <button type="submit" class="btn btn-primary mr-2 btn-submit">Update
                                                    </button>
                                                </div> --}}
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ****************** Bank Accounts ***************************** --}}
                        <div class="tab-pane fade" id="bank_accounts" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="card">
                                <div class="card-body">
                                    <table id="myTable1" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Bank Name</th>
                                                <th>Routing #</th>
                                                <th>Account #</th>
                                                <th>Is Default</th>
                                                <th>Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bankAccounts as $account)
                                                <tr>
                                                    <td>{{ $account->bank_name }}</td>
                                                    <td>{{ $account->routing_number }}</td>
                                                    <td>{{ $account->account_number }}</td>
                                                    <td>
                                                        @if ($account->account_id == $account->provider->provider_account_id)
                                                            <div class="badge bg-success">Yes</div>
                                                        @else
                                                            <div class="badge bg-danger">No</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                            $stripe = new \Stripe\StripeClient(config('stripe.LIVE_MODE') ? config('stripe.LIVE_SECRET_KEY') : config('stripe.TEST_SECRET_KEY'));
                                                            $account = $stripe->accounts->retrieve(
                                                                $account->account_id,
                                                                []
                                                            )
                                                        @endphp
                                                        @if ($account->payouts_enabled)
                                                            <div class="badge bg-success">Completed</div>
                                                        @else
                                                            <div class="badge bg-danger">Restricted</div>
                                                        @endif
                                                    </td>
                                                    {{-- <td>
                                                        <a href="#" class='btn btn-primary btn-pill px-2'>See Detail</a>
                                                    </td> --}}
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>


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

    <div class="conatiner-fluid">
        <div class="card border">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card border-2">
                            <div class="card-header border-bottom">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="text-center">
                                            <img src="{{ asset($provider->image) }}" alt="" width="120px"
                                                height="120px" class="rounded-circle">
                                            <h3 class="fw-normal mt-3">
                                                {{ $provider->first_name . ' ' . $provider->last_name }}</h3>
                                            <div class="mb-2 d-flex justify-content-center">
                                                <div class="text-golden">
                                                    <input name="total_rating" type="radio" class="star"
                                                        disabled="disabled"
                                                        {{ floor($provider->averageQualityRatings) == 1 ? 'checked' : '' }} />
                                                    <input name="total_rating" type="radio" class="star"
                                                        disabled="disabled"
                                                        {{ floor($provider->averageQualityRatings) == 2 ? 'checked' : '' }} />
                                                    <input name="total_rating" type="radio" class="star"
                                                        disabled="disabled"
                                                        {{ floor($provider->averageQualityRatings) == 3 ? 'checked' : '' }} />
                                                    <input name="total_rating" type="radio" class="star"
                                                        disabled="disabled"
                                                        {{ floor($provider->averageQualityRatings) == 4 ? 'checked' : '' }} />
                                                    <input name="total_rating" type="radio" class="star"
                                                        disabled="disabled"
                                                        {{ floor($provider->averageQualityRatings) == 5 ? 'checked' : '' }} />
                                                </div>
                                                <span class="mx-2">{{ $provider->averageQualityRatings }}</span>
                                                <span>({{ $provider->totalReviews }} Reviews)</span>
                                            </div>
                                            <div class="my-3">
                                                <span class="bg-primary p-2">Level:
                                                    {{ getProviderLevel($provider->id) }}</span>
                                            </div>
                                            <p>{{ $provider->address }}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="circle float-end">
                                            <svg id="Group_7371" data-name="Group 7371"
                                                xmlns="http://www.w3.org/2000/svg" width="33.519" height="28.824"
                                                viewBox="0 0 33.519 28.824">
                                                <path id="Path_14653" data-name="Path 14653"
                                                    d="M1122.932,341.04a1.011,1.011,0,0,1-1.072.566c-.391-.023-.784,0-1.223,0v9.6c0,.1,0,.2,0,.294a.782.782,0,0,1-.81.806q-2.275.011-4.549,0a.775.775,0,0,1-.8-.873q-.006-2.5,0-5.008V341.6h-1.037c-.164,0-.328.008-.491-.006a.786.786,0,0,1-.6-1.269c.354-.5.731-.979,1.1-1.467l3.364-4.47a.82.82,0,0,1,1.484,0q2.2,2.93,4.4,5.862c.083.111.163.224.244.336Zm-3.866,9.675V350.3q0-4.68,0-9.361a.79.79,0,0,1,.894-.913c.176,0,.353,0,.6,0L1117.551,336l-3.025,4.028c.285,0,.489-.008.692,0a.793.793,0,0,1,.824.828c.005.1,0,.2,0,.295v9.56Z"
                                                    transform="translate(-1089.413 -323.48)" fill="#0275d8" />
                                                <path id="Path_14654" data-name="Path 14654"
                                                    d="M990.545,367.839v.4q0,3.5,0,7c0,.713-.279.994-.986.994q-2.111,0-4.222,0c-.652,0-.941-.285-.941-.933q0-3.519,0-7.037v-.432h-.8c-.251,0-.5.016-.753-.008a.777.777,0,0,1-.586-1.254c.03-.045.066-.087.1-.131q2.187-2.92,4.378-5.836a1.322,1.322,0,0,1,.463-.394.732.732,0,0,1,.918.294q2.281,3.033,4.555,6.072a.766.766,0,0,1-.583,1.246c-.347.029-.7.009-1.047.01Zm-3.085-5.6-3.011,4.035c.3,0,.51-.007.724,0a.753.753,0,0,1,.767.7,2.685,2.685,0,0,1,.011.359q0,3.468,0,6.935v.376h3.021v-.379c0-2.323.013-4.645-.009-6.968-.006-.617.252-1.1,1.05-1.029.134.011.269,0,.474,0Z"
                                                    transform="translate(-970.714 -347.42)" fill="#0275d8"
                                                    opacity="0.7" />
                                                <path id="Path_14655" data-name="Path 14655"
                                                    d="M860.342,394.138c0,.391,0,.728,0,1.066q0,2.063,0,4.125a.806.806,0,0,1-.9.911q-2.177,0-4.354,0a.8.8,0,0,1-.891-.892c0-1.6,0-3.208,0-4.812v-.4c-.491,0-.956,0-1.421,0a.789.789,0,0,1-.822-.521.858.858,0,0,1,.187-.851q1.49-1.971,2.972-3.948.728-.968,1.457-1.934a.8.8,0,0,1,1.425,0q1.844,2.462,3.681,4.929c.255.341.506.684.767,1.02a.763.763,0,0,1,.118.855.782.782,0,0,1-.742.45C861.336,394.144,860.858,394.138,860.342,394.138Zm-3.065-5.583-3.027,4.013c.223,0,.365.01.5,0,.745-.063,1.026.412,1.016,1-.025,1.58-.009,3.162-.009,4.742v.347h3.008v-.367q0-2.42,0-4.841a.788.788,0,0,1,.865-.876c.191,0,.382,0,.648,0Z"
                                                    transform="translate(-851.901 -371.42)" fill="#0275d8"
                                                    opacity="0.5" />
                                                <path id="Path_14656" data-name="Path 14656"
                                                    d="M866.433,280.2c.73.1,1.431.2,2.134.277a.834.834,0,0,1,.779.549.819.819,0,0,1-.291.907c-.526.49-1.048.984-1.584,1.487l.356,1.893c.02.107.037.215.06.321a.8.8,0,0,1-1.18.869c-.564-.308-1.122-.625-1.683-.939-.086-.048-.172-.094-.283-.155l-1.587.874c-.143.079-.286.158-.431.234a.742.742,0,0,1-.858-.065.775.775,0,0,1-.3-.812c.128-.663.252-1.326.377-1.99.014-.074.021-.149.033-.237-.524-.493-1.059-.974-1.563-1.485a1.226,1.226,0,0,1-.329-.609.752.752,0,0,1,.731-.832c.734-.1,1.468-.189,2.229-.286l.765-1.65c.05-.109.1-.217.15-.326a.807.807,0,0,1,1.526-.016q.4.842.8,1.683C866.331,279.986,866.379,280.083,866.433,280.2Zm.4,1.653c-.366-.049-.655-.091-.945-.125a.826.826,0,0,1-.728-.521c-.12-.285-.264-.56-.423-.893-.148.307-.283.553-.387.812a.919.919,0,0,1-.846.61c-.273.023-.543.076-.874.125.24.229.418.421.618.585a.941.941,0,0,1,.334,1.048c-.065.257-.1.523-.154.845.285-.156.521-.266.737-.407a.946.946,0,0,1,1.127,0c.219.142.46.248.737.395-.067-.357-.118-.645-.177-.931a.855.855,0,0,1,.283-.883C866.358,282.318,866.563,282.109,866.836,281.85Z"
                                                    transform="translate(-859.365 -272.154)" fill="#ffc107" />
                                                <path id="Path_14657" data-name="Path 14657"
                                                    d="M1127.747,220.368c.129.682.256,1.356.383,2.029.014.075.03.15.041.225a.788.788,0,0,1-1.192.817l-1.659-.918c-.095-.052-.191-.1-.307-.167-.613.338-1.231.68-1.85,1.02a1.565,1.565,0,0,1-.324.153.768.768,0,0,1-.981-.9c.12-.687.258-1.37.388-2.056.012-.063.02-.128.032-.211-.516-.48-1.041-.955-1.548-1.448a1.241,1.241,0,0,1-.338-.5.751.751,0,0,1,.669-.965c.744-.106,1.49-.2,2.263-.3l.654-1.378c.107-.226.215-.452.321-.68a.737.737,0,0,1,.689-.466.751.751,0,0,1,.735.453c.28.566.542,1.141.812,1.713.051.108.1.215.171.355l1.307.174c.313.042.626.086.94.125a.765.765,0,0,1,.672.541.745.745,0,0,1-.22.834C1128.868,219.328,1128.322,219.83,1127.747,220.368Zm-4.046.918c.313-.168.571-.288.809-.437a.879.879,0,0,1,1.011,0c.238.147.493.268.8.432-.067-.333-.118-.607-.178-.88a.917.917,0,0,1,.328-.992c.213-.172.4-.373.658-.612-.357-.045-.624-.086-.892-.111a.907.907,0,0,1-.826-.592c-.109-.268-.249-.523-.4-.833-.143.3-.273.538-.371.788a.955.955,0,0,1-.9.642c-.256.019-.51.064-.809.1.255.256.471.48.695.7a.828.828,0,0,1,.257.83C1123.818,220.616,1123.77,220.916,1123.7,221.286Z"
                                                    transform="translate(-1096.876 -214.622)" fill="#ffc107" />
                                                <path id="Path_14658" data-name="Path 14658"
                                                    d="M993.111,250.764c.313-.671.623-1.331.929-1.993a.858.858,0,0,1,.581-.531.763.763,0,0,1,.9.471c.268.56.527,1.125.79,1.687.055.118.113.234.176.366.737.092,1.47.189,2.2.274a.786.786,0,0,1,.724.524.8.8,0,0,1-.257.888c-.533.5-1.069,1-1.628,1.518.1.556.211,1.122.316,1.687.038.2.082.406.108.611a.734.734,0,0,1-.331.766.785.785,0,0,1-.84.021c-.613-.333-1.22-.675-1.831-1.013-.047-.026-.1-.047-.165-.079-.63.35-1.258.721-1.908,1.049a1.189,1.189,0,0,1-.683.113.739.739,0,0,1-.555-.9c.132-.74.276-1.478.421-2.25l-1.1-1.041c-.182-.172-.363-.346-.547-.517a.749.749,0,0,1-.228-.832.765.765,0,0,1,.679-.536C991.6,250.952,992.339,250.859,993.111,250.764Zm3,4.122a5.5,5.5,0,0,0-.117-.607,1.187,1.187,0,0,1,.476-1.459,4,4,0,0,0,.43-.428c-.342-.042-.611-.079-.882-.107a.917.917,0,0,1-.823-.6c-.109-.267-.248-.521-.4-.829-.149.315-.281.566-.387.826a.924.924,0,0,1-.853.6c-.266.023-.53.066-.869.109.248.232.434.428.642.6a.955.955,0,0,1,.335,1.051c-.06.256-.094.519-.149.833.307-.166.562-.288.8-.438a.852.852,0,0,1,.98,0C995.535,254.59,995.789,254.713,996.11,254.886Z"
                                                    transform="translate(-978.053 -245.276)" fill="#ffc107" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <h6 class="float-start text-green pt-1">Total score</h6>
                                        <h1 class="float-end text-blue">{{ $totalScore }}<span
                                                class="fw-normal">%</span></h1>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                                <div class="card border mb-0">
                                    <div class="card-body px-0">
                                        <div class="row px-5">
                                            <div class="col-md-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <i class="fa-solid fa-circle fs-10 me-2 text-blue"></i>
                                                        <span>Response on time</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="progress mt-1 rounded-pill"
                                                            style="height: 11px; width: 50%;">
                                                            <div class="progress-bar rounded-pill bg-primary"
                                                                role="progressbar"
                                                                style="width: {{ $responseOnTimePerc }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <i class="fa-solid fa-circle fs-10 me-2 text-skyblue"></i>
                                                        <span>Cancel Jobs</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="progress mt-1 rounded-pill"
                                                            style="height: 11px; width: 50%;">
                                                            <div class="progress-bar rounded-pill bg-skyblue"
                                                                role="progressbar" style="width: {{ $cancelJobsPerc }}%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row px-5">
                                            <div class="col-md-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <i class="fa-solid fa-circle fs-10 me-2 text-green"></i>
                                                        <span>Completed jobs</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="progress mt-1 rounded-pill"
                                                            style="height: 11px; width: 50%;">
                                                            <div class="progress-bar rounded-pill bg-green"
                                                                role="progressbar"
                                                                style="width: {{ $completeJobsPerc }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <i class="fa-solid fa-circle fs-10 me-2 text-muted"></i>
                                                        <span>Rating</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="progress mt-1 rounded-pill"
                                                            style="height: 11px; width: 50%;">
                                                            <div class="progress-bar rounded-pill bg-muted"
                                                                role="progressbar"
                                                                style="width: {{ $qualityRatingPerc }}%"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if ($type == 'proposals')
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <a href="{{ route('job-history.upcoming-jobs.proposal.accept', $proposal_id) }}"
                                class="btn btn-green py-2 me-5 px-4">Accept</a>
                            <a href="{{ route('job-history.upcoming-jobs.proposal.cancel', $proposal_id) }}"
                                class="btn btn-danger py-2 ms-5">Decline</a>
                        </div>
                    </div>
                @endif
                <div class="card comment-box my-5">
                    <div class="card-body">
                        <h4>Reviews ({{ $provider->ratings->count() }})</h4>
                        <ul>
                            @foreach ($provider->ratings as $rating)
                                <li>
                                    <div class="media align-self-center"><img class="align-self-center rounded-circle"
                                            src="{{ asset($rating->user->image) }}" alt="Generic placeholder image">
                                        <div class="media-body">
                                            <div class="row">
                                                <div class="col-md-4"><a href="user-profile.html">
                                                        <h6 class="mt-0">
                                                            {{ $rating->user->first_name . ' ' . $rating->user->last_name }}<span>
                                                                (
                                                                {{ $rating->order->category_id == 1 ? 'Lawn Mowing' : 'Snow Plowing' }}
                                                                )</span></h6>
                                                    </a></div>
                                                <div class="col-md-8">
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <span class="me-3">Quality:</span>
                                                <span>
                                                    <input name="quality_rating_{{ $rating->id }}" type="radio"
                                                        class="star" disabled="disabled"
                                                        {{ $rating->quality_rating == 1 ? 'checked' : '' }} />
                                                    <input name="quality_rating_{{ $rating->id }}" type="radio"
                                                        class="star" disabled="disabled"
                                                        {{ $rating->quality_rating == 2 ? 'checked' : '' }} />
                                                    <input name="quality_rating_{{ $rating->id }}" type="radio"
                                                        class="star" disabled="disabled"
                                                        {{ $rating->quality_rating == 3 ? 'checked' : '' }} />
                                                    <input name="quality_rating_{{ $rating->id }}" type="radio"
                                                        class="star" disabled="disabled"
                                                        {{ $rating->quality_rating == 4 ? 'checked' : '' }} />
                                                    <input name="quality_rating_{{ $rating->id }}" type="radio"
                                                        class="star" disabled="disabled"
                                                        {{ $rating->quality_rating == 5 ? 'checked' : '' }} />
                                                </span>
                                            </div>
                                            <div class="d-flex">
                                                <span class="me-3">Response on Time:</span>
                                                <span>
                                                    <input name="response_on_time_rating_{{ $rating->id }}"
                                                        type="radio" class="star" disabled="disabled"
                                                        {{ $rating->response_time_rating == 1 ? 'checked' : '' }} />
                                                    <input name="response_on_time_rating_{{ $rating->id }}"
                                                        type="radio" class="star" disabled="disabled"
                                                        {{ $rating->response_time_rating == 2 ? 'checked' : '' }} />
                                                    <input name="response_on_time_rating_{{ $rating->id }}"
                                                        type="radio" class="star" disabled="disabled"
                                                        {{ $rating->response_time_rating == 3 ? 'checked' : '' }} />
                                                    <input name="response_on_time_rating_{{ $rating->id }}"
                                                        type="radio" class="star" disabled="disabled"
                                                        {{ $rating->response_time_rating == 4 ? 'checked' : '' }} />
                                                    <input name="response_on_time_rating_{{ $rating->id }}"
                                                        type="radio" class="star" disabled="disabled"
                                                        {{ $rating->response_time_rating == 5 ? 'checked' : '' }} />
                                                </span>
                                            </div>
                                            <p class="mt-2">{{ $rating->comment }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




@push('vendor-scripts')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src=" https://cdn.jsdelivr.net/npm/jquery-star-rating-plugin@4.11.0/jquery.rating.pack.min.js "></script>
@endpush

@push('page-scripts')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $('#myTable1').DataTable();
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
