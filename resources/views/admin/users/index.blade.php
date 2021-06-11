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
                  <th>Last login</th>
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
                        <td>{{ $user->last_login ? $user->last_login->format('d/m/Y H:m') : '---' }}</td>
                        {{-- <td>{{ ucwords($subscription->store->name) }}</td>
                        <td>{{ ucwords($subscription->user->getFullName()) }}</td>
                        <td>{{ ucwords($subscription->pack->name) }}</td>
                        <td>{{ $subscription->pack->isFixedPrice() ? $subscription->pack->symbol : '' }}{{ $subscription->pack->price }}{{ !$subscription->pack->isFixedPrice() ? '%' : '' }}</td>
                        <td>{{ ucfirst($subscription->status) }}</td>
                        <td>{{ $subscription->activated_on->format('d/m/Y') }}</td>--}}
                        <td align="center">
                            <a href="#" class="btn btn-dark" title="Reset password" data-bs-toggle="modal" data-bs-target="#modal-password-{{ $user->id }}">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <circle cx="8" cy="15" r="4"></circle>
                                <line x1="10.85" y1="12.15" x2="19" y2="4"></line>
                                <line x1="18" y1="5" x2="20" y2="7"></line>
                                <line x1="15" y1="8" x2="17" y2="10"></line>
                              </svg>
                            </a>
                            <form action="{{ route('admin.users.ban', ['user' => $user->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @if(!$user->isBanned())
                            <button class="btn btn-danger" title="Ban">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <rect x="5" y="11" width="14" height="10" rx="2"></rect>
                                <circle cx="12" cy="16" r="1"></circle>
                                <path d="M8 11v-4a4 4 0 0 1 8 0v4"></path>
                              </svg>
                            </button>
                            @else
                            <button type="submit" class="btn btn-dark" title="Cancel the ban">
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock-open" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <rect x="5" y="11" width="14" height="10" rx="2"></rect>
                                <circle cx="12" cy="16" r="1"></circle>
                                <path d="M8 11v-5a4 4 0 0 1 8 0"></path>
                              </svg>
                            </button>
                            @endif
                            </form>
                        </td>
                    </tr>

                    @include('admin.users.modals.reset-password', ['user' => $user])
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