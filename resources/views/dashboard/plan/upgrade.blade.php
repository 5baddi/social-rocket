@extends('layouts.dashboard')

@section('title')
    {{ ucfirst($title) }}
@endsection

@section('content')
<div class="d-flex justify-content-center align-items-center">
    @foreach ($packs as $pack)
    <div class="mx-3">
        <div class="card card-md">
            @if ($pack->is_popular)
            <div class="ribbon ribbon-top ribbon-bookmark bg-green" title="Most Popular">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-filled" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z"></path></svg>
            </div>
            @endif
            <div class="card-body">
                <div class="text-uppercase text-muted font-weight-medium text-center">{{ ucwords($pack->name) }}</div>
                <div class="my-3">
                    <span class="display-5">{{ $pack->isFixedPrice() ? $pack->symbol : '' }}{{ $pack->price }}{{ !$pack->isFixedPrice() ? '%' : '' }}</span>
                    <span class="text-sm">/ {{ $pack->isFixedPrice() ? 'per month' : 'of revenue share' }}</span>
                </div>
                <p></p>
                <hr/>
                <ul class="list-unstyled space-y-1">
                    @foreach ($pack->getFeatures() as $feature)
                    <li>
                        @if ($feature['enabled'])
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1 text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-1 text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                        @endif
                        {{ ucwords($feature['name']) }}
                    </li>
                    @endforeach
                </ul>
                <div class="text-center mt-4">
                    <a href="{{ ($currentPack && $currentPack->id === $pack->id) ? '#' : route('subscription.pack.billing', ['pack' => $pack->id]) }}" class="btn {{ ($currentPack && $currentPack->id === $pack->id) ? 'btn-dark' : '' }} w-100">{{ $currentPack && $currentPack->id === $pack->id ? 'Current Plan' : 'Choose ' . ucwords($pack->name) }}</a>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
