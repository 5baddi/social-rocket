@foreach ($packs as $pack)
    <div class="col-lg-4 col-md">
        <div class="card card-pricing @if($pack->is_popular)bg-dark @endif text-center px-3 hover-scale-110">
            <div class="card-header border-0 delimiter-bottom">
                <h5 class="@if($pack->is_popular)text-white @else text-muted @endif">{{ ucwords($pack->getName()) }}</h5>
                <div class="h1 text-center mb-0 @if($pack->is_popular)text-white @endif">
                    @if ($pack->isFree())
                        <span class="price font-weight-bolder">Free</span>
                    @else
                    {{ $pack->isFixedPrice() ? $pack->symbol : '' }}<span class="price font-weight-bolder">{{ $pack->price }}</span>{{ !$pack->isFixedPrice() ? '%' : '' }}
                    @endif
                    @if ($pack->getRevenueShare() > 0)
                        <p class="text-sm">+{{ number_format($pack->getRevenueShare() * 100, 0) }}% @lang('packs.revenue_share')</p>
                    @endif
                </div>
                <hr/>
            </div>
            <div class="card-body">
                <ul class="list-unstyled text-sm mb-4 @if($pack->is_popular)text-white @endif">
                    @foreach ($pack->getFeatures() as $feature)
                        <li @if(!$feature['enabled'])class="uncheck"@endif>{{ ucwords($feature['name']) }}</li>
                    @endforeach
                </ul>
                <a href="{{ route('connect') }}" class="btn btn-sm btn-warning hover-translate-y-n3 hover-shadow-lg mb-3">
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
