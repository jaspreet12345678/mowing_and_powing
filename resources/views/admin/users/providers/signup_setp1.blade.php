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
                     <h3>Provider</h3>
                 </div>
                 <div class="col-12 col-sm-6">
                     <ol class="breadcrumb">
                         <li class="breadcrumb-item"> <a class="home-item" href="{{ route('admin.dashboard.index') }}"><i
                                     data-feather="home"></i></a></li>
                         <li class="breadcrumb-item">Users</li>
                         <li class="breadcrumb-item active">Provider</li>
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
                         <form class="needs-validation"  method="post"
                             action="{{ route('admin.users.provider.signup-step1') }}" enctype="multipart/form-data"
                             novalidate="">
                             @csrf
                             <div class="form-group mt-5">
                                 <label>Email Address<span class="text-danger">*</span></label>
                                 <div class="input-group"><span class="input-group-text"><i
                                             class="fa-solid fa-envelope fs-5"></i></span>
                                     <input class="form-control" type="email" name="email" required=""
                                         placeholder="abc@gmail.com" value="{{ old('email') }}">
                                 </div>
                             </div>
                             <div class="form-group">
                                 <label>Phone Number<span class="text-danger">*</span></label>
                                 <div class="input-group"><span class="input-group-text"><i
                                             class="fa-solid fa-phone"></i></span>
                                     <input class="form-control" type="text" name="phone_number" required=""
                                         placeholder="Phone Number" value="{{ old('phone_number') }}">
                                 </div>
                             </div>
                             <br><br>
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


 @endpush
