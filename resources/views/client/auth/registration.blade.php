@extends('layouts.auth')

@section('title','Signup')

@push('page-styles')
<style>
    .login-form h4 {
        text-transform: none;
    }
</style>
@endpush

@section('body')
<div class="login-card">
    <form class="theme-form login-form needs-validation" novalidate="" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <h4>Create your account </h4>
        <h6>Enter your personal details</h6>
        <div class="form-group mt-5">
            <label>Your Name<span class="text-danger">*</span></label>
            <div class="small-group">
                <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-user-pen"></i></span>
                    <input class="form-control" type="text" name="first_name" required="" placeholder="First Name"
                        value="{{old('first_name')}}">
                </div>
                <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-user-pen"></i></span>
                    <input class="form-control" type="text" name="last_name" required="" placeholder="Last Name"
                        value="{{old('last_name')}}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Password<span class="text-danger">*</span></label>
            <div class="small-group">
                <div class="input-group"><span class="input-group-text"><i class="fa-sharp fa-solid fa-lock"></i></span>
                    <input class="form-control" type="password" name="password" required="" placeholder="Password">
                </div>
                <div class="input-group"><span class="input-group-text"><i class="fa-sharp fa-solid fa-lock"></i></span>
                    <input class="form-control" type="password" name="password_confirmation" required="" placeholder="Confirm Password">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="mb-3">
                <label for="formFile" class="form-label">Upload picture</label>
                <input class="form-control ps-4" type="file" name="image" id="formFile">
            </div>
        </div>
        <div class="form-group">
            <label>Address<span class="text-danger">*</span></label>
            <div class="input-group"><span class="input-group-text">
                <i class="fa-regular fa-pen-to-square"></i>
            </span>
                <input id="location" class="form-control" type="text" name="address" required="" placeholder="Enter address">
                <input type="hidden" name="lat" id="lat">
                <input type="hidden" name="lng" id="lng">
            </div>
        </div>
        <div class="form-group">
            <label>Referral link</label>
            <div class="input-group"><span class="input-group-text">
                <i class="fa-regular fa-pen-to-square"></i>
            </span>
                <input class="form-control" type="text" name="referral_link" value="{{old('referral_link')}}" placeholder="Enter referral link">
            </div>
        </div>
        <div class="form-group form-check">
            <div class="checkbox">
                <input id="checkbox1"  class="form-check-input" type="checkbox" required>
                <label class="form-check-label" for="checkbox1">I agree with <span>Terms & Policy.</span></label>
            </div>
        </div>
        <div class="form-group mt-4">
            <input name="email" type="hidden" value="{{$email ?? old('email')}}">
            <button class="btn btn-primary btn-block w-100 fw-light" type="submit">Create Account</button>
        </div>
    </form>
</div>

@endsection

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
