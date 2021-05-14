@extends('layouts.auth')

@section('title') Payment details @endsection

@section('form')
    <h1 class="title1">Payment details</h1>
    <p>{{ ucwords($pack->name) }} plan only <strong>{{ $pack->isFixedPrice() ? $pack->currency_symbol : '' }}{{ $pack->price }}{{ !$pack->isFixedPrice() ? '%' : '' }}</strong> {{ $pack->isFixedPrice() ? 'per month' : 'of revenue share' }}</p>
    <form method="POST" action="{{ route('dashboard.pay.subscription', ['pack' => $pack->id]) }}">
        @csrf
        <div class="box-form-design1">
            <div class="form-group-custom1">
                <label for="card-number" class="label-custom1">Card number</label>
                <input id="card-number" name="card_number" value="{{ old('card_number') }}" type="text" class="input-custom1 @if($errors->has('card_number')) is-invalid @endif" placeholder="Card number" autofocus required/>
                @if($errors->has('card_number'))
                <div class="invalid-feedback">
                    {{ $errors::first('card_number') }}
                </div>
                @endif
            </div>
            <div class="form-group-custom1">
                <div class="row no-padding">
                    <div class="col-8">
                        <label for="expiry-date" class="label-custom1">Exiry date</label>
                        <div class="row no-padding">
                            <div class="col-6">
                                <input id="expiry-date" name="month" value="{{ old('month') }}" type="text" class="input-custom1 @if($errors->has('month')) is-invalid @endif" placeholder="MM" required/>
                                @if($errors->has('month'))
                                <div class="invalid-feedback">
                                    {{ $errors::first('month') }}
                                </div>
                                @endif
                            </div>
                            <div class="col-6">
                                <input name="year" value="{{ old('year') }}" type="text" class="input-custom1 @if($errors->has('year')) is-invalid @endif" placeholder="YY" required/>
                                @if($errors->has('year'))
                                <div class="invalid-feedback">
                                    {{ $errors::first('year') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <label for="cvc" class="label-custom1">CVC</label>
                            <input id="cvc" name="cvc" value="{{ old('cvc') }}" type="text" class="input-custom1 @if($errors->has('cvc')) is-invalid @endif" placeholder="cvc" required/>
                            @if($errors->has('cvc'))
                            <div class="invalid-feedback">
                                {{ $errors::first('cvc') }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-btn-submit">
                <button class="btn-design1" type="submit">Pay</button>
            </div>
            <p class="have-account">
                <a href="{{ route('dashboard.select.pack') }}" class="link-design1">Choose another plan</a>
            </p>
        </div>
    </form>
@endsection