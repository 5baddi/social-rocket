@extends('layouts.dashboard')

@section('title')
    {{ ucfirst($title) }}
@endsection

@section('content')
    <div class="row align-items-center pt-2 pb-4">
        <div class="col-auto ms-auto d-print-none">
          <form id="periodForm" action="{{ route('dashboard') }}" method="POST">
            @csrf
            <input type="hidden" id="startDate" name="start-date" value="{{ $startDate }}"/>
            <input type="hidden" id="endDate" name="end-date" value="{{ $endDate }}"/>
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
    <div class="row row-deck row-cards">
        <div class="col-sm-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex align-items-center">
                  <div class="subheader">Total Revenue</div>
                </div>
                <div class="h1 mb-3 text-green">+$0.00</div>
                <div class="d-flex">
                    <div>0 orders</div>
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
                    <a href="{{ route('dashboard.payouts') }}">
                      View Payouts
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <polyline points="9 6 15 12 9 18"></polyline>
                      </svg>
                    </a>
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
                    <a href="{{ route('dashboard.payouts', ['action' => 'send']) }}">
                      Send Payouts
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <polyline points="9 6 15 12 9 18"></polyline>
                      </svg>
                    </a>
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
      "applyButtonClasses": "btn-black",
      locale: {
        format: 'YYYY/MM/DD'
      }
    }); 

    $('#period').on('apply.daterangepicker', function(ev, picker) {
      $('#startDate').val(picker.startDate.format('YYYY-MM-DD'));
      $('#endDate').val(picker.endDate.format('YYYY-MM-DD'));
      $('#periodForm').submit();
    })
  });
@endsection