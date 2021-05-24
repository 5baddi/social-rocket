@extends('layouts.auth')

@section('title') New password @endsection

@section('form')
    <h1 class="title1">New password?</h1>
    <p class="text-muted">Enter a new password</p>
    <form method="POST" action="{{ route('auth.reset.token') }}">
        @csrf
        <div class="box-form-design1">
            <div class="text-start">
                @if(Session::has('error'))
                <p class="invalid-feedback">{{ Session::get('error') }}</p>
                @endif
                @if(Session::has('success'))
                <p class="valid-feedback" style="display: block;">{{ Session::get('success') }}</p>
                @endif
            </div>
            <div class="form-group-custom1">
                <label class="label-custom1">New password</label>
                <input type="password" name="password" class="input-custom1 @if ($errors->has('password')) is-invalid @endif" placeholder="New password"/>
                @if ($errors->has('password'))
                <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="form-group-custom1">
                <label class="label-custom1">Confirm new password</label>
                <input type="password" name="confirm_password" class="input-custom1 @if ($errors->has('confirm_password')) is-invalid @endif" placeholder="Confirm new password"/>
                @if ($errors->has('confirm_password'))
                <div class="invalid-feedback">{{ $errors->first('confirm_password') }}</div>
                @endif
            </div>
            <div class="box-btn-submit">
                <button class="btn-design1" type="submit">Reset password</button>
            </div>
            <p class="have-account">
                back to <a href="{{ route('signin') }}" class="link-design1">Sign in</a> page
            </p>
        </div>
    </form> 
@endsection