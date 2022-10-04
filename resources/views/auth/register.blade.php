@extends('layouts\appManager')

@section('title') Register @endsection

@section('content')
@if (App\Http\Controllers\userController::users() == 0)
<div id="dropDownSelect1"></div>
<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <form class="login100-form validate-form" {{-- onsubmit="return macth();" --}} method="POST" action="{{ route('register') }}">
                @csrf

                <span class="login100-form-title p-b-16">
                    Sign Up
                </span>
                <span class="login100-form-title p-b-35">
                    <i class="ri ri-user-2-fill"></i>
                </span>

                {{-- Username --}}
                <div class=" wrap-input100 validate-input"  >
                    <input id="username" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" type="text" class="input100  @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                    <span class="focus-input100" data-placeholder="Username"></span>
                    @error('Username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Email --}}
                <div class=" wrap-input100 validate-input"  data-validate = "Valid email is: a@b.c">
                    <input id="email" type="text" class="input100  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    <span class="focus-input100" data-placeholder="Email"></span>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="wrap-input100 validate-input" data-validate="Invalid password">
                    <span class="btn-show-pass" id="eye1">
                        <i class="zmdi zmdi-eye" id="i1"></i>
                    </span>
                    <input id="password" type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"
                    @error('password')
                            value ="12"
                    @enderror>
                    <span for="password" class="focus-input100" data-placeholder="{{ __('Password') }}"></span>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                {{--  --}}

                {{-- Confirm Password --}}
                <div class="wrap-input100 validate-input" data-validate="Invalid password">
                    <span class="btn-show-pass" id="eye2">
                        <i class="zmdi zmdi-eye" id="i2"></i>
                    </span>
                    <input id="password-confirm" type="password" class="input100" name="password_confirmation" required autocomplete="new-password">

                    <span for="password" class="focus-input100" data-placeholder="{{ __('Confirm Password') }}"></span>
                    <span class="invalid-feedback" role="alert">
                        <strong name="password-macth"></strong>
                    </span>
                </div>
                {{--  --}}

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button type="submit" class="login100-form-btn">{{ __('Sign Up') }}</button>
                    </div>
                </div>

                <div class="text-center p-t-35">
                    <span class="txt1">
                        Already have an account?
                    </span>

                    @if (Route::has('login'))
                        <a class="txt2" href="{{ route('login') }}">
                            {{ __('Login') }}
                        </a>
                    @endif
                </div>
                <input type="text" name="name"  style="visibility: hidden;" value="default_profile.png">
            </form>
        </div>
    </div>
</div>
<div id="dropDownSelect1"></div>

{{-- <script>
    function match(){
        var p = document.getElementById('password').innerHTML;
        var cp = document.getElementById('password-confirm').innerHTML;
        if(p == cp){
            return true;
        }
        else{
            p.innerHTML = "Password Doesn't Match. please enter the same password";
            return false;
        }
    }
</script> --}}


<script>
    function show(password) {
        var p = document.getElementById(password);
        p.setAttribute('type', 'text');
    }

    function hide(password) {
        var p = document.getElementById(password);
        p.setAttribute('type', 'password');
    }

    var pwShown = 0;

    document.getElementById("eye1").addEventListener("click", function () {
        if (pwShown == 0) {
            pwShown = 1;
            document.getElementById("i1").classList.add("zmdi-eye-off");
            document.getElementById("i1").classList.remove("zmdi-eye");
            show('password');
        } else {
            pwShown = 0;
            document.getElementById("i1").classList.add("zmdi-eye");
            document.getElementById("i1").classList.remove("zmdi-eye-off");
            hide('password');
        }
    }, false);

    document.getElementById("eye2").addEventListener("click", function () {
        if (pwShown == 0) {
            pwShown = 1;
            document.getElementById("i2").classList.add("zmdi-eye-off");
            document.getElementById("i2").classList.remove("zmdi-eye");
            show('password-confirm');
        } else {
            pwShown = 0;
            document.getElementById("i2").classList.add("zmdi-eye");
            document.getElementById("i2").classList.remove("zmdi-eye-off");
            hide('password-confirm');
        }
    }, false);

</script>

@else
    <div style="height: 200px; margin-top: 70px;">
        <h1 >Sorry not possible to signup !!!</h1><br>
        <h3>Contact the admin to register in to this system.</h3>
    </div>
@endif

@endsection
