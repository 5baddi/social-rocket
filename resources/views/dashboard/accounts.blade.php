@extends('layouts.dashboard')

@section('title')
    {{ ucfirst($title) }}
@endsection

@php
    $tab = isset($tab) ? $tab : 'settings';
@endphp

@section('content')
<div class="row row-cards">
    <div class="col">
        <div class="card">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a href="{{ route('dashboard.account', ['tab' => 'settings']) }}" class="nav-link {{ $tab === 'settings' ? 'active' : '' }}">Account Info</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('dashboard.account', ['tab' => 'plan']) }}" class="nav-link {{ $tab === 'plan' ? 'active' : '' }}">Your plan</a>
              </li>
            </ul>
        </div>
    </div>

    <form action="{{ route('dashboard.account.save', ['tab' => $tab]) }}" method="POST">
        @csrf
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        @if ($tab === 'settings')
                        General Info
                        @else
                        Your current plan
                        @endif
                    </h4>
                </div>
                <div class="card-body">
                    @if ($tab === 'settings')
                    <div class="row">
                        <p class="text-muted">Setup your account, edit profile details, and change password</p>
                        <div class="col-4">
                            <label class="form-label">First name</label>
                            <input type="text" name="first_name" class="form-control @if ($errors->has('first_name')) is-invalid @endif" value="{{ old('first_name') ?? ucfirst($user->first_name)  }}" placeholder="Your first name" autofocus/>
                            @if ($errors->has('first_name'))
                            <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
                            @endif
                        </div>
                        <div class="col-4">
                            <label class="form-label">First name</label>
                            <input type="text" name="last_name" class="form-control @if ($errors->has('last_name')) is-invalid @endif" value="{{ old('last_name') ?? ucfirst($user->last_name) }}" placeholder="Your last name"/>
                            @if ($errors->has('last_name'))
                            <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
                            @endif
                        </div>
                        <div class="col-4">
                            <label class="form-label">Brand name</label>
                            <input type="text" name="brand_name" class="form-control @if ($errors->has('brand_name')) is-invalid @endif" value="{{ old('brand_name') ?? $setting->brand_name }}" placeholder="Brand name"/>
                            @if ($errors->has('brand_name'))
                            <div class="invalid-feedback">{{ $errors->first('brand_name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-4">
                            <label class="form-label">E-mail</label>
                            <input type="email" name="email" class="form-control @if ($errors->has('email')) is-invalid @endif" value="{{ old('email') ?? $user->email }}" placeholder="E-mail"/>
                            @if ($errors->has('email'))
                            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                            @endif
                        </div>
                        <div class="col-4">
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control @if ($errors->has('phone')) is-invalid @endif" value="{{ old('phone') ?? $user->phone }}" placeholder="Your phone number"/>
                            @if ($errors->has('phone'))
                            <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                            @endif
                        </div>
                        <div class="col-4">
                            <label class="form-label">Currency</label>
                            <select name="currency" class="form-select @if ($errors->has('currency')) is-invalid @endif" placeholder="Select a currency" id="select-currency">
                                @foreach ($currencies as $key => $format)
                                <option @if (old('currency') == $key || (is_null(old('currency')) && $setting->currency == $key) || (is_null(old('currency')) && is_null($setting->currency) && \BADDIServices\SocialRocket\Models\Setting::DEFAULT_CURRENCY == $key)) selected @endif value="{{ $key }}">{{ ucwords($format) }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('currency'))
                            <div class="invalid-feedback">{{ $errors->first('currency') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-4">
                            <label class="form-label">Current password</label>
                            <input type="password" name="current_password" class="form-control @if ($errors->has('current_password')) is-invalid @endif" placeholder="Current password"/>
                            @if ($errors->has('current_password'))
                            <div class="invalid-feedback">{{ $errors->first('current_password') }}</div>
                            @endif
                        </div>
                        <div class="col-4">
                            <label class="form-label">New password</label>
                            <input type="password" name="password" class="form-control @if ($errors->has('password')) is-invalid @endif" placeholder="New password"/>
                            @if ($errors->has('password'))
                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                            @endif
                        </div>
                        <div class="col-4">
                            <label class="form-label">Confirm new password</label>
                            <input type="password" name="confirm_password" class="form-control @if ($errors->has('confirm_password')) is-invalid @endif" placeholder="Confirm new password"/>
                            @if ($errors->has('confirm_password'))
                            <div class="invalid-feedback">{{ $errors->first('confirm_password') }}</div>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="card bg-azure-lt">
                            <div class="card-body">
                              <div class="row">
                                <div class="col-auto">
                                  <span class="avatar rounded">
                                      <img src="{{ asset('img/mini-logo.png') }}"/>
                                  </span>
                                </div>
                                <div class="col">
                                  <div class="font-weight-medium">{{ ucwords($currentPack->name) }}</div>
                                  <div class="text-muted">{{ $currentPack->isFixedPrice() ? $currentPack->symbol : '' }}{{ $currentPack->price }}{{ !$currentPack->isFixedPrice() ? '% of revenue share' : ' per month' }}</div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-12 text-end">
                    <div class="d-flex justify-content-end">
                        @if ($tab === 'plan')
                        <a href="{{ route('dashboard.plan.cancel') }}" class="btn btn-ghost-danger">Cancel subscription</a>
                        <a href="{{ route('dashboard.plan.upgrade') }}" class="btn btn-ghost-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-rotate-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M15 4.55a8 8 0 0 0 -6 14.9m0 -4.45v5h-5"></path>
                                <line x1="18.37" y1="7.16" x2="18.37" y2="7.17"></line>
                                <line x1="13" y1="19.94" x2="13" y2="19.95"></line>
                                <line x1="16.84" y1="18.37" x2="16.84" y2="18.38"></line>
                                <line x1="19.37" y1="15.1" x2="19.37" y2="15.11"></line>
                                <line x1="19.94" y1="11" x2="19.94" y2="11.01"></line>
                            </svg>
                            &nbsp;Upgrade plan
                        </a>
                        @else
                        <button type="submit" class="btn btn-ghost-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                                <circle cx="12" cy="14" r="2"></circle>
                                <polyline points="14 4 14 8 8 8 8 4"></polyline>
                            </svg>
                            &nbsp;Save
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
    @include('partials.dashboard.scripts.form')
@endsection

@section('script')
    document.addEventListener("DOMContentLoaded", function () {
        var el = document.getElementById('select-currency');
        window.Choices && (new Choices(el, {
            classNames: {
                containerInner: el.className,
                input: 'form-control',
                inputCloned: 'form-control-sm',
                listDropdown: 'dropdown-menu',
                itemChoice: 'dropdown-item',
                activeState: 'show',
                selectedState: 'active',
            },
            shouldSort: false,
            searchEnabled: false,
        }));
    });
@endsection