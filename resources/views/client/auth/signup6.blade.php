@extends('layouts.auth')

@section('title','Signup')

@push('page-styles')
<style>
    .login-form h4 {
        text-transform: none;
    }
    .fs-12{
        font-size: 12px;
    }
</style>
@endpush

@section('body')
<div class="login-card">
    <form class="theme-form login-form needs-validation" novalidate="" action="" method="POST">
        @csrf
        <h4>Create your account </h4>
        <div class="text-center mt-5 mb-4">
            <h5>Verify your phone number</h5>
        </div>
        <span class="">What's your phone number?</span>
        <br>
        <span class="fs-12">We'll send a code to verfiy your phone number.</span>

        <!-- <div class="form-group mt-5">
             <label>Email Address<span class="text-danger">*</span></label>
            <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-envelope fs-5"></i></span>
                <input class="form-control" type="email" name="email" required="" placeholder="abc@gmail.com"
                    value="{{old('email')}}">
            </div>
        </div> -->
        <div class="form-group mt-5">
            <label>Phone Number<span class="text-danger">*</span></label>
            <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                <input class="form-control" type="text" name="phone_number" required="" placeholder="Phone Number"
                    value="{{old('phone_number')}}">
            </div>
        </div>
        
        <div class="form-group mt-5 pt-5">
            <button class="btn btn-primary btn-block w-100 fw-light py-2" type="submit">NEXT</button>
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
