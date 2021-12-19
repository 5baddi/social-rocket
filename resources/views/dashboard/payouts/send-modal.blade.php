<div class="modal modal-blur fade show" id="modal-payment-{{ $commission->id }}" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Send payment</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel"></button>
        </div>
        <form action="{{ route('dashboard.payouts.send', ['commission' => $commission->id]) }}" method="POST">
          @csrf
          <div class="modal-body">
              <div>
                  <label class="form-label">Reference</label>
                  <input type="text" name="reference" class="form-control">
              </div>
              <div class="mt-3">
                <label class="form-label">Payout method</label>
                <input type="hidden" name="payout_method" value="{{ $commission->payout_method }}"/>
                <select class="form-select" id="select-payout-method">
                  <option value="bank" @if($commission->payout_method === 'bank')selected @endif selected="selected">Bank Transfer</option>
                  <option value="paypal" @if($commission->payout_method === 'paypal')selected @endif>PayPal</option>
                  <option value="venmo" @if($commission->payout_method === 'venmo')selected @endif>Venmo</option>
                  <option value="zelle" @if($commission->payout_method === 'zelle')selected @endif>Zelle</option>
                  <option value="cashapp" @if($commission->payout_method === 'cashapp')selected @endif>Cashapp</option>
                </select>
              </div>
              <div class="mt-3">
                  <label class="form-label">Additional info</label>
                  <textarea class="form-control" name="additional_info"></textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-dark">Send</button>
          </div>
        </form>
      </div>
    </div>
</div>

@section('script')
    document.addEventListener("DOMContentLoaded", function () {
        var el = document.getElementById('select-payout-method');
        window.Choices && (new Choices(el, {
          classNames: {
            containerInner: el.className,
            input: 'form-control',
            inputCloned: 'form-control-sm',
            listDropdown: 'dropdown-menu',
            itemChoice: 'dropdown-item',
            activeState: 'show',
            selectedState: 'active',
          },
          shouldSort: false,
          searchEnabled: false
        }));

         $('#select-payout-method').on('change', function() {
            var value = $("#select-payout-method option:first").val();
            $('input[name=payout_method]').val(value);
        });
    });
@endsection