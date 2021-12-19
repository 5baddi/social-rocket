@extends('layouts.mail')

@section('content')
<tr>
    <td>
        <p style="font-size: 14px;">Hey Jone!</p>

        <p style="font-size: 14px;">I wanted to reach out to remind you that you could be earning some serious money from your new position with us as an affiliate.</p>

        <p style="font-size: 14px;">One massive upside to affiliate marketing is that the earning potential is unlimited. As long as you keep getting sales, you keep getting paid. Many master affiliates make six figures monthly.</p>
    </td>
</tr>
<tr>
    <td>
        <p style="font-size: 14px;">
            Every month, thousands of more novice affiliates like you are making 4-5 figures profit by promoting products they love!
            <br>
        </p>
        <p style="font-size: 14px;">
            What’s my point? Keep trying! Don’t let small failures discourage you. You got this! For more tips and tricks on how to get affiliate sales: <a href="{{ env('HELP_URL') }}" target="_blank">{{ env('HELP_URL') }}</a>
        </p>
        <p style="font-size: 14px;">In case you lost our previous email, here is your discount code:</p>
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
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Ftesttesttest3122.myshopify.com%2F&amp;quote=If+anyone+is+interested+in+getting+a+discount+at+TestTestTest3122+please+feel+free+to+use+my+code+TESTCODE+for+10%25+off+of+any+purchase%21" style="text-decoration:none; color: #fff; display: inline-block; padding: 8px 16px 8px 13px; background-color: #3C57B3; border-radius: 30px; cursor: pointer; width: 88%;">
                            <img src="https://d2x5l5rgp1imsp.cloudfront.net/e6c1167d-1c09-46b3-b3f2-c562f35c1982/img/facebook.png
                            " alt="" style="width: 20px; margin-top: -5px; margin-right: 4px; display: inline-block; vertical-align: middle; ">
                            Share
                        </a>
                    </div>
                </td>
                <td style="width: 120px; text-align: center; padding-right: 5px;">
                    <div style="width: 85%;">
                        <a href="https://twitter.com/intent/tweet?url=https%3A%2F%2Ftesttesttest3122.myshopify.com%2F&amp;text=If+anyone+is+interested+in+getting+a+discount+at+TestTestTest3122+please+feel+free+to+use+my+code+TESTCODE+for+10%25+off+of+any+purchase%21!" style="text-decoration:none; color: #40ABEE; font-weight: 600; display: inline-block; padding: 8px 15px 8px 12px; background-color: #000000; border-radius: 30px; cursor: pointer; width: 88%;" onclick="shareTwitter()">
                            <img src="https://d2x5l5rgp1imsp.cloudfront.net/e6c1167d-1c09-46b3-b3f2-c562f35c1982/img/twitter.png" alt="" style="width: 20px; margin-top: -5px; margin-right: 4px; display: inline-block; vertical-align: middle; ">
                            Share
                        </a>
                    </div>
                </td>
            </tr>
        </tbody></table>
        <p style="font-size: 14px;">This code is valid for
                                                                            <b>10%</b>
             off any order!</p>
    </td>
</tr>
<tr>
    <td>
        <p style="font-size: 14px;">Remember, every time someone makes a purchase using your code, we will send you
                                                                    <b>10%</b>
                                                                to a payout method of your choice!</p>

        <p style="font-size: 14px;">As always, never hesitate to reach out if you have any questions, or just want to chat.</p>
    </td>
</tr>
@endsection