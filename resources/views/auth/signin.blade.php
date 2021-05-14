@extends('layouts.auth')

@section('title') Sign in @endsection

@section('form')
    <h1 class="title1">Welcome back</h1>
    <form method="POST" action="{{ route('auth.signin') }}">
        @csrf
        <div class="box-form-design1">
            <div class="form-group-custom1">
                <label for="email" class="label-custom1">E-mail</label>
                <input id="email" name="email" value="{{ old('email') }}" type="email" class="input-custom1 @if($errors->has('email')) is-invalid @endif" placeholder="E-mail" autofocus required/>
                @if($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors::first('email') }}
                </div>
                @endif
            </div>
            <div class="form-group-custom1">
                <label for="password" class="label-custom1">Password</label>
                <input id="password" name="password" type="password" class="input-custom1 @if($errors->has('password')) is-invalid @endif" placeholder="Password" required/>
                @if($errors->has('password'))
                <div class="invalid-feedback">
                    {{ $errors::first('password') }}
                </div>
                @endif
                @if(Session::has('error'))
                <div class="invalid-feedback">
                    {{ Session::get('error') }}
                </div>
                @endif
            </div>
            <div class="box-btn-submit">
                <button class="btn-design1" type="submit">Login</button>
            </div>
            <p class="have-account">
                <a href="#" class="link-design1">Can’t access your account?</a>
                <a href="{{ route('signup') }}" class="link-design1">or Register</a>
            </p>
        </div>
    </form> 
@endsection