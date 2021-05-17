if (typeof Shopify.shop !== 'undefined' && typeof Shopify.checkout !== 'undefined') {
    var checkout = Shopify.checkout;
    var order = {
        order_id: checkout.order_id,
        customer_id: checkout.customer_id,
    };

    (async () => {
        const rawResponse = await fetch('{{  route('rest.affiliate.order') }}?shop=' + Shopify.shop, {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(order)
        });
        const content = await rawResponse.json();
      
        if (typeof content === 'object') {
            Shopify.Checkout.OrderStatus.addContentBox(
                `{!! $html !!}`
            )

            window.modalInfo = function () {
                document.getElementById('offer-details').style.display = "flex";
            }
    
            window.modalClose = function () {
                document.getElementById('offer-details').style.display = "none";
            }

            var el = document.getElementById('app-affiliate-section');
            var discountEl = document.getElementById('app-discount');
            var couponEl = document.getElementById('app-coupon');
            var headerEl = document.getElementById('offer_header');

            headerEl.style.color = content.color;
            discountEl.innerText = content.discount;
            couponEl.innerText = content.coupon;
            el.style.display = "block";

            window.copyLink = function () {
                var codeToCopy = document.getElementById('app-coupon');
                var copyMsg = document.getElementById('copy-msg');

                var selection = document.createRange();
                selection.selectNodeContents(codeToCopy);
                window.getSelection().removeAllRanges();
                window.getSelection().addRange(selection);
                var res = document.execCommand('copy');
                copyMsg.innerText = 'Code copied';

                window.setTimeout(function() {
                    copyMsg.innerText = 'Copy code';
                    window.getSelection().removeRange(selection);
                }, 5000);
            }
    
            window.shareFacebook = function () {
                window.open('http://www.facebook.com/sharer.php?description=You can make money promoting our products!&u=' + content.url, 'sharer'+'target=_blank');
            }
    
            window.shareTwitter = function () {
                window.open('https://twitter.com/intent/tweet?text=You can make money promoting our products!&url=' + content.url, 'sharer'+'target=_blank');
            }
        }
    })();
}