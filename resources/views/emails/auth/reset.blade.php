@extends('layouts.mail')

@section('content')
<tr>
    <td>
        <p style="font-size: 14px;">Hey there! Thanks for shopping with us😆
        </p>

        <p style="font-size: 14px;">Now that you are part of our family, I
            wanted to offer you the opportunity to become an affiliate for
            our online store!</p>

        <p style="font-size: 14px;">As an affiliate, you get paid cold hard
            cash for every sale you bring us!🤑 Pretty cool, right?</p>

        <p style="font-size: 14px;">To make things easier for you, we
            already went ahead and created your custom discount code:</p>
    </td>
</tr>
<tr>
    <td align="center">
        <div style="margin: 0 auto; border: 1px solid #000000; margin: 0 auto; padding: 5px; width: 50%; background: #000000; color: white;">
            <b>TESTCODE</b>
        </div>
        <p style="font-size: 14px;">Share your code:</p>
        <table>
            <tbody><tr>
                <td style="width: 120px; text-align: center; padding-right: 5px;">
                    <div style="width: 85%;">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Ftesttesttest3122.myshopify.com&amp;quote=If+anyone+is+interested+in+getting+a+discount+at+TestTestTest3122+please+feel+free+to+use+my+code+TESTCODE+for+10%25+off+of+any+purchase%21" style="text-decoration:none; color: #fff; display: inline-block; padding: 8px 16px 8px 13px; background-color: #3C57B3; border-radius: 30px; cursor: pointer; width: 88%; font-size: 12px;" target="_blank">
                            <img src="https://d2x5l5rgp1imsp.cloudfront.net/e6c1167d-1c09-46b3-b3f2-c562f35c1982/img/facebook.png" alt="" style="width: 20px; margin-top: -5px; margin-right: 4px; display: inline-block; vertical-align: middle; ">
                            Share
                        </a>
                    </div>
                </td>
                <td style="width: 120px; text-align: center; padding-right: 5px;">
                    <div style="width: 85%;">
                        <a href="https://twitter.com/intent/tweet?url=https%3A%2F%2Ftesttesttest3122.myshopify.com%2F&amp;text=If+anyone+is+interested+in+getting+a+discount+at+TestTestTest3122+please+feel+free+to+use+my+code+TESTCODE+for+10%25+off+of+any+purchase%21" style="text-decoration:none; color: #40ABEE; font-weight: 600; display: inline-block; padding: 8px 15px 8px 12px; background-color: #000000; border-radius: 30px; cursor: pointer; width: 88%; font-size: 12px;" target="_blank">
                            <img src="https://d2x5l5rgp1imsp.cloudfront.net/e6c1167d-1c09-46b3-b3f2-c562f35c1982/img/twitter.png" alt="" style="width: 20px; margin-top: -5px; margin-right: 4px; display: inline-block; vertical-align: middle;">
                            Share
                        </a>
                    </div>
                </td>
            </tr>
        </tbody></table>
        <p style="font-size: 14px;">This code is valid for 10%
            off
            any order!</p>
    </td>
</tr>
<tr>
    <td>
        <p style="font-size: 14px;">Every time someone makes a purchase
            using your code, we will send you 10% to a payout
            method of
            your choice! It’s that easy.</p>

        <p style="font-size: 14px;">Once you get your first sale, we will
            email you with instructions to finish setting up your account
            and collect your money!</p>

        <p style="font-size: 14px;">Want to get your first sale but don’t
            know where to start? Check out this epic blog post we wrote on
            how to make BANK as a brand affiliate: <a href="{{ env('HELP_URL') }}" target="_blank">{{ env('HELP_URL') }}</a>
        </p>

        <p style="font-size: 14px;">Have more questions? Feel free to send
            us an email! We’re here to help.😇</p>
    </td>
</tr>
@endsection