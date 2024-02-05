<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V1</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('images/icons/favicon.ico')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
    <!--===============================================================================================-->
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="{{asset('images/sanad logo 2-05.png')}}" alt="IMG">
            </div>
            <form action="{{ route('reset.password.post') }}" method="POST">
                @csrf

                @if (Session::has('message'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <span class="login100-form-title">
                        Reset Password
					</span>
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="wrap-input100 validate-input  @error('email') is-invalid @enderror" data-validate = "Valid email is required: ex@abc.xyz">
                    <label for="email_address" class="row-cols-md-4 col-form-label text-md-right">E-Mail</label>

                    <input type="text" id="email_address" class="input100" name="email" required autofocus>
                    @if ($errors->has('email'))
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    @endif

                </div>

                <div class="wrap-input100 validate-input  @error('email') is-invalid @enderror" data-validate = "Valid email is required: ex@abc.xyz">
                    <label for="email_address" class="row-cols-md-4 col-form-label text-md-right">Password</label>

                    <input type="password" id="password" class="input100" name="password" required autofocus>
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif

                </div>

                <div class="wrap-input100 validate-input  @error('email') is-invalid @enderror" data-validate = "Valid email is required: ex@abc.xyz">
                    <label for="email_address" class="row-cols-md-4 col-form-label text-md-right">Confirm Password</label>
                    <input type="password" id="password-confirm" class="input100" name="password_confirmation" required autofocus>
                    @if ($errors->has('password_confirmation'))
                        <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                </div>
                <div class="container-login100-form-btn">
                    <button class="login100-form-btn" type="submit" style="background-color:#6C1113;color:white">
                        Reset Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--===============================================================================================-->
<script src="{{URL::asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{URL::asset('vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{URL::asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{URL::asset('vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{URL::asset('vendor/tilt/tilt.jquery.min.js')}}"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
<!--===============================================================================================-->
<script src="{{URL::asset('js/main.js')}}"></script>

</body>
</html>
