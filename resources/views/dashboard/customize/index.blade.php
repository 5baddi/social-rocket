@extends('layouts.dashboard')

@section('title')
    {{ ucfirst($title) }}
@endsection

@section('content')
<form action="{{ route('dashboard.customize.integrations') }}" method="POST">
    @csrf
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Commission Settings</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <p class="text-muted">Set your affiliates commission. Your affiliate will earn this for every customer that purchases something from your store using their custom discount code.</p>
                        <div class="col-4">
                            <label class="form-label">Type</label>
                            <select name="commission_type" class="form-select" placeholder="Select a type" id="select-commission-type">
                                @foreach (\BADDIServices\SocialRocket\Models\Setting::COMMISSION_TYPES as $type)
                                <option value="{{ strtolower($type) }}">{{ ucwords($type) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label class="form-label">Amount</label>
                            <div class="input-group input-group-flat">
                                <input type="text" class="form-control text-start pe-0" value="{{ \BADDIServices\SocialRocket\Models\Setting::DFEAULT_COMMISSION }}" autocomplete="off">
                                <span class="input-group-text" id="commission-amount">$</span>
                            </div>
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
                        <p class="text-muted">Customize the discount codes that will be shared by your affiliates.</p>
                        <div class="col-4">
                            <label class="form-label">Type</label>
                            <select name="discount_type" class="form-select" placeholder="Select a type" id="select-discount-type">
                                @foreach (\BADDIServices\SocialRocket\Models\Setting::DISCOUNT_TYPES as $type)
                                <option value="{{ strtolower($type) }}">{{ ucwords($type) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label class="form-label">Amount</label>
                            <div class="input-group input-group-flat">
                                <input type="text" class="form-control text-start pe-0" value="{{ \BADDIServices\SocialRocket\Models\Setting::DFEAULT_DISCOUNT }}" autocomplete="off">
                                <span class="input-group-text" id="discount-amount">$</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <label class="form-label">Format</label>
                            <select name="discount_type" class="form-select" placeholder="Select a type" id="select-discount-format">
                                @foreach (\BADDIServices\SocialRocket\Models\Setting::DISCOUNT_FORMATS as $key => $format)
                                <option value="{{ strtolower($key) }}">{{ ucwords($format) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 text-end">
            <div class="d-flex">
            <a href="{{ route('dashboard.help') }}" class="btn btn-link">Need Help?</a>
            <button type="submit" class="btn btn-dark ms-auto">Save</button>
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
        });
    });
@endsection