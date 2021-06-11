@extends('layouts.admin')

@section('title')
    {{ ucfirst($title) }}
@endsection

@section('content')
    <div class="row align-items-center pt-2 pb-4">
        <div class="col-auto ms-auto d-print-none">
        <form id="periodForm" action="{{ route('dashboard') }}" method="POST">
            @csrf
            <input type="hidden" id="startDate" name="start-date"/>
            <input type="hidden" id="endDate" name="end-date"/>
        </form>
        <div class="input-icon mb-2">
            <input type="text" id="period" name="period" class="form-control " placeholder="Select a date"/>
            <span class="input-icon-addon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><rect x="4" y="5" width="16" height="16" rx="2"></rect><line x1="16" y1="3" x2="16" y2="7"></line><line x1="8" y1="3" x2="8" y2="7"></line><line x1="4" y1="11" x2="20" y2="11"></line><line x1="11" y1="15" x2="12" y2="15"></line><line x1="12" y1="15" x2="12" y2="18"></line></svg>
            </span>
        </div>
        {{-- <input type="text" id="period"/> --}}
            {{-- <div class="btn-list">
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
            </div> --}}
        </div>
    </div>
    <div class="row row-cards">
        <div class="col-sm-3">
            <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-store" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="3" y1="21" x2="21" y2="21"></line>
                                <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4"></path>
                                <line x1="5" y1="21" x2="5" y2="10.85"></line>
                                <line x1="19" y1="21" x2="19" y2="10.85"></line>
                                <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        78 Stores
                      </div>
                      <div class="text-muted">
                        52 activated
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-purple text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-dollar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2"></path>
                                <path d="M12 3v3m0 12v3"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        Subscriptions
                      </div>
                      <div class="text-muted">
                        $120 earnings
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                      <span class="bg-orange text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="6" cy="19" r="2"></circle><circle cx="17" cy="19" r="2"></circle><path d="M17 17h-11v-14h-2"></path><path d="M6 5l14 1l-1 7h-13"></path></svg>
                      </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        78 Orders
                      </div>
                      <div class="text-muted">
                        $200 sales
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card card-sm">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="bg-blue text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                            </svg>
                        </span>
                    </div>
                    <div class="col">
                      <div class="font-weight-medium">
                        78 Affiliates
                      </div>
                      <div class="text-muted">
                        32 confirmed
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('partials.dashboard.scripts.analytics')
@endsection

@section('script')
  document.addEventListener("DOMContentLoaded", function () {
    $('#period').daterangepicker({
      "startDate": "{{ $startDate }}",
      "endDate": "{{ $endDate }}",
      locale: {
        format: 'YYYY/MM/DD'
      }
    }); 

    $('#period').on('apply.daterangepicker', function(ev, picker) {
      $('#startDate').val(picker.startDate.format('YYYY-MM-DD'));
      $('#endDate').val(picker.endDate.format('YYYY-MM-DD'));
      $('#periodForm').submit();
    });
  });
@endsection