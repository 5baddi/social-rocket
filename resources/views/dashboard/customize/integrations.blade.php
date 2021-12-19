@extends('layouts.dashboard')

@section('title')
    {{ ucfirst($title) }}
@endsection

@section('content')
<div class="row row-cards">
    <form action="{{ route('dashboard.customize.integrations.save') }}" method="POST">
        @csrf

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="d-flex align-items-center">
                            <label class="form-check form-check-single form-switch" style="padding-left: 0 !important; padding-right: 1rem">
                                <input name="affiliate_form" id="affiliate-form-check" class="form-check-input" value="1" type="checkbox" @if (old('affiliate_form') ?? $setting->affiliate_form)checked @endif/>
                            </label>
                            <label class="card-title">Afilliate Form</label>
                        </div>
                        <p class="text-muted mt-2 mb-0">Embed a custom form on your website to attract new affiliates</p>
                    </div>
                </div>
                <div class="card-body" id="affiliate-form" style="display: none;">
                    <div class="row">
                        <a href="{{ route('guide.affiliate.setup') }}" target="_blank">How to add your sign up form to Shopify</a>
                        <div class="col mt-2">
                            <label class="form-label">Copy this code and paste on a page</label>
                            <div class="input-group input-group-flat">
                                <textarea id="iframe" rows="1" class="form-control text-start" style="resize: none;" readonly><iframe src="{{ route('affiliate', ['store' => $store]) }}" frameborder="0" width="100%" height="550px" scrolling="no"></iframe></textarea>
                                <span class="input-group-text">
                                    <a id="copy-iframe" href="#" class="input-group-link" style="padding-left:.5rem;" title="copy">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <rect x="8" y="8" width="12" height="12" rx="2"></rect>
                                            <path d="M16 8v-2a2 2 0 0 0 -2 -2h-8a2 2 0 0 0 -2 2v8a2 2 0 0 0 2 2h2"></path>
                                        </svg>
                                    </a>
                                </span>
                            </div>
                            <div class="valid-feedback" id="valid-copy">Your iframe has been copied successfully</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col mt-5">
            <h2 class="page-title">Advanced Settings</h2>
        </div> --}}
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <label class="form-check form-check-single form-switch" style="padding-left: 0 !important; padding-right: 1rem">
                            <input name="thankyou_page" class="form-check-input" value="1" type="checkbox" @if (old('thankyou_page') ?? $setting->thankyou_page)checked @endif/>
                        </label>
                        <label class="card-title" style="margin: 0;">Thank You Page</label>
                    </div>
                    <p class="text-muted mt-2 mb-0">Turning this off will disable the thank you page feature (Recommended to keep ON)</p>
                </div>
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="d-flex align-items-start">
                            <label class="card-title">Post Purchase Email Settings</label>
                        </div>
                        <p class="text-muted mt-2 mb-0">Select which emails you would like sent to your customers after they make a purchase on your store. All emails will be sent from your store name</p>
                    </div>
                </div>
                <div class="card-body" id="affiliate-form">
                    <div class="row">
                        <div class="col-12">
                            <label class="form-check form-switch">
                                <input name="purchase_mail" class="form-check-input" type="checkbox" value="1" @if (old('purchase_mail') ?? $setting->purchase_mail)checked @endif/>
                                <span class="form-label">
                                    Post Purchase Email (instant)
                                </span>
                                <a href="{{ route('dashboard.customize.integrations.mails.purchase') }}" target="_blank">
                                    Preview&nbsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-forward-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M15 13l4 -4l-4 -4m4 4h-11a4 4 0 0 0 0 8h1"></path>
                                    </svg>
                                </a>
                            </label>
                        </div>
                        <div class="col-12">
                            <label class="form-check form-switch">
                                <input name="purchase_mail_24h" class="form-check-input" type="checkbox" value="1" @if (old('purchase_mail_24h') ?? $setting->purchase_mail_24h)checked @endif/>
                                <span class="form-label">
                                    Email 1 (24 hours post purchase)
                                </span>
                                <a href="{{ route('dashboard.customize.integrations.mails.purchase', ['template' => '24h']) }}" target="_blank">
                                    Preview&nbsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-forward-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M15 13l4 -4l-4 -4m4 4h-11a4 4 0 0 0 0 8h1"></path>
                                    </svg>
                                </a>
                            </label>
                        </div>
                        <div class="col-12">
                            <label class="form-check form-switch">
                                <input name="purchase_mail_48h" class="form-check-input" type="checkbox" value="1" @if (old('purchase_mail_48h') ?? $setting->purchase_mail_48h)checked @endif/>
                                <span class="form-label">
                                    Email 2 (48 hours post purchase)
                                </span>
                                <a href="{{ route('dashboard.customize.integrations.mails.purchase', ['template' => '48h']) }}" target="_blank">
                                    Preview&nbsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-forward-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M15 13l4 -4l-4 -4m4 4h-11a4 4 0 0 0 0 8h1"></path>
                                    </svg>
                                </a>
                            </label>
                        </div>
                        <div class="col-12">
                            <label class="form-check form-switch">
                                <input name="purchase_mail_120h" class="form-check-input" type="checkbox" value="1" @if (old('purchase_mail_120h') ?? $setting->purchase_mail_120h)checked @endif/>
                                <span class="form-label">
                                    Email 3 (120 hours post purchase)
                                </span>
                                <a href="{{ route('dashboard.customize.integrations.mails.purchase', ['template' => '120h']) }}" target="_blank">
                                    Preview&nbsp;
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-forward-up" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M15 13l4 -4l-4 -4m4 4h-11a4 4 0 0 0 0 8h1"></path>
                                    </svg>
                                </a>
                            </label>
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
</div>
@endsection

@section('scripts')
    @include('partials.dashboard.scripts.form')
@endsection

@section('script')
    document.addEventListener("DOMContentLoaded", function() {
        var el = document.getElementById('iframe');
        var actionBtn = document.getElementById('copy-iframe');
        var copyMsg = document.getElementById('valid-copy');
        var affiliateFormEl = document.getElementById('affiliate-form-check');
        var affiliateForm = document.getElementById('affiliate-form');

        if (affiliateFormEl.checked) {
            affiliateForm.style.display = "block";
        } else {
            affiliateForm.style.display = "none";
        }

        affiliateFormEl.addEventListener("change", function() {
            if (affiliateFormEl.checked) {
                affiliateForm.style.display = "block";
            } else {
                affiliateForm.style.display = "none";
            }
        });

        actionBtn.addEventListener("click", function() {
            iframe.select();
            iframe.setSelectionRange(0, 99999);

            document.execCommand("copy");

            copyMsg.style.display = "block";
            window.setTimeout(function() {
                copyMsg.style.display = "none";
                document.getSelection().removeAllRanges();
            }, 5000);
        });
    });
@endsection