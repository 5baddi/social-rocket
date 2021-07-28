@extends('layouts.auth')

@section('title') Connect your store @endsection

@section('form')
    <div class="card-body px-md-5 py-5">
        <div class="mb-2 text-center">
            <img src="{{ asset('assets/img/shopify.svg') }}" style="max-width: 200px;"/>
        </div>
        <div class="mb-5 mt-4">
            <h6 class="h3">Connect your store</h6>
            <p class="text-muted mb-0">Please enter your Shopify store URL and we’ll redirect you to Shopify to finish connecting your store to {{ config('app.name') }} App</p>
            @if(Session::has('error'))
                <div class="invalid-feedback">
                    {{ Session::get('error') }}
                </div>
            @endif
        </div>
        <span class="clearfix"></span>
        <form action="{{ route('oauth.connect') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-control-label">Shopify store name or URL</label>
                <div class="input-group">
                    <input name="store" value="{{ old('store') }}" type="text" class="form-control @if($errors->has('store')) is-invalid @endif" placeholder="example.myshopify.com" autofocus required/>
                    @if($errors->has('store'))
                    <div class="invalid-feedback">
                        {{ $errors::first('store') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="h-captcha mt-4 text-center" data-sitekey="{{ config('baddi.hcaptcha_site_key') }}"></div>
            @if($errors->has('h-captcha-response'))
            <div class="invalid-feedback d-block mb-2">
                {{ $errors->first('h-captcha-response') }}
            </div>
            @endif
            <div class="mt-4">
                <button type="submit" class="btn btn-block btn-primary">Connect</button>
            </div>
        </form>
    </div>
    <div class="card-footer px-md-5">
        <small>Already have an account?</small>
        <a href="{{ route('signin') }}" class="small font-weight-bold">Login</a>
    </div>
@endsection