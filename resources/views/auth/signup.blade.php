@extends('layouts.auth')
@section('form')
    <h1 class="title1 uppercase">Welcome to</br>{{ config('app.name') }}</h1>
    <p>Lets get started by creating your account</p>
    <form method="POST" action="{{ route('auth.signup') }}">
        @csrf
        <div class="box-form-design1">
            <div class="form-group-custom1">
                <label for="first-name" class="label-custom1">First name</label>
                <input id="first-name" name="first_name" value="{{ old('first_name') }}" type="text" class="input-custom1 @if($errors->has('first_name')) is-invalid @endif" placeholder="First name" autofocus="autofocus" required/>
                @if($errors->has('first_name'))
                <div class="invalid-feedback">
                    {{ $errors::first('first_name') }}
                </div>
                @endif
            </div>
            <div class="form-group-custom1">
                <label for="last-name" class="label-custom1">Last name</label>
                <input id="last-name" name="last_name" value="{{ old('last_name') }}" type="text" class="input-custom1 @if($errors->has('last_name')) is-invalid @endif" placeholder="Last name" required/>
                @if($errors->has('last_name'))
                <div class="invalid-feedback">
                    {{ $errors::first('last_name') }}
                </div>
                @endif
            </div>
            <div class="form-group-custom1">
                <label for="phone" class="label-custom1">Phone number</label>
                <input id="phone" name="phone" value="{{ old('phone') }}" type="text" class="input-custom1 @if($errors->has('phone')) is-invalid @endif" placeholder="Phone number" required/>
                @if($errors->has('phone'))
                <div class="invalid-feedback">
                    {{ $errors::first('phone') }}
                </div>
                @endif
            </div>
            <div class="form-group-custom1">
                <label for="email" class="label-custom1">E-mail</label>
                <input id="email" name="email" value="{{ old('email') }}" type="email" class="input-custom1 @if($errors->has('email')) is-invalid @endif" placeholder="E-mail" required/>
                @if($errors->has('email'))
                <div class="invalid-feedback">
                    {{ $errors::first('email') }}
                </div>
                @endif
            </div>
            <div class="form-group-custom1">
                <label for="password" class="label-custom1">Create password</label>
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
                <button class="btn-design1" type="submit">Continue signup</button>
            </div>
        </div>
    </form> 
@endsection