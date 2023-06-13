@extends('layouts.auth')

@section('title','Complete Registration')

@push('page-styles')
<style>
    .login-form h4 {
        text-transform: none;
    }
</style>
@endpush

@section('body')
<div class="login-card">
    <form class="theme-form login-form needs-validation" novalidate="" action="{{ route('auth.google.verify-phone-number') }}" method="POST">
        @csrf
        <h4>Complete your registration</h4>

        <div class="form-group mt-5">
            <label>Phone Number<span class="text-danger">*</span></label>
            <div class="input-group"><span class="input-group-text">+1</span>
                <input class="form-control" type="text" name="phone_number" maxlength="10" required="" placeholder="Phone Number"
                    value="{{old('phone_number')}}">
            </div>
        </div>
        <div class="form-group">
            <label>Address<span class="text-danger">*</span></label>
            <div class="input-group"><span class="input-group-text">
                <i class="fa-regular fa-pen-to-square"></i>
            </span>
                <input id="location" class="form-control" type="text" name="address" required="" placeholder="Address">
                <input type="hidden" name="lat" id="lat">
                <input type="hidden" name="lng" id="lng">
            </div>
        </div>
        <div class="form-group form-check">
            <div class="checkbox">
                <input id="checkbox1" type="checkbox" class="form-check-input" required>
                <label class="form-check-label" for="checkbox1">I agree with <span>Terms & Policy.</span></label>
            </div>
        </div>
        <div class="form-group mt-4">
            <input name="googleUser" type="hidden" value="{{ $googleUser ?? old('googleUser') }}">
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
