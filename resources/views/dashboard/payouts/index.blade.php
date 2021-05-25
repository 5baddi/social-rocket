@extends('layouts.dashboard')

@section('title')
    {{ ucfirst($title) }}
@endsection

@section('content')
<div class="row row-cards">
    <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Panding payouts</h3>
          </div>
          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
              <thead>
                <tr>
                  <th>Order date</th>
                  <th>Affiliate name</th>
                  <th>Affiliate email</th>
                  <th>Total</th>
                  <th>Commission</th>
                  <th>Status</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @if ($unpaidCommissions->count() === 0)
                  <tr>
                    <td colspan="7" class="text-center text-xs text-muted">No data</td>
                  </tr>
                  @endif
                  @foreach ($unpaidCommissions as $commission)
                    <tr>
                        <td>{{ $commission->created_at->format('d/m/Y') }}</td>
                        <td>{{ $commission->affiliate->getFullName() }}</td>
                        <td>{{ $commission->affiliate->email }}</td>
                        <td class="text-green">+${{ $commission->order->total_price_usd }}</td>
                        <td class="text-red">${{ $commission->amount }}</td>
                        <td class="text-red">UNPAID</td>
                        <td>
                            <a href="#" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modal-payment-{{ $commission->id }}">
                                Send payment&nbsp;&nbsp;
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <line x1="10" y1="14" x2="21" y2="3"></line>
                                    <path d="M21 3l-6.5 18a0.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a0.55 .55 0 0 1 0 -1l18 -6.5"></path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    
                    @include('dashboard.payouts.send-modal', ['commission' => $commission])
                  @endforeach
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            {!! $paidCommissions->links('partials.dashboard.paginator') !!}
          </div>
        </div>
    </div>
    
    <div class="col-12">
        <div class="card" id="paid">
          <div class="card-header">
            <h3 class="card-title">All payouts</h3>
          </div>
          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
              <thead>
                <tr>
                  <th>Order date</th>
                  <th>Affiliate name</th>
                  <th>Affiliate email</th>
                  <th>Total</th>
                  <th>Commission</th>
                  <th>Status</th>
                  <th>Payout method</th>
                  <th>Payout date</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @if ($paidCommissions->count() === 0)
                  <tr>
                    <td colspan="7" class="text-center text-xs text-muted">No data</td>
                  </tr>
                  @endif
                  @foreach ($paidCommissions as $commission)
                    <tr>
                        <td>{{ $commission->created_at->format('d/m/Y') }}</td>
                        <td>{{ $commission->affiliate->getFullName() }}</td>
                        <td>{{ $commission->affiliate->email }}</td>
                        <td class="text-green">+${{ $commission->order->total_price_usd }}</td>
                        <td class="text-red">${{ $commission->amount }}</td>
                        <td>{{ strtoupper($commission->status) }}</td>
                        <td>
                            @switch($commission->payout_method)
                                @case('paypal')
                                    <svg version="1.1" height="24" width="24" class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                        <path style="fill:#002987;" d="M428.876,132.28c0.867-7.045,1.32-14.218,1.32-21.497C430.196,49.6,380.597,0,319.413,0H134.271
                                            c-11.646,0-21.589,8.41-23.521,19.894l-68.22,405.475c-2.448,14.55,8.768,27.809,23.521,27.809h67.711
                                            c11.646,0,21.776-8.404,23.707-19.889c0,0,0.113-0.673,0.317-1.885h0.001l-9.436,56.086C146.195,500.313,156.08,512,169.083,512
                                            h59.237c10.265,0,19.029-7.413,20.731-17.535l16.829-100.02c2.901-17.242,17.828-29.867,35.311-29.867h15.562
                                            c84.53,0,153.054-68.525,153.054-153.054C469.807,178.815,453.639,149.902,428.876,132.28z"/>
                                        <path style="fill:#0085CC;" d="M428.876,132.28c-10.594,86.179-84.044,152.91-173.086,152.91h-51.665
                                            c-11.661,0-21.732,7.767-24.891,18.749l-30.882,183.549C146.195,500.312,156.08,512,169.083,512h59.237
                                            c10.265,0,19.029-7.413,20.731-17.535l16.829-100.02c2.901-17.242,17.828-29.867,35.311-29.867h15.562
                                            c84.53,0,153.054-68.525,153.054-153.054l0,0C469.807,178.815,453.639,149.902,428.876,132.28z"/>
                                        <path style="fill:#00186A;" d="M204.125,285.19h51.665c89.043,0,162.493-66.731,173.086-152.909
                                            c-15.888-11.306-35.304-17.978-56.29-17.978h-134.85c-15.353,0-28.462,11.087-31.01,26.227l-27.493,163.408
                                            C182.392,292.956,192.464,285.19,204.125,285.19z"/>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                    </svg>
                                    @break
                                    @case('cashapp')
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" class="icon" viewBox="0 0 14.003 14.003">
                                        <g id="icons8-cash-app" transform="translate(-6 -6)">
                                        <path id="Trazado_46" data-name="Trazado 46" d="M9.112,6h7.779A3.112,3.112,0,0,1,20,9.112v7.779A3.112,3.112,0,0,1,16.891,20H9.112A3.112,3.112,0,0,1,6,16.891V9.112A3.112,3.112,0,0,1,9.112,6Z" fill="#64dd17"/>
                                        <path id="Trazado_47" data-name="Trazado 47" d="M18.608,21.866l-.144,0a3.764,3.764,0,0,1-2.638-1.244.193.193,0,0,1,0-.264l.647-.73a.193.193,0,0,1,.259-.019,3.291,3.291,0,0,0,1.827.847c1.016.055,1.489-.234,1.55-.675.058-.418-.146-.772-1.275-1.065-2.017-.523-2.379-1.7-2.254-2.683a2.353,2.353,0,0,1,2.445-1.846,5.027,5.027,0,0,1,3.252,1.143.193.193,0,0,1,.007.284l-.615.695a.192.192,0,0,1-.24.026,3.253,3.253,0,0,0-2.037-.807c-.681,0-1.1.26-1.139.6-.06.475.257.885,1.227,1.1,2.15.485,2.512,1.738,2.283,2.749C21.559,20.91,20.494,21.866,18.608,21.866Z" transform="translate(-5.973 -5.001)" fill="#fafafa"/>
                                        <path id="Trazado_48" data-name="Trazado 48" d="M25.559,13.786l.326-1.552A.194.194,0,0,0,25.7,12H24.5a.194.194,0,0,0-.19.154l-.328,1.56Z" transform="translate(-10.989 -3.666)" fill="#fafafa"/>
                                        <path id="Trazado_49" data-name="Trazado 49" d="M20.344,31l-.36,1.71a.2.2,0,0,0,.191.235h1.192a.194.194,0,0,0,.19-.154L21.934,31Z" transform="translate(-8.542 -15.276)" fill="#fafafa"/>
                                        </g>
                                    </svg> 
                                    @break
                                    @case('zelle')
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" class="icon" viewBox="0 0 25.656 25.67">
                                        <path id="path3715" d="M4.883,25.569a5.687,5.687,0,0,1-3.141-1.715A4.553,4.553,0,0,1,.655,22.346C-.017,20.954,0,21.194,0,12.848c0-6.4.018-7.461.136-8.034A5.977,5.977,0,0,1,4.643.17C5.325.007,5.662,0,12.849,0c8.5,0,8.226-.02,9.626.7A6.248,6.248,0,0,1,25,3.254c.695,1.417.658.877.658,9.594,0,7.177-.011,7.793-.153,8.306a6.193,6.193,0,0,1-4.3,4.34c-.474.141-1.109.154-8.138.171-6.114.015-7.734,0-8.181-.1Zm9.428-2.958c.152-.081.166-.19.166-1.328V20.044h1.8c1.763,0,2.074-.04,2.242-.291a7.734,7.734,0,0,0,.064-1.3c0-.906-.029-1.245-.12-1.371-.116-.158-.28-.168-3.38-.209l-3.258-.043,1.437-1.842c.79-1.013,2.311-2.96,3.379-4.326l1.942-2.484V7.087c0-1.533.154-1.435-2.226-1.435H14.477V4.428a3.764,3.764,0,0,0-.1-1.328,9.649,9.649,0,0,0-2.878,0,3.764,3.764,0,0,0-.1,1.328V5.652H9.551c-2.349,0-2.184-.119-2.184,1.579,0,1.009.025,1.261.135,1.371.074.074.141.143.15.153s1.392.039,3.075.064l3.06.046-3.36,4.283L7.067,17.43v1.143c0,1.571-.162,1.47,2.365,1.47h1.961v1.238c0,1.089.018,1.248.15,1.325A11.159,11.159,0,0,0,14.311,22.61Z" fill="#6c1cd3"/>
                                    </svg>
                                    @break
                                    @case('venmo')
                                    <svg height="24" width="24" class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 516 516"><defs><style>.a{fill:#3396cd;}.b{fill:#fff;}</style></defs><title>venmo-icon</title><rect class="a" width="516" height="516" rx="61" ry="61"/><path class="b" d="M385.16,105c11.1,18.3,16.08,37.17,16.08,61,0,76-64.87,174.7-117.52,244H163.49L115.28,121.65l105.31-10L246.2,316.82C270,278,299.43,217,299.43,175.44c0-22.77-3.9-38.25-10-51Z"/></svg>
                                    @break
                            
                                @default
                                    <svg version="1.1" height="24" width="24" class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 511.999 511.999;" xml:space="preserve">
                                        <g>
                                            <rect x="10.199" y="430.986" style="fill:#FF9839;" width="491.6" height="68.763"/>
                                            <polygon style="fill:#FF9839;" points="501.8,151.83 10.2,151.83 256,12.254 	"/>
                                        </g>
                                        <g>
                                            <rect x="171.988" y="151.835" style="fill:#FFD890;" width="56.007" height="279.151"/>
                                            <rect x="59.976" y="151.835" style="fill:#FFD890;" width="56.007" height="279.151"/>
                                            <rect x="396.013" y="151.835" style="fill:#FFD890;" width="56.007" height="279.151"/>
                                            <rect x="284.006" y="151.835" style="fill:#FFD890;" width="56.007" height="279.151"/>
                                        </g>
                                        <circle style="fill:#947C7C;" cx="255.999" cy="91.283" r="24.631"/>
                                        <g>
                                            <path style="fill:#4C1D1D;" d="M501.8,420.786h-39.577V162.029H501.8c4.63,0,8.678-3.119,9.861-7.594
                                                c1.182-4.476-0.799-9.187-4.824-11.474L261.036,3.383c-3.124-1.774-6.949-1.774-10.073,0L5.164,142.961
                                                c-4.026,2.287-6.007,6.997-4.824,11.474c1.182,4.476,5.231,7.594,9.861,7.594h39.577v258.757H10.2
                                                c-5.633,0-10.199,4.566-10.199,10.199v68.762c0,5.633,4.566,10.199,10.199,10.199h491.6c5.633,0,10.199-4.566,10.199-10.199
                                                v-68.762C511.999,425.352,507.433,420.786,501.8,420.786z M441.824,420.786h-35.608V162.029h35.608V420.786z M350.209,420.786
                                                V162.029h35.609v258.757H350.209z M238.195,420.786V162.029h35.608v258.757H238.195z M126.182,420.786V162.029h35.609v258.757
                                                H126.182z M182.188,162.029h35.608v258.757h-35.608V162.029z M294.202,162.029h35.608v258.757h-35.608V162.029z M48.816,141.631
                                                L256,23.983l207.184,117.649H48.816V141.631z M70.175,162.029h35.608v258.757H70.175V162.029z M491.6,441.184v48.363H20.399
                                                v-48.363H491.6z"/>
                                            <path style="fill:#4C1D1D;" d="M256,126.109c19.206,0,34.83-15.625,34.83-34.83s-15.625-34.83-34.83-34.83
                                                s-34.83,15.625-34.83,34.83S236.794,126.109,256,126.109z M256,76.846c7.958,0,14.432,6.474,14.432,14.432
                                                s-6.474,14.432-14.432,14.432c-7.957,0-14.432-6.474-14.432-14.432S248.041,76.846,256,76.846z"/>
                                            <path style="fill:#4C1D1D;" d="M189.29,455.68H47.659c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199
                                                h141.63c5.633,0,10.199-4.566,10.199-10.199C199.488,460.247,194.923,455.68,189.29,455.68z"/>
                                            <path style="fill:#4C1D1D;" d="M234.448,455.68h-11.289c-5.633,0-10.199,4.566-10.199,10.199c0,5.633,4.566,10.199,10.199,10.199
                                                h11.289c5.633,0,10.199-4.566,10.199-10.199C244.647,460.247,240.081,455.68,234.448,455.68z"/>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                        <g>
                                        </g>
                                    </svg>
                            @endswitch
                            &nbsp;&nbsp;{{ strtoupper($commission->payout_method) }}
                        </td>
                        <td>{{ $commission->paid_at->format('d/m/Y') }}</td>
                        <td>

                        </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            {!! $paidCommissions->links('partials.dashboard.paginator') !!}
          </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @include('partials.dashboard.scripts.form')
@endsection