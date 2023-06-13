@extends('layouts.auth')

@section('title','Admin Login')

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
        <h4>Admin Login</h4>
        <h6>Login to your admin account.</h6>
        <div class="form-group mt-5">
            <label>Email<span class="text-danger">*</span></label>
            <div class="input-group"><span class="input-group-text"> <i class="fa-solid fa-envelope fs-5"></i></span>
                <input class="form-control" type="email" required="" name="email" placeholder="abc@example.com">
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
        <div class="form-group">
            <div class="checkbox">
                <input id="checkbox1" type="checkbox">
                <label class="text-muted" for="checkbox1">Remember password</label>
            </div><a class="link" href="{{ route('admin.forget-password.email') }}">Forgot password?</a>
        </div>
        <div class="form-group mt-4 pt-2">
            <button class="btn btn-primary btn-block w-100 fw-light" type="submit">Login</button>
        </div>
        {{-- <div class="login-social-title">
            <h5 class="fw-normal">Login in with</h5>
        </div>
        <div class="form-group">
            <ul class="login-social">
                <li><a href="" target="_blank"><i class="fab fa-google text-danger"></i></a></li>
                <li><a href="https://twitter.com" target="_blank"><i class="fab fa-apple fs-5 text-dark"></i></a></li>
            </ul>
        </div> --}}
    </form>
</div>

@endsection

@push('page-scripts')

@endpush
