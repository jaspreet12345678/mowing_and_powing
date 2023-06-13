 @extends('layouts.admin')

 @section('title', 'Admins')

 @push('vendor-styles')
     <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
 @endpush

 @push('page-styles')
 @endpush

 @section('body')
     <div class="container-fluid">
         <div class="page-title">
             <div class="row">
                 <div class="col-12 col-sm-6">
                     <h3>Providers</h3>
                 </div>
                 <div class="col-12 col-sm-6">
                     <ol class="breadcrumb">
                         <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                     data-feather="home"></i></a></li>
                         <li class="breadcrumb-item">Users</li>
                         <li class="breadcrumb-item active">Providers</li>
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
                         <h5>Add New Provider</h5><span></span>
                     </div>
                     <div class="card-body">
                         <form method="post" onsubmit="return validateForm()" action="{{ route('admin.users.provider.save-provider') }}" class="needs-validation"
                             enctype="multipart/form-data" novalidate="">
                             @csrf

                               <div class="form-group mt-5">
                                 <label>Email Address<span class="text-danger">*</span></label>
                                 <div class="input-group"><span class="input-group-text"><i
                                             class="fa-solid fa-envelope fs-5"></i></span>
                                     <input class="form-control" type="email" name="email" required=""
                                         placeholder="abc@gmail.com" value="{{ old('email') }}">
                                           <div class="invalid-feedback">Please Enter Valid Email Address</div>
                                 </div>
                             </div>
                             <br>
                             <div class="form-group">
                                 <label>Phone Number<span class="text-danger">*</span></label>
                                 <div class="input-group"><span class="input-group-text">+1</i></span>
                                     <input class="form-control" type="text" name="phone_number" maxlength="10" required=""
                                        placeholder="Phone number" value="{{ old('phone_number') }}">
                                           <div class="invalid-feedback">Please Enter Valid Phone Number</div>
                                 </div>
                             </div>
                             <br>

                             <div class="row g-3">
                                 <div class="col-md-6">
                                     <label class="form-label" for="validationCustom01">First name</label>
                                     <input class="form-control"  minlength="3" maxlength="40" name="first_name" value="{{ old('first_name') }}"
                                         id="validationCustom01" type="text" required="">
                                     <div class="invalid-feedback">Please Enter First name</div>
                                 </div>
                                 <div class="col-md-6">
                                     <label class="form-label" for="validationCustom02">Last name</label>
                                     <input class="form-control" maxlength="40" name="last_name" value="{{ old('last_name') }}" name="last_name"
                                         id="validationCustom02" type="text" required="">
                                     <div class="invalid-feedback">Please Enter Last name</div>
                                 </div>

                             </div>
                             <br>
                             <div class="row g-3">
                                 <div class="col-md-6">
                                     <label class="form-label" for="validationCustom02">Password</label>
                                     <input class="form-control" value="{{ old('password') }}" name="password"
                                         id="validationCustom02" type="password" required="">
                                     <div class="invalid-feedback">Please Enter Password</div>
                                 </div>
                                 <div class="col-md-6 mb-3">
                                     <label class="form-label" for="validationCustomUsername">Re Enter Password</label>
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
                                     <input class="form-control" name="reddered_by" id="validationCustom01"
                                         type="text">
                                 </div>
                                 <div class="col-md-4">
                                     <label class="form-label" for="validationCustom02">Referral Link</label>
                                     <input class="form-control" name="refferal_link" id="validationCustom02"
                                         type="text">
                                 </div>
                                 <div class="col-md-4 mb-3">
                                     <label class="form-label" for="validationCustom03">Address</label>
                                     <div class="input-group">
                                         <input id="location" value="{{ old('address') }}" class="form-control"
                                             type="text" name="address" required="" placeholder="Type Address...">
                                         <input type="hidden" name="lat" id="lat">
                                         <input type="hidden" name="lng" id="lng">
                                         <div class="invalid-feedback choose_address">Please Choose Address From DropDown</div>
                                     </div>
                                 </div>
                             </div>
                             <div class="row g-3">
                                 <div class="col-md-4">
                                     <label class="form-label" for="validationCustom01">Company Name</label>
                                     <input class="form-control" required="" value="{{ old('company_name') }}"
                                         name="company_name" id="validationCustom01" type="text">
                                     <div class="invalid-feedback">Please provide Company Name</div>
                                 </div>
                                 <div class="col-md-4">
                                     <label class="form-label" for="validationCustom02">Company Size</label>
                                     <select class="form-control" required="" name="company_size"
                                         id="validationCustom02" id="lang">
                                         <option value="1">Just me</option>
                                         <option value="2">2-10 People</option>
                                         <option value="3">10+ People</option>
                                     </select>
                                     <div class="invalid-feedback">Please Choose Company Size</div>
                                 </div>
                                 <div class="col-md-4 mb-3">
                                     <label class="form-label" for="validationCustom03">Industry Type</label>
                                     <div class="input-group">
                                         <select class="form-control" required="" name="industry_type"
                                             id="validationCustom02" id="lang">
                                             <option value="1">Lawn Mower</option>
                                             <option value="2">Snow Plower</option>
                                             <option value="3">Both</option>
                                         </select>
                                         <div class="invalid-feedback">Please Choose Industry Type</div>

                                     </div>
                                 </div>
                             </div>

                             <div class="row g-3">
                                 <div class="col-md-6 mb-3">
                                     <label class="form-label" for="validationCustom03">Company WebSite</label>
                                     <div class="input-group">
                                         <input class="form-control" value="{{ old('company_website') }}"
                                             name="company_website" id="validationCustom03" type="text"
                                             placeholder="Enter WebSite Link">

                                     </div>
                                 </div>
                                 <div class="col-md-6 mb-3">
                                     <label class="form-label" for="validationCustom03">Company Address</label>
                                     <div class="input-group">
                                         <input id="company_location" value="{{ old('company_address') }}"
                                             class="form-control" type="text" name="company_address" required=""
                                             placeholder="Enter Company address">
                                         <div class="invalid-feedback company_address">Please Choose Company Address From DropDown</div>
                                         <input type="hidden" name="company_lat" id="company_lat">
                                         <input type="hidden" name="company_lang" id="company_lng">
                                     </div>
                                 </div>
                             </div>


                             <div class="row g-3">
                                 <div class="col-md-4 mb-3">
                                     <label class="form-label" for="validationCustom03">Portfolio Images*</label>
                                     <div class="input-group">
                                         <input class="form-control" value="{{ old('company_website') }}" required=""
                                             name="protfolio_images[]" id="validationCustom03" type="file" multiple="multiple" accept=".jpg, .jpeg, .png" >

                                     </div>
                                 </div>

                                  <div class="col-md-4 mb-3">
                                     <label class="form-label" for="validationCustom03">License Images*</label>
                                     <div class="input-group">
                                         <input class="form-control" value="{{ old('company_website') }}"
                                             name="license_images[]" required="" id="validationCustom03" type="file"
                                         accept=".jpg, .jpeg, .png"    multiple="multiple">

                                     </div>
                                 </div>


                                  <div class="col-md-4 mb-3">
                                     <label class="form-label" for="validationCustom03">Insurance Images*</label>
                                     <div class="input-group">
                                         <input class="form-control" value="{{ old('company_website') }}"
                                          required=""   name="insurance_images[]" id="validationCustom03" type="file"
                                           accept=".jpg, .jpeg, .png"  multiple="multiple">

                                     </div>
                                 </div>


                             </div>

                             <div class="col-md-6">
                                 <label class="form-label" for="validationCustom03">Profile Image</label>
                                 <input class="form-control" name="profile_pic" id="validationCustom03" type="file"
                                     placeholder="City"  accept=".jpg, .jpeg, .png" >
                                 <div class="invalid-feedback">Please Choose Profile Pic</div>
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
                     $('#lat').val(place.geometry['location'].lat());
                     $('#lng').val(place.geometry['location'].lng());
                 });
             }
         });

         document.head.appendChild(script);
     </script>
     <script>
         var script = document.createElement("script");
         script.src = "https://maps.google.com/maps/api/js?key=" + "{{ config('google.GOOGLE_MAPS_APIKEY') }}" +
             "&libraries=places";
         script.type = "text/javascript";
         script.addEventListener('load', function() {

             google.maps.event.addDomListener(window, 'load', initialize);

             function initialize() {

                 var input = document.getElementById('company_location');
                 var options = {
                     componentRestrictions: {
                         country: ["us"]
                     }
                 };
                 var autocomplete = new google.maps.places.Autocomplete(input, options);


                 autocomplete.addListener('place_changed', function() {
                     var place = autocomplete.getPlace();
                     $('#company_lat').val(place.geometry['location'].lat());
                     $('#company_lng').val(place.geometry['location'].lng());
                 });
             }
         });

         document.head.appendChild(script);
     </script>
       <script>
     function validateForm() {
    var lat = $('#lat').val();
    var lang = $('#lng').val();
    var com_lat=$('#company_lat').val();
    var com_lng=$('#company_lng').val();
  if (lat == '' || lng == '') {
     var errName = $(".choose_address").show(); //Element selector
    return false;
  }
  if(com_lat== ''|| com_lng== '' ){
 var errName = $(".company_address").show(); //Element selector
    return false;
  }

}

     </script>
 @endpush
