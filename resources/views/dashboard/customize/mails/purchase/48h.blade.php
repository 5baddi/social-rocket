@extends('layouts.mail')

@section('content')
<tr>
    <td>
        <p style="font-size: 14px;">Hey Jone! I wanted to teach you a little secret that helps all of our affiliates get their first sale. Ready?
        <br>
        Here’s the secret: There is no better way to get your first few affiliate sales than by reaching out to your friends and family! This is an amazing way to gain momentum and set yourself up for a long, successful affiliate marketing career (or side hustle, whatever is best for you)! Since your friends and family will be happy to support you no matter what, make sure you reach out to everyone you can think of!
        <br>
        When messaging friends and family, explain to them your new gig as an affiliate marketer, and clarify to them that by using your discount code, they can get our awesome products at a great discount and support your new business venture at the same time. It's a win win!</p>

        <p style="font-size: 14px;">In case you lost our previous email, here is your discount code:</p>
    </td>
</tr>
<tr>
    <td align="center">
        <div style="margin: 0 auto; border: 1px solid #00af91; margin: 0 auto; padding: 5px; width: 50%; background: #00af91; color: white;">
            <b>TESTCODE</b>
        </div>
        <p style="font-size: 14px;">Share your code:</p>
        <table>
            <tbody><tr>
                <td style="width: 120px; text-align: center; padding-right: 5px;">
                    <div style="width: 85%;">
                        <a href="#" style="text-decoration: none; color: #fff; display: inline-block; padding: 8px 16px 8px 13px; background-color: #3C57B3; border-radius: 30px; cursor: pointer; width: 88%;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; margin-top: -5px; margin-right: 4px; display: inline-block; vertical-align: middle; " class="icon icon-tabler icon-tabler-brand-facebook" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3"></path>
                            </svg>
                            Share
                        </a>
                    </div>
                </td>
                <td style="width: 120px; text-align: center; padding-right: 5px;">
                    <div style="width: 85%;">
                        <a href="#" style="text-decoration: none; color: #40ABEE; font-weight: 600; display: inline-block; padding: 8px 15px 8px 12px; background-color: #00af91; border-radius: 30px; cursor: pointer; width: 88%;">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width: 20px; margin-top: -5px; margin-right: 4px; display: inline-block; vertical-align: middle; " class="icon icon-tabler icon-tabler-brand-twitter" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c-.002 -.249 1.51 -2.772 1.818 -4.013z"></path>
                            </svg>
                        Share
                        </a>
                    </div>
                </td>
            </tr>
        </tbody></table>
        <p style="font-size: 14px;">
            This code is valid for <strong style="font-weight: bold; font-size: 12pt;">{{ $setting->discount_type === \BADDIServices\SocialRocket\Models\Setting::FIXED_TYPE ? '$' . $setting->discount_amount : $setting->discount_amount . '%' }}</strong> off any order!
        </p>
    </td>
</tr>
<tr>
    <td>
        <p style="font-size: 14px;">
            Every time someone makes a purchase using your code, we will send you <strong style="font-weight: bold; font-size: 12pt;">{{ $setting->commission_type === \BADDIServices\SocialRocket\Models\Setting::FIXED_TYPE ? '$' . $setting->commission_amount : $setting->commission_amount . '%' }}</strong> to a payout method of your choice! It’s that easy.
        </p>

        <p style="font-size: 14px;">Just a reminder: never hesitate to reach out if you have any questions, or just want to chat.</p>
    </td>
</tr>
@endsection