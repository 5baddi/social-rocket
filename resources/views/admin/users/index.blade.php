@extends('layouts.admin')

@section('title')
    {{ ucfirst($title) }}
@endsection

@section('content')
<div class="row row-cards">
    <div class="col-12">
        <div class="card">
          <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Store</th>
                  <th>Join at</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                  @if ($users->count() === 0)
                  <tr>
                    <td colspan="5" class="text-center text-xs text-muted">No data</td>
                  </tr>
                  @endif
                  @foreach ($users as $user)
                    @if ($user->id === Auth::id())
                    @continue
                    @endif
                    <tr>
                        <td>{{ ucwords($user->getFullName()) }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->store !== null ? $user->store->name : '---' }}</td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        {{-- <td>{{ ucwords($subscription->store->name) }}</td>
                        <td>{{ ucwords($subscription->user->getFullName()) }}</td>
                        <td>{{ ucwords($subscription->pack->name) }}</td>
                        <td>{{ $subscription->pack->isFixedPrice() ? $subscription->pack->symbol : '' }}{{ $subscription->pack->price }}{{ !$subscription->pack->isFixedPrice() ? '%' : '' }}</td>
                        <td>{{ ucfirst($subscription->status) }}</td>
                        <td>{{ $subscription->activated_on->format('d/m/Y') }}</td>--}}
                        <td align="center">
                            @if ($user->store !== null)
                            <a href="{{ route('admin.stores.view', ['store' => $user->store->id]) }}" class="btn btn-dark" title="Visit the store" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="12" cy="12" r="2"></circle>
                                    <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7"></path>
                                </svg>
                            </a>
                            @endif
                        </td>
                    </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
          <div class="card-footer d-flex align-items-center">
            {!! $users->links('partials.dashboard.paginator') !!}
          </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @include('partials.dashboard.scripts.form')
@endsection