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
        console.log(Shopify.checkout);
        console.log(content);
      
        if (typeof content === 'object') {
            Shopify.Checkout.OrderStatus.addContentBox(
                `{!! $html !!}`
            )

            var el = document.getElementById('app-affiliate-section');
            el.style.display = "block";
        }
    })();
}