@extends('layouts.auth')

@section('title','Login')

@push('page-styles')
<style>
    .login-form h4 {
        text-transform: none;
    }
</style>
@endpush

@section('body')
<div class="login-card">

    <form class="theme-form login-form needs-validation" novalidate="" action="" method="POST">
        @csrf
        <h4>Login</h4>
        <h6>Login to your account.</h6>
        <div class="form-group mt-5">
            <label>Email Address<span class="text-danger">*</span></label>
            <div class="input-group"><span class="input-group-text"> <i class="fa-solid fa-envelope fs-5"></i></span>
                <input class="form-control" type="email" required="" name="email" placeholder="abc@gmail.com">
            </div>
        </div>
        <div class="form-group">
            <label>Password<span class="text-danger">*</span></label>
            <div class="small-group">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-sharp fa-solid fa-lock"></i></span>
                    <input class="form-control" type="password" name="password" required="" placeholder="Password">
                </div>
            </div>
        </div>
        <div class="form-group form-check">
            <div class="checkbox">
                <input id="remember_me" class="form-check-input" type="checkbox" name="remember_me" >
                <label class="form-check-label" for="remember_me">Remember me</label>
            </div>
            <a class="link" href="{{ route('forget-password.email') }}">Forget password?</a>
        </div>
        <div class="form-group mt-4 pt-2">
            <button class="btn btn-primary btn-block w-100 fw-light" type="submit">Login</button>
        </div>
        <div class="login-social-title">
            <h5 class="fw-normal">Log in with</h5>
        </div>
        <div class="form-group">
            <ul class="login-social">
                <li><a href="{{ route('auth.google') }}" target="_blank"><i class="fab fa-google text-danger"></i></a></li>
                {{-- <li><a href="https://twitter.com" target="_blank"><i class="fab fa-apple fs-5 text-dark"></i></a></li> --}}
            </ul>
        </div>
        <p>Don't have an account?<a class="ms-2" href="{{route('signup') }}">Sign Up</a></p>
    </form>
</div>

@endsection

@push('page-scripts')

@endpush
