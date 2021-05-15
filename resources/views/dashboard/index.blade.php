@extends('layouts.dashboard')

@section('title')
    {{ strtoupper($title) }}
@endsection

@section('content')
    <div class="row align-items-center pt-2 pb-4">
        <div class="col-auto ms-auto d-print-none">
            <div class="btn-list">
                <div class="ms-auto lh-1">
                    <div class="dropdown">
                        <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Last {{ $period ? $period : '7 days' }}</a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item {{ ($period === '7 days' || !$period) ? 'active' : '' }}" href="{{ route('dashboard', ['period' => '7_days']) }}">Last 7 days</a>
                            <a class="dropdown-item {{ $period === '30 days' ? 'active' : '' }}" href="{{ route('dashboard', ['period' => '30_days']) }}">Last 30 days</a>
                            <a class="dropdown-item {{ $period === 'current year' ? 'active' : '' }}" href="{{ route('dashboard', ['period' => 'current_year']) }}">Current year</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-deck row-cards">
        <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="subheader">Total Revenue</div>
                </div>
                <div class="h1 mb-3 text-green">+$0.00</div>
                <div class="d-flex">
                    <div>189 orders</div>
                </div>
              </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="subheader">Commission Paid</div>
                </div>
                <div class="h1 mb-3">$0.00</div>
                <div class="d-flex">
                    <a href="#">View Payouts</a>
                </div>
              </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="subheader">Commission own</div>
                </div>
                <div class="h1 mb-3">$0.00</div>
                <div class="d-flex">
                    <a href="#">Send Payouts</a>
                </div>
              </div>
            </div>
        </div>
    </div>
@endsection