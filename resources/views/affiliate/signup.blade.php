
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>{{ config('app.name') }} &mdash; Sign up</title>
        <meta name="viewport" content="width=device-width">
        <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.mini.png') }}"/>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"/>
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}"/>
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"/>
    </head>
    <body class="body-login">
        <div class="container">
            <div class="row d-flex justify-content-center mt-5">
                <div class="col-10 col-sm-8 col-md-6 col-lg-6 col-xl-6">
                    <div class="title-register-extern">
                        <span class="title-register-form">Register</span>
                    </div>

                    @if(Session::has('error'))
                    <div class="invalid-feedback">
                        {{ Session::get('error') }}
                    </div>
                    @endif
                    @if(Session::has('success'))
                    <div class="valid-feedback" style="display: block;">
                        {{ Session::get('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('affiliate.signup', ['store' => $store->id]) }}">
                        @csrf

                        <div class="form-group group-register-form">
                            <label class="label-register-form" for="first_name">First Name:</label>
                            <input type="text" class="form-control input-register-form" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                        </div>
                        <div class="form-group group-register-form">
                            <label class="label-register-form" for="last_name">Last Name:</label>
                            <input type="text" class="form-control input-register-form" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                        </div>
                        
                        <div class="form-group group-register-form">
                            <label class="label-register-form" for="email">Email:</label>
                            <input type="email" class="form-control input-register-form" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        
                        <button type="submit" style="display: block; width: 100%;" class="btn-thanks mt-4">Create Account</button>
                    </form>
                    <div class="container" style="text-align: center;">
                        <p class="have-account">
                            <a style="font-size: 12px; font-weight: 600; color: #000000 !important;" target="_blank" href="{{ route('signin') }}">
                                Already have an account? Sign in here.
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>