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
    .validation-fs{
      font-size: 12px;
    }
</style>
@endpush

@section('body')
<div class="login-card">
    <form class="theme-form login-form" method="post" id="verification-form">
        @csrf
        <div class="text-center">
            <h4 class="mb-3 text-dark">Verify your Email</h4>
            <h5 class="text-muted fw-normal">Enter the 6 digit code</h5>
            <h6 class="text-dark">sent to ({{ $email ?? '' }})</h6>
        </div>
        <div class="form-group mt-5 pt-5">
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
                <input name="email" type="hidden" value="{{$email ?? ''}}">
            </div>
        </div>
        <p id="demo" class="text-danger validation-fs"></p>

        <div class="text-center my-5">
            <a href="" id="resend-code" class="text-green fs-6">Resend Code</a>
        </div>
        <div class="form-group mt-4 pt-2">
            <button class="btn btn-primary btn-block w-100 fw-light" id="verification-btn" type="submit">NEXT</button>
        </div>
        <div class="login-social-title mt-4">
            <h5 class="fw-normal">Sign up with</h5>
        </div>
        <div class="form-group">
            <ul class="login-social">
                <li><a href="https://www.google.com/login" target="_blank"><i class="fab fa-google text-danger"></i></a>
                </li>
                <li><a href="https://www.apple.com/login" target="_blank"><i
                            class="fab fa-apple fs-5 text-dark"></i></a></li>
            </ul>
        </div>
        <p>Already have an account?<a class="ms-2" href="login.html">Log in</a></p>
    </form>
</div>
@endsection

@push('page-scripts')

@endpush
