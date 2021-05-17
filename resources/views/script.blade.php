console.log(Shopify.checkout)
if (typeof Shopify.checkout !== 'undefined') {
    var checkout = Shopify.checkout;
    var order = {
        order_id: checkout.order_id,
        customer_id: checkout.customer_id,
    };

    var xhr = new XMLHttpRequest();
    xhr.open("POST", '{{  route('rest.affiliate.order') }}', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.send(JSON.stringify(order));
    {{-- jQuery.ajax({
        method: 'POST',
        url: '{{ route('rest.affiliate.order') }}',
        dataType: 'json'
      })
      .done(function(data){
          console.log(data)
      }); --}}
    {{-- Shopify.Checkout.OrderStatus.addContentBox(
        `{!! $html !!}`
    ) --}}
}