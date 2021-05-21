@extends('layouts.mail')

@section('content')
  <tr>
    <td class="sm-px-24" style="--bg-opacity: 1; background-color: #ffffff; background-color: rgba(255, 255, 255, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 14px; line-height: 24px; padding: 48px; text-align: left; --text-opacity: 1; color: #626262; color: rgba(98, 98, 98, var(--text-opacity));" bgcolor="rgba(255, 255, 255, var(--bg-opacity))" align="left">
      <p style="font-weight: 600; margin-bottom: 0;">Hi! {{ ucwords($subscription->user->first_name) }} 👋</p>
      <p class="sm-leading-32" style="font-weight: 600; font-size: 20px; margin: 0 0 16px; --text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
        We sorry for lost you! 
      </p>
      <p style="margin: 0 0 24px;">
        {{ ucwords($subscription->pack->name) }} plan has been cancelled.
      </p>
      {{-- <a href="{{ route('signin') }}" style="display: block; font-size: 14px; line-height: 100%; margin-bottom: 24px; --text-opacity: 1; color: #7367f0; color: rgba(115, 103, 240, var(--text-opacity)); text-decoration: none;">{{ route('signin') }}</a> --}}
      <table style="font-family: 'Montserrat',Arial,sans-serif;" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
          <td style="mso-padding-alt: 16px 24px; --bg-opacity: 1; background-color: #7367f0; background-color: rgba(115, 103, 240, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif;" bgcolor="rgba(115, 103, 240, var(--bg-opacity))">
            <a href="{{ route('subscription.select.pack') }}" style="display: block; font-weight: 600; font-size: 14px; line-height: 100%; padding: 16px 24px; --text-opacity: 1; color: #ffffff; color: rgba(255, 255, 255, var(--text-opacity)); text-decoration: none;">Choose a plan &rarr;</a>
          </td>
        </tr>
      </table>
      <table style="font-family: 'Montserrat',Arial,sans-serif; width: 100%;" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
          <td style="font-family: 'Montserrat',Arial,sans-serif; padding-top: 32px; padding-bottom: 32px;">
            <div style="--bg-opacity: 1; background-color: #eceff1; background-color: rgba(236, 239, 241, var(--bg-opacity)); height: 1px; line-height: 1px;">&zwnj;</div>
          </td>
        </tr>
      </table>
      <p style="margin: 0 0 16px;">Best, <br><a href="{{ url('/') }}" target="_blank">{{ config('app.name') }}</a></p>
    </td>
  </tr>
  <tr>
    <td style="font-family: 'Montserrat',Arial,sans-serif; height: 20px;" height="20"></td>
  </tr>
  {{-- <tr>
    <td style="font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 12px; padding-left: 48px; padding-right: 48px; --text-opacity: 1; color: #eceff1; color: rgba(236, 239, 241, var(--text-opacity));">
      <p style="--text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
        {{ __('messages.privacy_message') }}
        <a href="#" class="hover-underline" style="--text-opacity: 1; color: #7367f0; color: rgba(115, 103, 240, var(--text-opacity)); text-decoration: none;">{{ __('messages.terms') }}</a> {{ __('messages.and') }}
        <a href="#" class="hover-underline" style="--text-opacity: 1; color: #7367f0; color: rgba(115, 103, 240, var(--text-opacity)); text-decoration: none;">{{ __('messages.privacy') }}</a>.
      </p>
    </td>
  </tr> --}}
  <tr>
    <td style="font-family: 'Montserrat',Arial,sans-serif; height: 16px;" height="16"></td>
  </tr>
@endsection