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
    <form class="theme-form login-form" method="post" id="verification-form">
        @csrf
        <div class="text-center">
            <h4 class="text-dark mb-3">Reset Password</h4>
            <h5 class="text-gray fw-normal mb-3">Enter the code</h5>
            <h6 class="text-dark">sent to ( {{ $email ?? '' }} )</h6>
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
                <input name="email" type="hidden" value="{{$email ?? ''}}">
            </div>
        </div>
        <p id="demo" class="text-danger validation-fs"></p>

        <div class="text-center my-5">
            <a href="" id="resend-code" data-resend-for="email" class="text-green fs-6">Resend Code</a>
        </div>
        <div class="form-group mt-4 pt-2">
            <button class="btn btn-primary btn-block w-100 fw-light" id="verification-btn" type="submit">NEXT</button>
        </div>
    </form>

</div>
@endsection

@push('page-scripts')


@endpush
