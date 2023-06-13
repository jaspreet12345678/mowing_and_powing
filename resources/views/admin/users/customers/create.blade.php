 @extends('layouts.admin')

 @section('title', 'Admins')

 @push('vendor-styles')
     <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
 @endpush

 @push('page-styles')
     <style>
         .error-msg {
             color: #FF0000;
         }
     </style>
 @endpush

 @section('body')
     <div class="container-fluid">
         <div class="page-title">
             <div class="row">
                 <div class="col-12 col-sm-6">
                     <h3>Customers</h3>
                 </div>
                 <div class="col-12 col-sm-6">
                     <ol class="breadcrumb">
                         <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                     data-feather="home"></i></a></li>
                         <li class="breadcrumb-item">Users</li>
                         <li class="breadcrumb-item active">Customers</li>
                     </ol>
                 </div>
             </div>
         </div>
     </div>
     <div class="container-fluid">
         <div class="row">
             <div class="col-sm-12">
                 <div class="card">
                     <div class="card-header pb-0">
                         <h5>Add New Customer</h5><span></span>
                     </div>
                     <div class="card-body">
                         <form class="needs-validation" onsubmit="return validateForm()" method="post"
                             action="{{ route('admin.users.save-customers') }}" enctype="multipart/form-data"
                             novalidate="">
                             @csrf
                              <div class="row g-3">
                              <div class="form-group mt-5">
                                 <label>Email Address<span class="text-danger">*</span></label>
                                 <div class="input-group"><span class="input-group-text"><i
                                             class="fa-solid fa-envelope fs-5"></i></span>
                                     <input class="form-control" type="email" name="email" required=""
                                         placeholder="abc@gmail.com" value="{{ old('email') }}">
                                         <div class="invalid-feedback">Please Enter Valid Email Address</div>
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label>Phone Number<span class="text-danger">*</span></label>
                                 <div class="input-group"><span class="input-group-text">+1</span>
                                     <input class="form-control" type="text" name="phone_number" maxlength="10" required=""
                                         placeholder="Phone umber" value="{{ old('phone_number') }}">
                                         <div class="invalid-feedback">Please Enter Phone Number</div>
                                 </div>
                             </div>

                             </div><br>
                             <div class="row g-3">
                                 <div class="col-md-6">
                                     <label class="form-label" for="validationCustom01">First name*</label>
                                     <input class="form-control" value="{{ old('first_name') }}" minlength="3"
                                         maxlength="40" name="first_name" id="validationCustom01" type="text"
                                         required="">
                                     <div class="invalid-feedback">Please Enter First name</div>
                                 </div>
                                 <div class="col-md-6">
                                     <label class="form-label" for="validationCustom02">Last name*</label>
                                     <input class="form-control"name="last_name" minlength="3" maxlength="40"
                                         value="{{ old('last_name') }}" id="validationCustom02" type="text"
                                         required="">
                                     <div class="invalid-feedback">Please Enter Last name</div>
                                 </div>
                             </div>
                             <br>

                             <div class="row g-3">
                                 <div class="col-md-6">
                                     <label class="form-label" for="validationCustom02">Password*</label>
                                     <input class="form-control" value="{{ old('password') }}" name="password"
                                         id="validationCustom02" type="password" required="">
                                     <div class="invalid-feedback">Please Enter Password</div>
                                 </div>
                                 <div class="col-md-6 mb-3">
                                     <label class="form-label" for="validationCustomUsername">Re Enter Password*</label>
                                     <div class="input-group">
                                         <input class="form-control" value="{{ old('password_confirmation') }}"
                                             name="password_confirmation" id="validationCustomUsername" type="password"
                                             placeholder="password_confirmation" aria-describedby="inputGroupPrepend"
                                             required="">
                                         <div class="invalid-feedback">Re Enter Password Required</div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row g-3">
                                 <div class="col-md-4">
                                     <label class="form-label" for="validationCustom01">Reffered By</label>
                                     <input class="form-control" value="{{ old('reffered_by') }}" id="reffered_by"
                                         id="validationCustom01" type="text">
                                 </div>
                                 <div class="col-md-4">
                                     <label class="form-label" for="validationCustom02">Referral Link</label>
                                     <input class="form-control" value="{{ old('refferal_link') }}" name="refferal_link"
                                         id="validationCustom02" type="text">
                                 </div>
                                 <div class="col-md-4 mb-3">
                                     <label class="form-label" for="validationCustom03">Address*</label>
                                     <div class="input-group">
                                         <input id="location" value="{{ old('address') }}" class="form-control"
                                             type="text" name="address" required="" placeholder="Enter address">
                                         <input type="hidden" class="form-control" name="lat" id="lat"
                                             required="">
                                         <input type="hidden" class="form-control" name="lng" id="lng"
                                             required="">
                                         <div class="invalid-feedback choose_address">Please Choose Address From DropDown
                                         </div>
                                         <div id="map_address"></div>
                                     </div>
                                 </div>
                             </div>

                             <div class="col-md-6">
                                 <label class="form-label" for="validationCustom03">Profile Image</label>
                                 <input class="form-control" name="profile_pic" id="validationCustom03" type="file"
                                     placeholder="City">
                                 <div class="invalid-feedback">Please Upload Profile Pic</div>
                             </div>

                             <div class="mb-3">
                                 <div class="form-check">
                                     <div class="checkbox p-0">
                                         <input class="form-check-input" id="invalidCheck" type="checkbox"
                                             required="">
                                         <label class="form-check-label" for="invalidCheck">Agree to terms and
                                             conditions</label>
                                     </div>
                                     <div class="invalid-feedback">You must agree before submitting.</div>
                                 </div>
                             </div>
                             <button class="btn btn-primary" type="submit">Submit form</button>
                         </form>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 @endsection
 @push('vendor-scripts')
     {{-- <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script> --}}
     <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
 @endpush

 @push('page-scripts')
     <script type="text/javascript">
         var script = document.createElement("script");
         script.src = "https://maps.google.com/maps/api/js?key=" + "{{ config('google.GOOGLE_MAPS_APIKEY') }}" +
             "&libraries=places";
         script.type = "text/javascript";
         script.addEventListener('load', function() {
             google.maps.event.addDomListener(window, 'load', initialize);

             function initialize() {

                 var input = document.getElementById('location');
                 var options = {
                     componentRestrictions: {
                         country: ["us"]
                     }
                 };
                 var autocomplete = new google.maps.places.Autocomplete(input, options);


                 autocomplete.addListener('place_changed', function() {
                     var place = autocomplete.getPlace();
                     var lat = place.geometry['location'].lat();
                     var lang = place.geometry['location'].lng();

                     $('#lat').val(place.geometry['location'].lat());
                     $('#lng').val(place.geometry['location'].lng());
                 });
             }
         });

         document.head.appendChild(script);
     </script>
     <script>
         function validateForm() {
             var lat = $('#lat').val();
             var lang = $('#lng').val();
             if (lat == '' || lng == '') {
                 var errName = $(".choose_address").show(); //Element selector

                 return false;
             }
         }
     </script>
 @endpush
