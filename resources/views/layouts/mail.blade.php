
<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="icon" type="image/png" href="{{ asset('img/mini-logo.png') }}"/>
        <style>
            @import  url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');
        </style>
    </head>
    <body style="-webkit-text-size-adjust: none; background-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margin: 0; padding: 0; width: 100% !important;">
        <style>
            .inner-body {
                font-family: 'Roboto', sans-serif;
                font-size: 15px;
                color: #00295a;
                font-weight: 300;
            }

            a {
                font-weight: bold;
                color: #3861f9;
            }

            @media  only screen and (max-width: 600px) {
                .inner-body {
                    width: 100% !important;
                }

                .footer {
                    width: 100% !important;
                }
            }

            @media  only screen and (max-width: 500px) {
                .button {
                    width: 100% !important;
                }
            }
        </style>
        <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation"
            style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: 100%;">
            <tr>
                <td align="center">
                    <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation"
                        style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; margin: 0; padding: 0; width: 100%;">
                        <tr>
                            <td style="padding: 25px 0; text-align: center;">
                                    <a href="{{ url('/') }}" style="display: inline-block;">
                                        <img src="{{ asset('assets/img/logo.png') }}" class="logo" width="160">
                                    </a>
                            </td>
                        </tr>

                        <tr>
                            <td class="body" width="100%" cellpadding="0" cellspacing="0"
                                style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; /*border-bottom: 1px solid #edf2f7;*/ margin: 0; padding: 0; width: 100%;">
                                <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0"
                                    role="presentation"
                                    style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;">
                                    <tr>
                                        <td class="content-cell" style="max-width: 100vw; padding: 32px;">
                                            <table class="subcopy" width="100%" cellpadding="0" cellspacing="0"
                                                role="presentation">

                                                @yield('content')

                                                <tr>
                                                    <td>
                                                        <p style="font-size: 14px;">Good luck! I know you’ll crush it.</p>

                                                        @if ($store)
                                                        <p style="font-size: 14px;"><b>{{ ucwords($store->name) }}</b></p>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; margin: 0 auto; padding: 0; text-align: center; width: 570px;">
                                                            <tr>
                                                                <td class="content-cell" align="center">
                                                                    <p style="color: #b0adc5; font-size: 12px; font-family: 'Roboto', sans-serif; text-align: center;">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved. <!--<a style="color: #b0adc5; font-size: 12px; font-family: 'Roboto', sans-serif; text-align: center;font-weight: inherit;" href="/mail-unsubscribe/eyJpdiI6ImFDRS9uazF5YlgwcUErcHJVQVd0dmc9PSIsInZhbHVlIjoiN0pBMzcxQ3ZWa3YrOE5jS25XVC9adz09IiwibWFjIjoiM2RhMjk5ZmMwOTk3MDg4ZDRkOGVlOWQxZjcwYWU2YWFiYjY3MWM2MzdkNWU1MzU2ZTlhODEzNjEwMDNlNjNkYyJ9">Unsubscribe</a></p>-->
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding: 50px 0; text-align: center;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>