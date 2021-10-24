@extends('layouts.auth')

@section('title') Connect your shop @endsection

@section('form')
{{--    <div class="card-header px-md-5">--}}
{{--        <div class="text-center">--}}
{{--            <img src="{{ asset('assets/img/shopify.svg') }}" style="max-width: 200px;"/>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="card-body px-md-5 py-5">
        <div class="mb-4">
            <h6 class="h3 text-center">@lang('landing.connect_shop.title')</h6>
            <p class="mt-4 text-muted mb-0">@lang('landing.connect_shop.label', ['name' => config('app.name')])</p>
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
{{--                <label class="form-control-label">Shopify shop name or URL</label>--}}
                <div class="input-group">
                    <input name="shop" value="{{ old('shop') }}" type="text" class="form-control @if($errors->has('shop')) is-invalid @endif" placeholder="example.myshopify.com" autofocus required/>
                    @if($errors->has('shop'))
                    <div class="invalid-feedback">
                        {{ $errors::first('shop') }}
                    </div>
                    @endif
                </div>
            </div>
            @include('partials.hcaptcha')
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
