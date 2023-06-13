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
                <h3>Lawn Mowing</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Lawn Mowing</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="pb-0 col-sm-12 col-md-4 col-xl-4">
            <div class="card p-4 h-75">
                <div>
                <!-- <button class="btn btn-pill btn-primary btn-air-primary" type="button" title="Update credentials" data-title="Stripe credentials" data-bs-toggle='modal' data-bs-target='#modal-opener' data-url="{{ route('admin.plugins.plugin',['plugin'=>'stripe']) }}">Update</button> -->
                    <h4 class="pb-0 pb-0 d-flex justify-content-between">On Demand fee <span type="btn"  data-bs-toggle='modal' data-bs-target='#modal-opener' data-url="{{ route('admin.generalsettings.lawnmoving.getlawmovingfee',['type'=>'on_demand_fee']) }}"><i class="fa fa-pencil"></i></span>
                    </h4>
                    <p style="margin-bottom: 0px;">{{isset($lawnfee[0]->field_value) ? $lawnfee[0]->field_value : '' }} </p>
                </div>
            </div>


        </div>
        <div class="  pb-0 col-sm-12 col-md-4 col-xl-4">
            <div class="card p-4 h-75">
                <div>
                    <h4 class="pb-0 pb-0 d-flex justify-content-between">Lawn Size <a href="{{ route('admin.generalsettings.lawnmoving.lawn-size',['type'=>'lawnsize']) }}"><span  type="btn" ><i class="fa fa-pencil"></i></span></a></h4>
                    <p style="margin-bottom: 0px;">  </p>
                </div>
            </div>


        </div>
        <div class="  pb-0 col-sm-12 col-md-4 col-xl-4">
            <div class="card p-4 h-75">
                <div>
                    <h4 class="pb-0 pb-0 d-flex justify-content-between">Lawn Height <a href="{{ route('admin.generalsettings.lawnmoving.lawn-size',['type'=>'lawnheight']) }}"><span  type="btn" ><i class="fa fa-pencil"></i></span></a></h4>
                    <p style="margin-bottom: 0px;"> </p>
                </div>
            </div>


        </div>



    </div>
    <div class="row">
        <div class="pb-0 col-sm-12 col-md-4 col-xl-4">
            <div class="card p-4 h-75">
                <div>
                    <h4 class="pb-0 pb-0 d-flex justify-content-between">Service Delivery <a href="{{ route('admin.generalsettings.lawnmoving.lawn-size',['type'=>'ServiceDelivery']) }}"><span  type="btn" ><i class="fa fa-pencil"></i></span></a>
                    </h4>
                    <p style="margin-bottom: 0px;"></p>
                </div>
            </div>


        </div>
        <div class="  pb-0 col-sm-12 col-md-4 col-xl-4">
            <div class="card p-4 h-75">
                <div>
                    <h4 class="pb-0 pb-0 d-flex justify-content-between">Have a fence <a href="{{ route('admin.generalsettings.lawnmoving.lawn-size',['type'=>'fence']) }}"><span  type="btn" ><i class="fa fa-pencil"></i></span></a></h4>
                    <p style="margin-bottom: 0px;"></p>
                </div>
            </div>


        </div>
        <div class="  pb-0 col-sm-12 col-md-4 col-xl-4">
            <div class="card p-4 h-75">
                <div>
                    <h4 class="pb-0 pb-0 d-flex justify-content-between">Yard Cleanup <a href="{{ route('admin.generalsettings.lawnmoving.lawn-size',['type'=>'lawn-cleanup']) }}"><span  type="btn" ><i class="fa fa-pencil"></i></span></a></h4>
                    <p style="margin-bottom: 0px;"></p>
                </div>
            </div>


        </div>



    </div>
    <div class="row">
        <div class="pb-0 col-sm-12 col-md-4 col-xl-4">
            <div class="card p-4 h-75">
                <div>
                    <h4 class="pb-0 pb-0 d-flex justify-content-between">Questions<a href="{{ route('admin.generalsettings.lawnmoving.lawn-size',['type'=>'questions']) }}"><span  type="btn" ><i class="fa fa-pencil"></i></span></a>
                    </h4>
                    <p style="margin-bottom: 0px;"> </p>
                </div>
            </div>


        </div>
        <div class="  pb-0 col-sm-12 col-md-4 col-xl-4">
            <div class="card p-4 h-75">
                <div>
                    <h4 class="pb-0 pb-0 d-flex justify-content-between">Corner Lot <a href="{{ route('admin.generalsettings.lawnmoving.lawn-size',['type'=>'cornerlot']) }}"><span  type="btn" ><i class="fa fa-pencil"></i></span></a></h4>
                    <p style="margin-bottom: 0px;"> </p>
                </div>
            </div>


        </div>
        <div class="  pb-0 col-sm-12 col-md-4 col-xl-4">
            <div class="card p-4 h-75">
                <div>
                <h4 class="pb-0 pb-0 d-flex justify-content-between">Admin fee<span type="btn"  data-bs-toggle='modal' data-bs-target='#modal-opener' data-url="{{ route('admin.generalsettings.lawnmoving.getlawmovingfee',['type'=>'admin_feeLawn']) }}"><i class="fa fa-pencil"></i></span>
                    </h4>
                    <p style="margin-bottom: 0px;">{{isset($lawnfee[1]->field_value)? $lawnfee[1]->field_value: '' }} </p>
                </div>
            </div>


        </div>



    </div>
    <div class="row">
        <div class="pb-0 col-sm-12 col-md-4 col-xl-4">
            <div class="card p-4 h-75">
                <div>
                <h4 class="pb-0 pb-0 d-flex justify-content-between">Tax Rate<span type="btn"  data-bs-toggle='modal' data-bs-target='#modal-opener' data-url="{{ route('admin.generalsettings.lawnmoving.getlawmovingfee',['type'=>'tax_rate_lawn']) }}"><i class="fa fa-pencil"></i></span>
                    </h4>
                    <p style="margin-bottom: 0px;">{{isset($lawnfee[2]->field_value)? $lawnfee[2]->field_value : '' }}  </p>
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