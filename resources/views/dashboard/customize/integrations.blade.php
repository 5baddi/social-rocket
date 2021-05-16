@extends('layouts.dashboard')

@section('title')
    {{ ucfirst($title) }}
@endsection

@section('content')
<div class="row row-cards">
    <form action="{{ route('dashboard.customize.integrations.save') }}" method="POST">
        <div class="card">
            <div class="col-12">
                @csrf
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <label class="form-check form-check-single form-switch" style="padding-left: 0 !important; padding-right: 1rem">
                            <input name="affiliate_form" class="form-check-input" value="1" type="checkbox" @if (old('affiliate_form') ?? $setting->affiliate_form)checked @endif/>
                        </label>
                        <label class="card-title">Afilliate Form</label>
                    </div>
                </div>
                {{-- <div class="card-body" style="display: none;"> --}}
                <div class="card-body">
                    <div class="row">
                        <p class="text-muted">Embed a custom form on your website to attract new affiliates</p>
                        <div class="col">
                            <input type="text" value="{{ route('affiliate', ['store' => $store]) }}" class="form-control" readonly/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <div class="d-flex">
                {{-- Need Help?&nbsp;<a href="{{ route('dashboard.help') }}">check our guide</a> --}}
                <button type="submit" class="btn btn-ghost-dark ms-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-floppy" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2"></path>
                        <circle cx="12" cy="14" r="2"></circle>
                        <polyline points="14 4 14 8 8 8 8 4"></polyline>
                    </svg>
                    &nbsp;Save
                </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection