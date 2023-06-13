@extends('layouts.auth')

@section('title','Verification')

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
<div class="login-card">
    <form class="theme-form login-form" method="get" id="verification-form" action="{{ route('admin.forget-password.verify-email.index') }}">
        <div class="text-center">
            <h4 class="text-dark mb-3">Enter your email</h4>
        </div>
        <div class="form-group mt-5">
            <label>Email Address<span class="text-danger">*</span></label>
           <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-envelope fs-5"></i></span>
               <input class="form-control" type="email" name="email" required="" placeholder="abc@gmail.com">
           </div>
       </div>

        <div class="form-group mt-4 pt-2">
            <button class="btn btn-primary btn-block w-100 fw-light" id="verification-btn" type="submit">NEXT</button>
        </div>
    </form>

</div>
@endsection

@push('page-scripts')


@endpush
