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
                    <h3>Snow Plowing</h3>
                </div>
                <div class="col-12 col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                    data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Snow Plowing</li>
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
                        <!-- <button class="btn btn-pill btn-primary btn-air-primary" type="button" title="Update credentials" data-title="Stripe credentials" data-bs-toggle='modal' data-bs-target='#modal-opener' data-url="{{ route('admin.plugins.plugin', ['plugin' => 'stripe']) }}">Update</button> -->
                        <h4 class="pb-0 pb-0 d-flex justify-content-between">Car Type <a
                                href="{{ route('admin.generalsettings.snow-plowing.cards-value', ['type' => 'cartype']) }}"><span
                                    type="btn"><i class="fa fa-pencil"></i></span></a>
                        </h4>

                    </div>
                </div>


            </div>
            <div class="  pb-0 col-sm-12 col-md-4 col-xl-4">
                <div class="card p-4 h-75">
                    <div>
                        <h4 class="pb-0 pb-0 d-flex justify-content-between">Car Colors <a
                                href="{{ route('admin.generalsettings.snow-plowing.cards-value', ['type' => 'colors']) }}"><span
                                    type="btn"><i class="fa fa-pencil"></i></span></a></h4>
                        <p style="margin-bottom: 0px;"> </p>
                    </div>
                </div>


            </div>
            <div class="  pb-0 col-sm-12 col-md-4 col-xl-4">
                <div class="card p-4 h-75">
                    <div>
                        <h4 class="pb-0 pb-0 d-flex justify-content-between">Admin fee<span type="btn"
                                data-bs-toggle='modal' data-bs-target='#modal-opener'
                                data-url="{{ route('admin.generalsettings.snow-plowing.snow-setting', ['type' => 'admin_feeSnow']) }}"><i
                                    class="fa fa-pencil"></i></span></h4>
                        <p style="margin-bottom: 0px;">
                            {{ isset($snowfee[0]->field_value) ? '$' . $snowfee[0]->field_value : '' }} </p>
                    </div>
                </div>


            </div>



        </div>
        <div class="row">
            <div class="pb-0 col-sm-12 col-md-4 col-xl-4">
                <div class="card p-4 h-75">
                    <div>
                        <h4 class="pb-0 pb-0 d-flex justify-content-between">Tax Rate<span type="btn"
                                data-bs-toggle='modal' data-bs-target='#modal-opener'
                                data-url="{{ route('admin.generalsettings.snow-plowing.snow-setting', ['type' => 'tax_rate_snow']) }}"><i
                                    class="fa fa-pencil"></i></span>
                        </h4>
                        <p style="margin-bottom: 0px;">
                            {{ isset($snowfee[1]->field_value) ? $snowfee[1]->field_value . '%' : '' }} </p>
                    </div>
                </div>


            </div>
            <div class="  pb-0 col-sm-12 col-md-4 col-xl-4">
                <div class="card p-4 h-75">
                    <div>
                        <h4 class="pb-0 pb-0 d-flex justify-content-between">Questions <a
                                href="{{ route('admin.generalsettings.snow-plowing.cards-value', ['type' => 'question']) }}"><span
                                    type="btn"><i class="fa fa-pencil"></i></span></a></h4>
                        <p style="margin-bottom: 0px;"></p>
                    </div>
                </div>


            </div>

        </div>



        <h6>Home</h6>
        <div class="row">
            <div class="pb-0 col-sm-12 col-md-4 col-xl-4">
                <div class="card p-4 h-75">
                    <div class="p-0">
                        <div>
                            <h4 class="p-0">Driveway<span type="btn"></span></h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Number of car</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>one car</td>
                                            <td>{{ $driverway[0]->on_first_6_cars }}</td>
                                            <td><span type="btn" data-bs-toggle='modal' data-bs-target='#modal-opener'
                                                    data-url="{{ route('admin.generalsettings.snow-plowing.drive-way', ['id' => $driverway[0]->id, 'type' => 'onecar']) }}"><i
                                                        class="fa fa-pencil"></i></span></td>
                                        </tr>
                                        <tr>
                                            <td>More than one car</td>
                                            <td>{{ $driverway[0]->on_more_than_6_cars }}</td>
                                            <td><span type="btn" data-bs-toggle='modal' data-bs-target='#modal-opener'
                                                    data-url="{{ route('admin.generalsettings.snow-plowing.drive-way', ['id' => $driverway[0]->id, 'type' => 'morecar']) }}"><i
                                                        class="fa fa-pencil"></i></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="  pb-0 col-sm-12 col-md-4 col-xl-4">
                <div class="card p-4 h-75">
                    <div class="p-0">
                        <div>
                            <h4 class="p-0">Sidewalk <span type="btn"></span> </h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($home_sidewalk as $home)
                                            <tr>
                                                <td>{{ $home->name }}</td>
                                                <td>{{ $home->price }}</td>
                                                <td><span type="btn" data-bs-toggle='modal'
                                                        data-bs-target='#modal-opener'
                                                        data-url="{{ route('admin.generalsettings.snow-plowing.side-walk', ['id' => $home->id, 'type' => $home->type]) }}"><i
                                                            class="fa fa-pencil"></i></span></td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="  pb-0 col-sm-12 col-md-4 col-xl-4">
                <div class="card p-4 h-75">
                    <div class="p-0">
                        <div>
                            <h4 class="p-0">Walkway <span type="btn"></span> </h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($home_walkway as $walkway)
                                            <tr>
                                                <td>{{ $walkway->name }}</td>
                                                <td>{{ $walkway->price }}</td>
                                                <td><span type="btn" data-bs-toggle='modal'
                                                        data-bs-target='#modal-opener'
                                                        data-url="{{ route('admin.generalsettings.snow-plowing.walk-way', ['id' => $walkway->id, 'type' => $walkway->type]) }}"><i
                                                            class="fa fa-pencil"></i></span></td>
                                            </tr>
                                        @endforeach()

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <h6>Business</h6>
        <div class="row">
            <div class="pb-0 col-sm-12 col-md-4 col-xl-4">
                <div class="card p-4 h-75">
                    <div class="p-0">
                        <div>
                            <h4 class="p-0">Driveway<span type="btn"></span></h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Number of car</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>one car</td>
                                            <td>{{ $driverway[1]->on_first_6_cars }}</td>
                                            <td><span type="btn" data-bs-toggle='modal'
                                                    data-bs-target='#modal-opener'
                                                    data-url="{{ route('admin.generalsettings.snow-plowing.drive-way', ['id' => $driverway[1]->id, 'type' => 'onecar']) }}"><i
                                                        class="fa fa-pencil"></i></span></td>
                                        </tr>
                                        <tr>
                                            <td>More than one car</td>
                                            <td>{{ $driverway[1]->on_more_than_6_cars }}</td>
                                            <td><span type="btn" data-bs-toggle='modal'
                                                    data-bs-target='#modal-opener'
                                                    data-url="{{ route('admin.generalsettings.snow-plowing.drive-way', ['id' => $driverway[1]->id, 'type' => 'morecar']) }}"><i
                                                        class="fa fa-pencil"></i></span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="  pb-0 col-sm-12 col-md-4 col-xl-4">
                <div class="card p-4 h-75">
                    <div class="p-0">
                        <div>
                            <h4 class="p-0">Sidewalk <span type="btn"></span> </h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($business_sidewalk as $business)
                                            <tr>
                                                <td>{{ $business->name }}</td>
                                                <td>{{ $business->price }}</td>
                                                <td><span type="btn" data-bs-toggle='modal'
                                                        data-bs-target='#modal-opener'
                                                        data-url="{{ route('admin.generalsettings.snow-plowing.side-walk', ['id' => $business->id, 'type' => $business->type]) }}"><i
                                                            class="fa fa-pencil"></i></span></td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="  pb-0 col-sm-12 col-md-4 col-xl-4">
                <div class="card p-4 h-75">
                    <div class="p-0">
                        <div>
                            <h4 class="p-0">Walkway <span type="btn"></span> </h4>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($business_walkway as $walkway)
                                            <tr>
                                                <td>{{ $walkway->name }}</td>
                                                <td>{{ $walkway->price }}</td>
                                                <td><span type="btn" data-bs-toggle='modal'
                                                        data-bs-target='#modal-opener'
                                                        data-url="{{ route('admin.generalsettings.snow-plowing.walk-way', ['id' => $walkway->id, 'type' => $walkway->type]) }}"><i
                                                            class="fa fa-pencil"></i></span></td>
                                            </tr>
                                        @endforeach()

                                    </tbody>
                                </table>
                            </div>
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
