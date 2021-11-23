@foreach ($packs as $pack)
    <div class="col-lg-4 col-md">
        <div class="card card-pricing @if($pack->is_popular)bg-dark @endif text-center px-3 hover-scale-110">
            <div class="card-header border-0 delimiter-bottom">
                <h5 class="@if($pack->is_popular)text-white @else text-muted @endif">{{ ucwords($pack->getName()) }}</h5>
                <div class="h1 text-center mb-0 @if($pack->is_popular)text-white @endif">
                    @if ($pack->isFree())
                        <span class="price font-weight-bolder">Free</span>
                    @else
                    <sup>{{ $pack->getCurrencySymbol() }}</sup><span class="price font-weight-bolder">{{ $pack->getPrice() }}</span>
                    @endif
                    @if ($pack->getRevenueShare() > 0)
                        <p class="text-sm">+{{ sprintf('%02d', number_format($pack->getRevenueShare() * 100, 0)) }}% @lang('packs.revenue_share')</p>
                    @else
                        <p class="text-sm">@lang('packs.no_hidden_fees')</p>
                    @endif
                </div>
                <hr/>
            </div>
            <div class="card-body">
                <ul class="list-unstyled text-sm mb-4 @if($pack->is_popular)text-white @endif">
                    @foreach ($pack->getFeatures() as $feature)
                        <li @if(!$feature->isEnabled())class="uncheck"@endif>{{ ucwords($feature->getName()) }}</li>
                    @endforeach
                </ul>
                <a href="{{ localeRoute('connect', ['plan' => $pack->getKey()]) }}" class="btn btn-sm btn-warning hover-translate-y-n3 hover-shadow-lg mb-3">
                    @if ($pack->isFree())
                        @lang('packs.try_free')
                    @else
                        @lang('packs.try_trial')
                    @endif
                </a>
            </div>
        </div>
    </div>
@endforeach
