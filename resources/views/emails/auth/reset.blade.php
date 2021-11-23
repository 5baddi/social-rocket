@extends('layouts.mail')

@section('content')
  <tr>
    <td class="sm-px-24" style="--bg-opacity: 1; background-color: #ffffff; background-color: rgba(255, 255, 255, var(--bg-opacity)); border-radius: 4px; font-family: Montserrat, -apple-system, 'Segoe UI', sans-serif; font-size: 14px; line-height: 24px; padding: 48px; text-align: left; --text-opacity: 1; color: #626262; color: rgba(98, 98, 98, var(--text-opacity));" bgcolor="rgba(255, 255, 255, var(--bg-opacity))" align="left">
      <p style="font-weight: 600; margin-bottom: 0;">Hi! {{ ucwords($user->first_name) }} 👋</p>
      <p class="sm-leading-32" style="font-weight: 600; font-size: 20px; margin: 0 0 16px; --text-opacity: 1; color: #263238; color: rgba(38, 50, 56, var(--text-opacity));">
        {{ $subject }}
      </p>
      <p style="margin: 0 0 16px;">
        We've received a request to reset the password for the {{ config('app.name') }} account associated with {{ $user->email }}. No changes have been made to your account yet.
      </p>
      <p style="margin: 0 0 16px;">
        You can reset your password by clicking the link below:
      </p>
      <a href="{{ localeRoute('password', ['token' => $token]) }}" style="display: block; font-weight: 600; font-size: 14px; line-height: 100%; padding: 16px 24px; --text-opacity: 1; color: #ffffff; color: rgba(255, 255, 255, var(--text-opacity)); text-decoration: none;">Reset your password</a>
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
  <tr>
    <td style="font-family: 'Montserrat',Arial,sans-serif; height: 16px;" height="16"></td>
  </tr>
@endsection