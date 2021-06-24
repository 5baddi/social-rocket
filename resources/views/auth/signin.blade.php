@extends('layouts.auth')

@section('title') Sign in @endsection

@section('form')
    <div class="card-body px-md-5 py-5">
        <div class="mb-5">
            <h6 class="h3">Welcome back</h6>
            <p class="text-muted mb-0">Sign in to your account to continue</p>
            @if(Session::has('error'))
                <div class="invalid-feedback">
                    {{ Session::get('error') }}
                </div>
            @endif
        </div>
        <span class="clearfix"></span>
        <form action="{{ route('auth.signin') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-control-label">E-mail address</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                            </svg>
                        </span>
                    </div>
                    <input name="email" value="{{ old('email') }}" type="email" class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="name@example.com" autofocus required/>
                    @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors::first('email') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="form-group mb-0">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <label class="form-control-label">Password</label>
                    </div>
                    <div class="mb-2">
                        <a href="{{ route('reset') }}" class="small text-muted text-underline--dashed border-primary">Reset password</a>
                    </div>
                </div>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="8" cy="15" r="4"></circle>
                                <line x1="10.85" y1="12.15" x2="19" y2="4"></line>
                                <line x1="18" y1="5" x2="20" y2="7"></line>
                                <line x1="15" y1="8" x2="17" y2="10"></line>
                            </svg>
                        </span>
                    </div>
                    <input type="password" name="password" class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="password" required/>
                    @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors::first('password') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-block btn-primary">Sign in</button>
            </div>
        </form>
    </div>
    <div class="card-footer px-md-5">
        <small>Not registered yet?</small>
        <a href="{{ route('connect') }}" class="small font-weight-bold">Create account</a>
    </div>
@endsection