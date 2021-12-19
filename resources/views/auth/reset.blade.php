@extends('layouts.auth')

@section('title') Reset account password @endsection

@section('form')
<div class="card-body px-md-5 py-5">
    <div class="mb-5">
        <h6 class="h3">Forgot password?</h6>
        <p class="text-muted mb-0">Enter your email and we’ll send you a reset link</p>
        @if(Session::has('error'))
            <div class="invalid-feedback">
                {{ Session::get('error') }}
            </div>
        @endif
        @if(Session::has('success'))
            <div class="valid-feedback">
                {{ Session::get('success') }}
            </div>
        @endif
    </div>
    <span class="clearfix"></span>
    <form method="POST" action="{{ route('auth.reset.token') }}">
        @csrf
        <div class="form-group">
            <label for="email" class="form-control-label">E-mail</label>
            <input id="email" name="email" value="{{ old('email') }}" type="email" class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="Enter your account E-mail" autofocus required/>
            @if($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors::first('email') }}
            </div>
            @endif
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-block btn-primary">Reset password</button>
        </div>
    </form> 
</div>
<div class="card-footer px-md-5">
    <small>Back to</small>
    <a href="{{ route('signin') }}" class="small font-weight-bold">Sign in</a>
    <small>page</small>
</div>
@endsection