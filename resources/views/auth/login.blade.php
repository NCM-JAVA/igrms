@extends('layouts.app')

@section('content')
<style>
.object-fit-cover {
        object-fit: cover
    }
    .w-fit{
        width: fit-content;
        padding-top:80px !important;
    }
		.login_container {
    /* max-width: 350px; */
    background: #F8F9FD;
    background: linear-gradient(0deg, rgb(255, 255, 255) 0%, rgb(244, 247, 251) 100%);
    border-radius: 20px;
    padding: 0px 35px;
    border: 5px solid rgb(255, 255, 255);
    box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 30px 30px -20px;
    /* margin: 20px; */
}
.form .input {
    /* width: 100%; */
    background: white;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    margin-top: 10px;
    box-shadow: #cff0ff 0px 10px 10px -5px;
    border-inline: 2px solid lightgray;
}
.heading {
    padding-top: 5px;
    text-align: center;
    font-weight: 900;
    font-size: 30px;
    color: rgb(16, 137, 211);
}
.form {
    display: flex;
    flex-direction: column;
}
#ExampleCaptcha_CaptchaDiv {
    display: flex;
    width: 100% !important;
    justify-content: center;
}
.form .login-button {
    display: block;
    width: 30%;
    font-weight: bold;
    background: linear-gradient(45deg, rgb(16, 137, 211) 0%, rgb(18, 177, 209) 100%);
    color: white;
    padding-block: 10px;
    margin: 10px auto;
    border-radius: 20px;
    box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 20px 10px -15px;
    border: none;
    transition: all 0.2s ease-in-out;
}
.form .login-button:hover {
    transform: scale(1.03);
    box-shadow: rgba(133, 189, 215, 0.8784313725) 0px 23px 10px -20px;
}
.form .forgot-password a {
    font-size: 11px;
    color: #0099ff;
    text-decoration: none;
}
</style>
<div class="admin_login_section d-flex py-4 justify-content-around w-fit">
    <div class="col-lg-6 col-12 d-flex align-items-center">
   <img class="mw-100 h-100 object-fit-cover"
            src="http://125.20.102.85/dcpw/public/themes/th3/assets/images/DaD.jpg" alt="">
    </div>

    <div class="col-lg-4 col-12 login_container " style="border: 2px solid rgb(16, 137, 211);">
        <div class="heading">{{ __('Login') }}</div>
            @if(Session::has('error'))
                <div class="alert alert-danger">
                {{ Session::get('error')}}
                </div>
            @endif
            @if(Session::has('success'))
                <div class="alert alert-success">
                {{ Session::get('success')}}
                </div>
            @endif
            @if(session('sessionTimeout'))
                <div class="alert alert-warning">
                    {{ session('sessionTimeout') }}
                </div>
            @endif
        <form method="POST" class="form" action="{{ route('login') }}" id="login-form">
           @csrf
          <input class="input @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="{{ __('Email Address') }}">
                @error('email')
                    <span class=" text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
          <input class="input @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="{{ __('Password') }}">
          
            @error('password')
                    <span class=" text-danger" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <div class="row my-3 justify-content-center">
                        


                            <div class="col-md-10 captcha_start d-flex flex-column">
                                {!! captcha_image_html('ExampleCaptcha') !!}
                                <br/>
                                <input type="text" class="input mx-3 my-0 @error('CaptchaCode') is-invalid @enderror" id="CaptchaCode" placeholder="{{ __('Captcha') }}" name="CaptchaCode">
                                    @error('CaptchaCode')
                                        <span class="text-danger invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <input type="hidden" value="{{ session()->get('salt') }}" name="salttaxt">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-5">
                            <div class="">
                           
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <span class="forgot-password"> 
               @if (Route::has('password.request'))
                    <a class="" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </span>
                        </div>  
          
          <input class="login-button" type="submit" value="Sign In">
          
        </form>
   </div>
   </div>
<script src="{{ URL::asset('/public/assets/modules/jquery.min.js')}}"></script>
<script src="{{ URL::asset('/public/assets/js/sha512.js')}}"></script>
<script src="{{ URL::asset('/public/assets/js/getpwd.js')}}"></script>

<script>
		function getPass()
		{

			var salt = $('#BDC_VCID_ExampleCaptcha').val(); 
			
			
			var exp=/((?=.*\d)(?=.*[a-z])(?=.*[@#$%]).{6,10})/;

			var pvalue = $('#password').val();

			if(pvalue == ''){
				alert ("Please enter Password");
			}

			if (pvalue!=''){
				if (pvalue.search(exp)==-1) 
				{
				  //  return false;
				}
				if (pvalue!='')
				{

					var tttt=pvalue;
					var hash=sha512(pvalue);
					$('#password').val(hash);
					
				}
			}
			//$('#loginSubBTN').trigger('click');
		}

        </script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>

    <script>
        const secretKey = CryptoJS.enc.Utf8.parse("12345678901234567890123456789012"); // 32-byte key
        const iv = CryptoJS.enc.Utf8.parse("1234567890123456"); // 16-byte IV

        document.getElementById("login-form").addEventListener("submit", function (e) {
            e.preventDefault();

            const password = document.getElementById("password").value;
            // alert(password);
            // Encrypt Password using AES-256-CBC
            const encrypted = CryptoJS.AES.encrypt(password, secretKey, {
                iv: iv,
                mode: CryptoJS.mode.CBC,
                padding: CryptoJS.pad.Pkcs7
            }).toString();

            // console.log("Encrypted Password:", encrypted); // Debug
            // alert(encrypted);
            // Store encrypted password in hidden input
            document.getElementById("password").value = encrypted;

            // Submit the form
            this.submit();
        });
    </script>
@endsection
