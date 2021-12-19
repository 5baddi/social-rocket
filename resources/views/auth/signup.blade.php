@extends('layouts.auth')

@section('title') Create new account @endsection

@section('form')
    <div class="card-body px-md-5 py-5">
        <div class="mb-5">
            <h6 class="h3">Welcome to {{ config('app.name') }}</h6>
            <p class="text-muted mb-0">Let's get started by creating your account</p>
            @if(Session::has('error'))
                <div class="invalid-feedback">
                    {{ Session::get('error') }}
                </div>
            @endif
        </div>
        <span class="clearfix"></span>
        <form action="{{ route('auth.signup', ['store' => $store->id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-control-label">First name</label>
                <div class="input-group">
                    <input type="text" name="first_name" class="form-control @if($errors->has('first_name')) is-invalid @endif" placeholder="First name" autofocus required/>
                    @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors::first('first_name') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="form-control-label">Last name</label>
                <div class="input-group">
                    <input type="text" name="last_name" class="form-control @if($errors->has('last_name')) is-invalid @endif" placeholder="Last name" required/>
                    @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors::first('last_name') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="form-control-label">Phone number</label>
                <div class="input-group">
                    <input type="text" name="phone" class="form-control @if($errors->has('phone')) is-invalid @endif" placeholder="Phone number" required/>
                    @if($errors->has('phone'))
                    <div class="invalid-feedback">
                        {{ $errors::first('phone') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label class="form-control-label">E-mail address</label>
                <div class="input-group">
                    <input type="email" name="email" class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="name@example.com" required/>
                    @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors::first('email') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-group">
                    <label class="form-control-label">Create password</label>
                <div class="input-group">
                    <input type="password" name="password" class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="password" required/>
                    @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors::first('password') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-block btn-primary">Continue signup</button>
            </div>
        </form>
    </div>
    <div class="card-footer px-md-5">
        <small>Already have an account?</small>
        <a href="{{ route('signin') }}" class="small font-weight-bold">Login</a>
    </div>
@endsection