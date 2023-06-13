@extends('layouts.admin')

 @section('title', 'Admins')

 @push('vendor-styles')
     <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
 @endpush

 @push('page-styles')
   <style>
    .login-form h4 {
        text-transform: none;
    }
    .text-green{
      color: #24B550;
    }
    .text-green:hover{
      color: #239345;
    }
    .text-gray{
      color: #545454;
    }
    .validation-fs{
      font-size: 12px;
    }
</style>
 @endpush
 @section('body')

@section('body')
<div class="login-card">
    <form class="theme-form login-form" method="post" id="verification-form">
        @csrf
        <div class="text-center">
            <h4 class="text-dark mb-3">Verify your phone number</h4>
            <h5 class="text-gray fw-normal mb-3">Enter the code</h5>
            <h6 class="text-dark">sent to ( {{$phone_number}} )</h6>
        </div>
        <div class="form-group mt-5 pt-4">
            <div class="row">
                <div class="col pe-0">
                    <input class="form-control text-center opt-text shadow-sm border" id="numb" name="otp[]" type="text"
                        maxlength="1">
                </div>
                <div class="col pe-0">
                    <input class="form-control text-center opt-text shadow-sm border" type="text" name="otp[]"
                        maxlength="1">
                </div>
                <div class="col pe-0">
                    <input class="form-control text-center opt-text shadow-sm border" type="text" name="otp[]"
                        maxlength="1">
                </div>
                <div class="col pe-0">
                    <input class="form-control text-center opt-text shadow-sm border" type="text" name="otp[]"
                        maxlength="1">
                </div>
                <div class="col pe-0">
                    <input class="form-control text-center opt-text shadow-sm border" type="text" name="otp[]"
                        maxlength="1">
                </div>
                <div class="col">
                    <input class="form-control text-center opt-text shadow-sm border" type="text" name="otp[]"
                        maxlength="1">
                </div>
                <input name="phone_number" type="hidden" value="{{$phone_number ?? ''}}">
                <input name="email" type="hidden" value="{{$email ?? old('email')}}">
            </div>
        </div>
        <p id="demo" class="text-danger validation-fs"></p>

        <div class="text-center my-5">
            <a href="" id="resend-code" data-resend-for="phone_number" class="text-green fs-6">Resend Code</a>
        </div>
        <div class="form-group mt-4 pt-2">
            <button class="btn btn-primary btn-block w-100 fw-light" id="verification-btn" type="submit">NEXT</button>
        </div>
    </form>

</div>
  @endsection
 @push('vendor-scripts')
     {{-- <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script> --}}
     <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
 @endpush

 @push('page-scripts')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.3/axios.min.js" integrity="sha512-wS6VWtjvRcylhyoArkahZUkzZFeKB7ch/MHukprGSh1XIidNvHG1rxPhyFnL73M0FC1YXPIXLRDAoOyRJNni/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('sections.notification-scripts')

    <script>

        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        $(function(){
            'use strict';

            $('#resend-code').on('click',function(e){
                e.preventDefault();
                axios.post("{{route('admin.users.provider.resend-code')}}",{
                    'email':"{{$email ?? ''}}",
                    'phone_number': "{{$phone_number ?? ''}}",
                    'resend_for': $(this).data('resend-for')
                })
                    .then(response => {
                        if(response.data.success){
                            successMessage(response.data.message)
                        }else{
                            errorMessage(response.data.message)
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            });
        });
    </script>
@endpush