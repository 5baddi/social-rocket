@extends('layouts.dashboard')

@section('title')
    {{ ucfirst($title) }}
@endsection

@section('content')
<form action="{{ route('dashboard.customize.save') }}" method="POST">
    @csrf
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Commission Settings</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <p class="text-muted">Set your affiliates commission. Your affiliate will earn this for every customer that purchases something from your store using their custom discount code</p>
                        <div class="col-4">
                            <label class="form-label">Type</label>
                            <select name="commission_type" class="form-select @if ($errors->has('commission_type')) is-invalid @endif" placeholder="Select a type" id="select-commission-type">
                                @foreach (\BADDIServices\SocialRocket\Models\Setting::COMMISSION_TYPES as $type)
                                <option @if (old('commission_type') == $type || (is_null(old('commission_type')) && \BADDIServices\SocialRocket\Models\Setting::FIXED_TYPE == $type)) selected @endif  value="{{ strtolower($type) }}">{{ ucwords($type) }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('commission_type'))
                            <div class="invalid-feedback">{{ $errors::first('commission_type') }}</div>
                            @endif
                        </div>
                        <div class="col-4">
                            <label class="form-label">Amount</label>
                            <div class="input-group input-group-flat">
                                <input name="commission_amount" type="text" class="form-control text-start pe-0 @if ($errors->has('commission_amount')) is-invalid @endif" value="{{ old('commission_amount') ?? \BADDIServices\SocialRocket\Models\Setting::DFEAULT_COMMISSION }}" autocomplete="off">
                                <span class="input-group-text" id="commission-amount">$</span>
                            </div>
                            @if ($errors->has('commission_amount'))
                            <div class="invalid-feedback">{{ $errors::first('commission_amount') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Discount Code Settings</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <p class="text-muted">Customize the discount codes that will be shared by your affiliates</p>
                        <div class="col-4">
                            <label class="form-label">Type</label>
                            <select name="discount_type" class="form-select @if ($errors->has('discount_type')) is-invalid @endif" placeholder="Select a type" id="select-discount-type">
                                @foreach (\BADDIServices\SocialRocket\Models\Setting::DISCOUNT_TYPES as $type)
                                <option @if (old('discount_type') == $type || (is_null(old('discount_type')) && \BADDIServices\SocialRocket\Models\Setting::FIXED_TYPE == $type)) selected @endif value="{{ strtolower($type) }}">{{ ucwords($type) }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('discount_type'))
                            <div class="invalid-feedback">{{ $errors::first('discount_type') }}</div>
                            @endif
                        </div>
                        <div class="col-4">
                            <label class="form-label">Amount</label>
                            <div class="input-group input-group-flat">
                                <input name="discount_amount" type="text" class="form-control text-start pe-0 @if ($errors->has('discount_amount')) is-invalid @endif" value="{{ old('discount_amount') ?? \BADDIServices\SocialRocket\Models\Setting::DFEAULT_DISCOUNT }}" autocomplete="off">
                                <span class="input-group-text" id="discount-amount">$</span>
                            </div>
                            @if ($errors->has('discount_amount'))
                            <div class="invalid-feedback">{{ $errors::first('discount_amount') }}</div>
                            @endif
                        </div>
                        <div class="col-4">
                            <label class="form-label">Format</label>
                            <select name="discount_format" class="form-select @if ($errors->has('discount_format')) is-invalid @endif" placeholder="Select a type" id="select-discount-format">
                                @foreach (\BADDIServices\SocialRocket\Models\Setting::DISCOUNT_FORMATS as $key => $format)
                                <option @if (old('discount_format') == $key || (is_null(old('discount_format')) && \BADDIServices\SocialRocket\Models\Setting::UNIQUE_DISCOUNT_FORMAT == $key)) selected @endif value="{{ strtolower($key) }}">{{ ucwords($format) }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('discount_format'))
                            <div class="invalid-feedback">{{ $errors::first('discount_format') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Thank You Page Settings</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <p class="text-muted">Customize the appearance of the thank you page feature. Please note: The fonts used here will be consistent with the fonts selected in your Shopify theme editor</p>
                        <div class="col-4">
                            <label class="form-label">Heading color</label>
                            <input type="color" id="color" class="form-control form-control-color mb-2 @if ($errors->has('color')) is-invalid @endif" value="{{ old('color') ?? \BADDIServices\SocialRocket\Models\Setting::DEFAULT_COLOR }}" title="Choose your color">
                            @if ($errors->has('color'))
                            <div class="invalid-feedback">{{ $errors::first('color') }}</div>
                            @endif
                            <a href="{{ route('dashboard.preview.checkout') }}" target="_blank">
                                Preview&nbsp;
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-forward-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M15 13l4 -4l-4 -4m4 4h-11a4 4 0 0 0 0 8h1"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 text-end">
            <div class="d-flex">
            {{-- Need Help?&nbsp;<a href="{{ route('dashboard.help') }}">check our guide</a> --}}
            <button type="submit" class="btn btn-ghost-dark ms-auto">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                    <circle cx="12" cy="14" r="2"></circle>
                    <polyline points="14 4 14 8 8 8 8 4"></polyline>
                </svg>
                &nbsp;Save
            </button>
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts')
    @include('partials.dashboard.scripts.form')
@endsection

@section('script')
    document.addEventListener("DOMContentLoaded", function () {
        localStorage.setItem('checkout-color', '{{ old('color') ?? \BADDIServices\SocialRocket\Models\Setting::DEFAULT_COLOR }}');

        var el = document.getElementById('select-commission-type');
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
        
        var disEl = document.getElementById('select-discount-type');
        window.Choices && (new Choices(disEl, {
            classNames: {
                containerInner: disEl.className,
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
        
        var disFormatEl = document.getElementById('select-discount-format');
        window.Choices && (new Choices(disFormatEl, {
            classNames: {
                containerInner: disFormatEl.className,
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

        var amountEl = $('#commission-amount');
        var dicountEl = $('#discount-amount');
        $(document).ready(function() {
            var selected = $('#select-commission-type').children("option:selected").val();
            if (selected == '{{ \BADDIServices\SocialRocket\Models\Setting::FIXED_TYPE }}') {
                amountEl.text('$');
            } else {
                amountEl.text('%');
            }

            $('#select-commission-type').change(function () {
                var selected = $(this).children("option:selected").val();
                if (selected == '{{ \BADDIServices\SocialRocket\Models\Setting::FIXED_TYPE }}') {
                    amountEl.text('$');
                } else {
                    amountEl.text('%');
                }
            });
            
            var selected = $('#select-discount-type').children("option:selected").val();
            if (selected == '{{ \BADDIServices\SocialRocket\Models\Setting::FIXED_TYPE }}') {
                dicountEl.text('$');
            } else {
                dicountEl.text('%');
            }

            $('#select-discount-type').change(function () {
                var selected = $(this).children("option:selected").val();
                if (selected == '{{ \BADDIServices\SocialRocket\Models\Setting::FIXED_TYPE }}') {
                    dicountEl.text('$');
                } else {
                    dicountEl.text('%');
                }
            });
            
            $('#color').change(function () {
                var value = $(this).val();
                localStorage.setItem('checkout-color', value);
            });
        });
    });
@endsection