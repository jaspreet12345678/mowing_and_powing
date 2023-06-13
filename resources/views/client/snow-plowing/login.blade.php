<div id="login">
    <form class="theme-form login-form needs-validation" novalidate="" action="" method="POST" id="login-form">
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
                <input id="remember_me" class="form-check-input" type="checkbox" name="remember_me">
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
        <p>Don't have an account?<a id="signup" class="ms-2" href="#">Sign Up</a></p>
    </form>
</div>



<div id="signUp">
    <form class="theme-form login-form needs-validation" novalidate="" action="" method="POST">
        @csrf
        <h4>Create your account </h4>
        <div class="text-center mt-5 mb-4">
            <h5>Verify email and number</h5>
        </div>
        <span class="">What's your email and phone number?</span>
        <br>
        <span class="fs-12">We'll send a code to verfiy your email and number.</span>

        <div class="form-group mt-5">
            <label>Email Address<span class="text-danger">*</span></label>
            <div class="input-group"><span class="input-group-text"><i class="fa-solid fa-envelope fs-5"></i></span>
                <input class="form-control" type="email" name="email" required="" placeholder="abc@gmail.com" value="{{old('email')}}">
            </div>
        </div>
        <div class="form-group">
            <label>Phone Number<span class="text-danger">*</span></label>
            <div class="input-group"><span class="input-group-text">+1</span>
                <input class="form-control" type="text" name="phone_number" maxlength="10" required="" placeholder="Phone Number" value="{{old('phone_number')}}">
            </div>
        </div>

        <div class="form-group mt-5 pt-5">
            <button class="btn btn-primary btn-block w-100 fw-light py-2" disabled type="submit">NEXT</button>
        </div>
        <div class="login-social-title mt-4 ">
            <h5 class="fw-normal">Sign up with</h5>
        </div>
        <div class="form-group">
            <ul class="login-social">
                <li><a href="{{ route('auth.google') }}" target="_blank"><i class="fab fa-google text-danger"></i></a>
                </li>
                {{-- <li><a href="https://www.apple.com/login" target="_blank"><i
                            class="fab fa-apple fs-5 text-dark"></i></a></li> --}}
            </ul>
        </div>
        <p>Already have an account?<a class="ms-2" href="#" id="signin" >Log in</a></p>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('#signUp').hide();
        $('#signup').click(function(event) {
            event.preventDefault();
            $('#login').hide();
            $('#signUp').show();
        });
        $('#signin').click(function(event) {
            event.preventDefault();
            $('#login').show();
            $('#signUp').hide();
        });

        // Rest of your JavaScript code

        $('#login-form').submit(function(event) {
            event.preventDefault();
            var data = $(this).serialize() + '&additionalVar1=' + encodeURIComponent('1');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: "{{ route('web.login') }}",
                type: 'post',
                data: data,
                dataType: 'json',
                success: function(res) {
                    if (res && res.success === true) {
                        successMessage(res.message);
                        $('#get-summary').trigger('click');
                    } else if (res && res.success === false) {
                        errorMessage(res.message);
                    }
                },
                error: function(err) {
                    console.log(err);
                    errorMessage(err.error);
                }
            });
        });


        //     event.preventDefault();
        //     var data = $(this).serialize() + '&additionalVar1=' + encodeURIComponent('1');

        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': "{{ csrf_token() }}"
        //         },
        //         url: "{{ route('web.login') }}",
        //         type: 'post',
        //         data: data,
        //         dataType: 'json',
        //         success: function(res) {
        //             if (res && res.success === true) {
        //                 successMessage(res.message);
        //                 $('#get-summary').trigger('click');
        //             } else if (res && res.success === false) {
        //                 errorMessage(res.message);
        //             }
        //         },
        //         error: function(err) {
        //             console.log(err);
        //             errorMessage(err.error);
        //         }
        //     });
        // });
    });
</script>