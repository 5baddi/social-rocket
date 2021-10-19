@php
    use BADDIServices\SocialRocket\Common\FeatureList;
@endphp

@if ($featureService->isFeatureEnabled(FeatureList::HCAPTCHA))
    <div class="h-captcha mt-4 text-center" data-sitekey="{{ config('baddi.hcaptcha.site_key') }}"></div>
    @if($errors->has('h-captcha-response'))
        <div class="invalid-feedback d-block mb-2">
            {{ $errors->first('h-captcha-response') }}
        </div>
    @endif
@endif
