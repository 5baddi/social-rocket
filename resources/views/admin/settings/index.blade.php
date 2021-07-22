@extends('layouts.admin')

@section('title')
    {{ ucfirst($title) }}
@endsection

@section('content')
<form action="{{ route('admin.settings.update') }}" method="POST">
    @csrf
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Application info</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="app_name" class="form-control" value="{{ config('app.name') }}" autofocus required/>
                            @if ($errors->has('app_name'))
                            <div class="invalid-feedback">{{ $errors->first('app_name') }}</div>
                            @endif
                        </div>
                        <div class="col-6">
                            <label class="form-label">Support e-mail</label>
                            <input type="email" name="support_email" class="form-control" value="{{ config('clnkgo.support_email') }}"/>
                            @if ($errors->has('support_email'))
                            <div class="invalid-feedback">{{ $errors->first('support_email') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label class="form-label">Help URL</label>
                            <input type="url" name="help_url" class="form-control" value="{{ config('clnkgo.help_url') }}"/>
                            @if ($errors->has('help_url'))
                            <div class="invalid-feedback">{{ $errors->first('help_url') }}</div>
                            @endif
                        </div>
                        <div class="col-6">
                            <label class="form-label">Setup guide</label>
                            <input type="url" name="setup_guide" class="form-control" value="{{ config('clnkgo.setup_guide') }}"/>
                            @if ($errors->has('setup_guide'))
                            <div class="invalid-feedback">{{ $errors->first('setup_guide') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Shopify app credentials</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">API key</label>
                            <input type="text" name="api_key" class="form-control" value="{{ config('shopify.api_key') }}" required/>
                            @if ($errors->has('api_key'))
                            <div class="invalid-feedback">{{ $errors->first('api_key') }}</div>
                            @endif
                        </div>
                        <div class="col-6">
                            <label class="form-label">Client secret</label>
                            <input type="text" name="client_secret" class="form-control" value="{{ config('shopify.client_secret') }}" required/>
                            @if ($errors->has('client_secret'))
                            <div class="invalid-feedback">{{ $errors->first('client_secret') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 text-end">
            <div class="d-flex">
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
@endsection

@section('scripts')
    @include('partials.dashboard.scripts.form')
@endsection