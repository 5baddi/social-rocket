@extends('layouts.dashboard')

@section('title')
    {{ ucfirst($title) }}
@endsection

@section('content')
<div class="row row-cards">
    <div class="col-12">
      <form action="{{ route('dashboard.customize.integrations') }}" method="POST" class="card">
            @csrf
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <label class="form-check form-check-single form-switch" style="padding-left: 0 !important; padding-right: 1rem">
                        <input class="form-check-input" type="checkbox" checked="">
                    </label>
                    <label class="card-title">Afilliate Form</label>
                </div>
            </div>
            <div class="card-body">

            </div>
            <div class="card-footer text-end">
                <div class="d-flex">
                    <a href="{{ route('dashboard.help') }}" class="btn btn-ghost-dark ms-auto">Need Help?</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection