@extends('layouts.admin')

@section('title','Plugins')

@push('vendor-styles')
@endpush

@push('page-styles')
@endpush

@section('body')
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Plugins</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Plugins</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-xl-6">
            <div class="card">
                <div class="card-header b-l-primary border-3 d-flex justify-content-between">
                    <h5>Stripe credentials</h5>
                    <button class="btn btn-pill btn-primary btn-air-primary" type="button" title="Update credentials" data-title="Stripe credentials" data-bs-toggle='modal' data-bs-target='#modal-opener' data-url="{{ route('admin.plugins.plugin',['plugin'=>'stripe']) }}">Update</button>
                </div>
                <div class="card-body">
                    <p>Stripe, Inc. is an Irish-American financial services and software as a service company dual-headquartered in South San Francisco, California, United States and Dublin, Ireland.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-6">
            <div class="card">
                <div class="card-header b-l-dark border-3 d-flex justify-content-between">
                    <h5>Email credentials</h5>
                    <button class="btn btn-pill btn-dark btn-air-dark" type="button" title="Update credentials" data-title="Email credentials" data-bs-toggle='modal' data-bs-target='#modal-opener' data-url="{{ route('admin.plugins.plugin',['plugin'=>'email']) }}">Update</button>
                </div>
                <div class="card-body">
                    <p>Email (electronic mail) is the exchange of computer-stored messages from one user to one or more recipients via the internet. Emails are a fast, inexpensive and accessible way to communicate for business or personal use.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-6">
            <div class="card">
                <div class="card-header b-l-danger border-3 d-flex justify-content-between">
                    <h5>Google signin credentials</h5>
                    <button class="btn btn-pill btn-danger btn-air-danger" type="button" title="Update credentials" data-title="Google Signin credentials" data-bs-toggle='modal' data-bs-target='#modal-opener' data-url="{{ route('admin.plugins.plugin',['plugin'=>'google']) }}">Update</button>
                </div>
                <div class="card-body">
                    <p>Sign In With Google helps you to quickly and easily manage user authentication and sign-in to your website. Users sign into a Google Account, provide their consent, and securely share their profile information with your platform. Customizable buttons and multiple flows are supported for user sign up and sign in.</p>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-6">
            <div class="card">
                <div class="card-header b-l-warning border-3 d-flex justify-content-between">
                    <h5>Sms Service credentials</h5>
                    <button class="btn btn-pill btn-warning btn-air-warning" type="button" title="Update credentials" data-title="Sms Service credentials" data-bs-toggle='modal' data-bs-target='#modal-opener' data-url="{{ route('admin.plugins.plugin',['plugin'=>'SmsService']) }}">Update</button>
                </div>
                <div class="card-body">
                    <p>Here you can provide the credentials and active messagebird or twilio as sms service provider.</p>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-6 col-xl-6">
            <div class="card">
                <div class="card-header b-l-warning border-3 d-flex justify-content-between">
                    <h5>Google Map Api Key</h5>
                    <button class="btn btn-pill btn-warning btn-air-warning" type="button" title="Update credentials" data-title="GOOGLE MAPS API KEY" data-bs-toggle='modal' data-bs-target='#modal-opener' data-url="{{ route('admin.plugins.plugin',['plugin'=>'google_map']) }}">Update</button>
                </div>
                <div class="card-body">
                    <p>Google Map Api key set by admin which use for choose address from google map.</p>
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
