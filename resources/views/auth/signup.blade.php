@extends('layouts.auth')
@section('form')
    <h1 class="title1 uppercase">Welcome to</br>{{ config('app.name') }}</h1>
    <p>Lets get started by creating your account</p>
    <form method="POST" action="{{ route('auth.signup') }}">
        @csrf
        <div class="box-form-design1">
            <div class="form-group-custom1">
                <label for="first-name" class="label-custom1">First name</label>
                <input id="first-name" name="first_name" type="text" class="input-custom1" placeholder="First name" autofocus="autofocus" required/>
            </div>
            <div class="form-group-custom1">
                <label for="last-name" class="label-custom1">Last name</label>
                <input id="last-name" name="last_name" type="text" class="input-custom1" placeholder="Last name" required/>
            </div>
            <div class="form-group-custom1">
                <label for="phone" class="label-custom1">Phone number</label>
                <input id="phone" name="phone" type="text" class="input-custom1" placeholder="Phone number" required/>
            </div>
            <div class="form-group-custom1">
                <label for="email" class="label-custom1">E-mail</label>
                <input id="email" name="email" type="email" class="input-custom1" placeholder="E-mail" required/>
            </div>
            <div class="form-group-custom1">
                <label for="password" class="label-custom1">Create password</label>
                <input id="password" name="password" type="password" class="input-custom1" placeholder="Password" required/>
            </div>
            <div class="box-btn-submit">
                <button class="btn-design1" type="submit">Continue signup</button>
            </div>
        </div>
    </form> 
@endsection