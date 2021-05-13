
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Social Snow</title>
        <meta name="viewport" content="width=device-width">
        <meta name="csrf-token" content="9Zf2iJEEZNeTTiaydX6RBy3YvtKORCzJthYeJjsH">
        <title>Social Snowball &mdash; Connect store</title>
        <link rel="icon" type="image/png" href="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/img/icon-logo.png">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/css/owl.carousel.min.css">
        <link rel="stylesheet" href="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/css/style.css">
        <link rel="stylesheet" href="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/css/responsive.css">

        <meta name="description" content="Connect your Shopify store to Social Snowball and start converting your customers into affiliates instantly (literally).">
    </head>
    <body class="body-login">
        <header>
            <div class="container content-header">
                <a href="https://socialsnowball.io" class="logo-header logo-header-login"><img src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/img/logo.svg" alt=""></a>
            </div>
        </header>
        <div class="container-fluid container-fluid-body">
            <div class="row">
                <div class="col-lg-7 col-box-left-login">
                    <div class="box-left-login">
                        <div class="box-text-left-login">
                            <h2 class="title2">Start your 10 day free trial</h2>
                            <p>Try Social Snowball and let your customers turn into your motivated affiliates.</p>
                            <ul>
                                <li>Unlimited affiliates</li>
                                <li>Unlimited revenue</li>
                                <li>Up to 5 popular payout methods</li>
                            </ul>
                        </div>
                        <img src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/img/img-left-login1.png" alt="" class="img-box-left-login">
                    </div>
                </div>
                <div class="col-lg-5 col-box-right-login">
                    <div class="box-right-login box-right-login-conect-store">
                                            <img src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/img/img-login-shop.png" alt="" class="img-box-right-login">
                        <h1 class="title1">Connect your store</h1>
                        <p>Please enter your Shopify store URL and we’ll redirect you to Shopify to finish connecting your store to Social Snowball. </p>
                        <form method="POST" action="{{ route('oauth.connect') }}">
                            @csrf

                            <div class="box-form-design1">
                                <div class="form-group-custom1">
                                    <label for="store" class="label-custom1">Shopify Store Name</label>
                                    <input id="store" name="store" type="text" name="store" id="store" class="input-custom1" placeholder="example.myshopify.com" autofocus="autofocus" required/>
                                </div>
                                <div class="box-btn-submit">
                                    <button class="btn-design1" type="submit">Connect</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/js/jquery.min.js"></script>
        <script src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/js/popper.js"></script>
        <script src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/js/bootstrap.min.js"></script>
        <script src="https://d2x5l5rgp1imsp.cloudfront.net/6b57444d-e66e-46f8-92f7-0cf65870724a/js/owl.carousel.min.js"></script>
        <script src="{{ asset('js/main.js') }}"></script>
    </body>
</html>