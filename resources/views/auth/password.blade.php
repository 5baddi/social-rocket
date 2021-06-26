@extends('layouts.auth')

@section('title') New password @endsection

@section('form')
<div class="card-body px-md-5 py-5">
    <div class="mb-5">
        <h6 class="h3">Set new password</h6>
        <p class="text-muted mb-0">Enter a new password</p>
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
    <form method="POST" action="{{ route('auth.reset.password') }}">
        @csrf
        <div class="form-group">
            <label for="password" class="form-control-label">New password</label>
            <input id="password" name="password" type="password" class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="Enter new password" autofocus required/>
            @if($errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors::first('password') }}
            </div>
            @endif
        </div>
        <div class="form-group">
            <label for="confirm_password" class="form-control-label">Confirm new password</label>
            <input id="confirm_password" name="confirm_password" type="password" class="form-control @if($errors->has('confirm_password')) is-invalid @endif" placeholder="Confirm new password" autofocus required/>
            @if($errors->has('confirm_password'))
            <div class="invalid-feedback">
                {{ $errors::first('confirm_password') }}
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