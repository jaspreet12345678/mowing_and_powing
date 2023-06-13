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
    <form class="theme-form login-form" method="post" id="verification-form" action="{{ route('admin.forget-password.reset-password') }}">
        @csrf
        <div class="text-center">
            <h4 class="text-dark mb-3">Enter your new Password</h4>
        </div>
        <div class="form-group mt-5">
            <label>Password<span class="text-danger">*</span></label>
            <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-envelope fs-5"></i></span>
                <input class="form-control" type="password" name="password" required="" placeholder="Password">
            </div>
       </div>

       <div class="form-group mt-5">
            <label>Confirm password<span class="text-danger">*</span></label>
            <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-envelope fs-5"></i></span>
                <input class="form-control" type="password" name="password_confirmation" required="" placeholder="Confirm password">
            </div>
        </div>

        <div class="form-group mt-4 pt-2">
            <input type="hidden" name="email" value="{{ $email }}">
            <button class="btn btn-primary btn-block w-100 fw-light" id="verification-btn" type="submit">NEXT</button>
        </div>
    </form>

</div>
@endsection

@push('page-scripts')


@endpush
