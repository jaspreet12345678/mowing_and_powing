@extends('layouts.client')

@section('title','Refer a Friend')

@push('vendor-styles')

@endpush

@push('page-styles')

<style>
    .bg-blue {
        background: #0275D8;
    }
</style>

@endpush

@section('body')

<!--- heading & li start --->
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Refer a Friend</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href=""></a>
                    <i class="icofont icofont-users-alt-2 fs-6"></i>
                </a></li>
                <li class="breadcrumb-item">Refer a Friend</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card border">
        <div class="card-body p-0">
            <div class="bg-blue rounded-3 py-3">
                <h3 class="text-center fw-normal text-white mb-0">Know someone who needs mowing and plowing service?</h3>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <div class="d-flex justify-content-center py-5 mt-5">
                        <a href="{{ route('refer-a-friend.share') }}">
                            <img src="{{asset('assets/images/active-offer.png')}}" alt="image-not-show" width="100%">
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                    <h6 class="pt-5 mt-5 mb-4 text-center">Invite them to Mowing and Plowing</h6>
                    <div class="d-flex justify-content-center">
                        <img src="{{asset('assets/images/refer.png')}}" alt="image-not-show" width="50%">
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
