@extends('layouts.auth')

@section('title') Connect store @endsection

@section('form')
    <img src="{{ asset('img/connect-app.png') }}" class="img-box-right-login"/>
    <h1 class="title1">Connect your store</h1>
    <p>Please enter your Shopify store URL and we’ll redirect you to Shopify to finish connecting your store to {{ config('app.name') }} App.</p>
    <form method="POST" action="{{ localeRoute('oauth.connect') }}">
        @csrf
        <div class="box-form-design1">
            <div class="form-group-custom1">
                <label for="store" class="label-custom1">Shopify store name or URL</label>
                <input id="store" name="store" value="{{ old('store') }}" type="text" class="input-custom1 @if($errors->has('store')) is-invalid @endif" placeholder="example.myshopify.com" autofocus="autofocus" required/>
                @if($errors->has('store'))
                <div class="invalid-feedback">
                    {{ $errors::first('store') }}
                </div>
                @endif
                @if(Session::has('error'))
                <div class="invalid-feedback">
                    {{ Session::get('error') }}
                </div>
                @endif
            </div>
            <div class="box-btn-submit">
                <button class="btn-design1" type="submit">Connect</button>
            </div>
        </div>
    </form>    
@endsection