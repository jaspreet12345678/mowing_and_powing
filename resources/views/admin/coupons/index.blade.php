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
                    <h3>Coupons</h3>
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
     <div class="col-md-2">
                <button class="btn btn-pill btn-primary btn-air-prima" type="button" title="Update credentials"
                    data-title="New Coupon" data-bs-toggle='modal' data-bs-target='#modal-opener'
                    data-url="{{ route('admin.coupon-code.add-coupon') }}">Add New</button>
            </div><br>
        <div class="row">
           @if(!empty($coupon_data))
            @foreach ($coupon_data as $coupon)
                <div class="col-sm-12 col-md-6 col-xl-6">

                    <div class="card">
                        <div class="card-header b-l-primary border-3 d-flex justify-content-between">
                            <h5><strong>{{ isset($coupon->name) ? $coupon->name : '' }}</strong></h5>
                            <div>
                                <button class="btn btn-pill btn-primary btn-air-primary" type="button"
                                    title="Update credentials" data-title="Update Coupon" data-bs-toggle='modal'
                                    data-bs-target='#modal-opener'
                                    data-url="{{ route('admin.coupon-code.edit-coupon', ['id' => $coupon->id]) }}">Update</button>
                                <button class="btn btn-pill btn-secondary btn-air-prima" type="button"
                                    title="Update credentials" data-title="Delete Coupon" data-bs-toggle='modal'
                                    data-bs-target='#modal-opener'
                                    data-url="{{ route('admin.coupon-code.coupon-delete-warning', ['id' => $coupon->id]) }}">Delete</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if ($coupon->type == 1) {
                                $coupun_type = 'flat';
                            } elseif ($coupon->type == 2) {
                                $coupun_type = '%';
                            } else {
                                $coupun_type = '';
                            }
                            
                            if ($coupon->service == 1) {
                                $service = 'lawn-mowing';
                            } elseif ($coupon->service == 2) {
                                $service = 'snow-plowing';
                            } elseif ($coupon->service == 3) {
                                $service = 'snow-plowing & snow-plowing';
                            }
                            ?>
                            <p>
                            <h6>
                                @if ($coupun_type == 'flat')
                                    <?php echo "$"; ?>
                                @endif()
                                {{ $coupon->discount . ' ' . $coupun_type . ' ' . 'off' . ' ' . 'on' . ' ' . $service }}
                            </h6>
                            </p>

                            <p>
                            <h6>{{ 'validate till' . ' ' . $coupon->valid_till }}</h6>
                            </p>

                            <p>
                            <h6>{{ isset($coupon->description) ? $coupon->description : '' }}</h6>
                            </p>

                        </div>
                    </div>

                </div>
            @endforeach
            @endif()



        </div>
    </div>
@endsection

@push('vendor-scripts')
@endpush

@push('page-scripts')
@endpush
