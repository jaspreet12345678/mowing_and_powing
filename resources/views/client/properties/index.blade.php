@extends('layouts.client')

@section('title','Properties')

@push('vendor-styles')

@endpush

@push('page-styles')

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

</style>

@endpush

@section('body')

<!-- heading start-->
<div class="container-fluid">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-sm-6">
                <h3>Properties</h3>
            </div>
            <div class="col-12 col-sm-6">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=""><i class="far fa-clipboard"></i></a></li>
                    <li class="breadcrumb-item">Properties</li>
                    <li class="breadcrumb-item">Lawn Mowing</li>
                </ol>
                <button type="button" class="btn btn-outline-info border float-end mt-5 py-2 bg-white" data-bs-toggle='modal' data-bs-target='#modal'>
                    <i class="fa fa-plus pe-2" aria-hidden="true"></i> Add property</button>
            </div>
        </div>
    </div>
</div>
<!-- Container-fluid starts-->
<div class="container-fluid">
<div class="row">
    <div class="col-sm-12">
    <div class="card">
        <div class="card-body pt-0 px-0">
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
                        @foreach ($properties as $property)
                            <tr>
                                <td><img class="img-fluid" src="../assets/images/map-img.png" alt="#"></td>
                                <td>
                                    <div class="product-name">
                                        <a href="#"><h6>{{ $property->address }}</h6></a>
                                    </div>
                                </td>
                                <td>
                                    @if ($property->orders->count() === 0)
                                        <button type="button" data-url="{{ route('properties.delete',$property->id) }}" id="delete-data" class="btn btn-outline-danger shadow-sm text-dark me-2">Delete</button>
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
                                    <!-- The Modal end-->
                                    @if ($property->category_id == 1)
                                        <a href="{{ route('lawn-mowing.steps',['property_id'=>$property->id]) }}" class="btn btn-green shadow-sm fw-normal text-white">Order again</a>
                                    @else
                                        <a href="{{ route('snow-plowing.steps',['type'=>'home','property_id'=>$property->id]) }}" class="btn btn-green shadow-sm fw-normal text-white">Order again</a>
                                    @endif
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
</div>
<!-- Container-fluid Ends-->

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
                @include('client.properties._add-property')
            </div>
        </div>
    </div>
</div>

@endsection

@push('vendor-scripts')

@endpush

@push('page-scripts')
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
