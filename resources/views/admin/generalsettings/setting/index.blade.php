@extends('layouts.admin')

@section('title', 'Plugins')

@push('vendor-styles')
@endpush
@push('page-styles')
@endpush

@section('body')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3>Setting</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                    data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Setting</li>
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
                        <h5>Radius : {{ isset($setting_value[0]->field_value) ? $setting_value[0]->field_value : '' }} Miles</h5>
                        <button class="btn btn-pill btn-primary btn-air-primary" type="button" title="Update credentials"
                            data-title="Radius" data-bs-toggle='modal' data-bs-target='#modal-opener'
                            data-url="{{ route('admin.generalsettings.setting.show-model', ['status' => 'radius']) }}">Update</button>

                    </div>
                    <div class="card-body">
                        <p>
                            A radius is distance in miles which set by admin and all providers whose are  in between this radius will get job notifications first</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-6">
                <div class="card">
                    <div class="card-header b-l-dark border-3 d-flex justify-content-between">
                        <h5>Admin Commission :
                            {{ isset($setting_value[1]->field_value) ? $setting_value[1]->field_value : '' }}%</h5>
                        <button class="btn btn-pill btn-dark btn-air-dark" type="button" title="Update credentials"
                            data-title="Admin Commission" data-bs-toggle='modal' data-bs-target='#modal-opener'
                            data-url="{{ route('admin.generalsettings.setting.show-model', ['status' => 'admin_commission']) }}">Update</button>
                    </div>
                    <div class="card-body">
                        <p>Admin sets commission in the admin panel as per the needsadmin can sets commission in the admin
                            panel as per the needs</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-6">
                <div class="card">
                    <div class="card-header b-l-danger border-3 d-flex justify-content-between">
                        <h5>Auto Refill Limit :
                            ${{ isset($setting_value[2]->field_value) ? $setting_value[2]->field_value : '' }}
                        </h5>
                        <button class="btn btn-pill btn-danger btn-air-danger" type="button" title="Update credentials"
                            data-title="Auto Refill Limit" data-bs-toggle='modal' data-bs-target='#modal-opener'
                            data-url="{{ route('admin.generalsettings.setting.show-model', ['status' => 'auto_refill_limit']) }}">Update</button>
                    </div>
                    <div class="card-body">
                        <p>Its a amount which set by admin and its will automatically add to user wallet if user belence become less than this limit and   user has  checked on auto refil limit on  his/her dashboard</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xl-6">
                <div class="card">
                    <div class="card-header b-l-warning border-3 d-flex justify-content-between">
                        <h5>Cancel job Charges :
                            ${{ isset($setting_value[3]->field_value) ? $setting_value[3]->field_value : '' }}
                        </h5>
                        <button class="btn btn-pill btn-warning btn-air-warning" type="button" title="Update credentials"
                            data-title="Cancel Job Charges" data-bs-toggle='modal' data-bs-target='#modal-opener'
                            data-url="{{ route('admin.generalsettings.setting.show-model', ['status' => 'cancel_job_charges']) }}">Update</button>
                    </div>
                    <div class="card-body">
                        <p>These are charges which set by admin and will deduct from customer account if job assign to any provider and than customer going to cancel the job.</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-xl-6">
                <div class="card">
                    <div class="card-header b-l-warning border-3 d-flex justify-content-between">
                        <h5>Referral Bonus :
                            ${{ isset($setting_value[4]->field_value) ? $setting_value[4]->field_value : '' }}</h5>
                        <button class="btn btn-pill btn-warning btn-air-warning" type="button" title="Update credentials"
                            data-title="Referral Bonus" data-bs-toggle='modal' data-bs-target='#modal-opener'
                            data-url="{{ route('admin.generalsettings.setting.show-model', ['status' => 'referral_bonus']) }}">Update</button>
                    </div>
                    <div class="card-body">
                        <p>A referral bonus is an award given to an existing  user which will refer any other person and this person will register account on our website (i.e.if user A refer user B and user B 
                        create account than this amount will transfer user A wallet ). </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-xl-6">
                <div class="card">
                    <div class="card-header b-l-warning border-3 d-flex justify-content-between">
                        <h5>Auto Accept Proposals after:
                            {{ isset($setting_value[5]->field_value) ? $setting_value[5]->field_value : '' }} minutes</h5>
                        <button class="btn btn-pill btn-primary btn-air-primary" type="button" title="Update credentials"
                            data-title="Auto accept proposals after minutes" data-bs-toggle='modal' data-bs-target='#modal-opener'
                            data-url="{{ route('admin.generalsettings.setting.show-model', ['status' => 'auto_accept_proposal_after_mins']) }}">Update</button>
                    </div>
                    <div class="card-body">
                        <p>If customer did not accept the proposal within these minutes of order creation then after these minutes proposal will be automatically accepted.</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 col-xl-6">
                <div class="card">
                    <div class="card-header b-l-warning border-3 d-flex justify-content-between">
                        <h5>Send Job Requests to Remaining Providers after :
                            {{ isset($setting_value[5]->field_value) ? $setting_value[6]->field_value : '' }} minutes</h5>
                        <button class="btn btn-pill btn-dark btn-air-dark" type="button" title="Update credentials"
                            data-title="Send Job Requests to Remaning Providers after minutes" data-bs-toggle='modal'
                            data-bs-target='#modal-opener'
                            data-url="{{ route('admin.generalsettings.setting.show-model', ['status' => 'send_job_requests_to_remaining_providers_after_mins']) }}">Update</button>
                    </div>
                    <div class="card-body">
                        <p>First we are sending job requests to favorite providers, then after these minutes of order creation, we will send job requests to remaining providers within radius, starting from shortest radius to longest radius.</p>
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
