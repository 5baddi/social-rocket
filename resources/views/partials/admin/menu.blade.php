<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
        <span class="navbar-toggler-icon"></span>
      </button>
      <h1 class="navbar-brand navbar-brand-autodark">
        <a href="{{ route('dashboard') }}">
          <img src="{{ asset('assets/img/logo-white.png') }}" width="110" height="32" alt="{{ config('app.name') }}" class="navbar-brand-image"/>
        </a>
      </h1>
      <div class="collapse navbar-collapse" id="navbar-menu">
        <ul class="navbar-nav pt-lg-3">
          <li class="nav-item {{ request()->routeIs('admin') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin') }}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-device-desktop-analytics" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <rect x="3" y="4" width="18" height="12" rx="1"></rect>
                        <path d="M7 20h10"></path>
                        <path d="M9 16v4"></path>
                        <path d="M15 16v4"></path>
                        <path d="M9 12v-4"></path>
                        <path d="M12 12v-1"></path>
                        <path d="M15 12v-2"></path>
                        <path d="M12 12v-1"></path>
                    </svg>
                </span>
                <span class="nav-link-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item {{ request()->routeIs('admin.stores') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.stores') }}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-store" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <line x1="3" y1="21" x2="21" y2="21"></line>
                      <path d="M3 7v1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1m0 1a3 3 0 0 0 6 0v-1h-18l2 -4h14l2 4"></path>
                      <line x1="5" y1="21" x2="5" y2="10.85"></line>
                      <line x1="19" y1="21" x2="19" y2="10.85"></line>
                      <path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4"></path>
                    </svg>
                </span>
                <span class="nav-link-title">Stores</span>
            </a>
          </li>
          <li class="nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.users') }}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                    </svg>
                </span>
                <span class="nav-link-title">Accounts</span>
            </a>
          </li>
          <li class="nav-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.settings') }}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                </span>
                <span class="nav-link-title">Settings</span>
            </a>
          </li>
          @if (config('app.debug'))
          <li class="nav-item {{ request()->routeIs('admin.logs') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.logs') }}" target="_blank">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bug" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 9v-1a3 3 0 0 1 6 0v1"></path>
                    <path d="M8 9h8a6 6 0 0 1 1 3v3a5 5 0 0 1 -10 0v-3a6 6 0 0 1 1 -3"></path>
                    <line x1="3" y1="13" x2="7" y2="13"></line>
                    <line x1="17" y1="13" x2="21" y2="13"></line>
                    <line x1="12" y1="20" x2="12" y2="14"></line>
                    <line x1="4" y1="19" x2="7.35" y2="17"></line>
                    <line x1="20" y1="19" x2="16.65" y2="17"></line>
                    <line x1="4" y1="7" x2="7.75" y2="9.4"></line>
                    <line x1="20" y1="7" x2="16.25" y2="9.4"></line>
                  </svg>
                </span>
                <span class="nav-link-title">Error Logs</span>
            </a>
          </li>
          @endif
        </ul>
        <div class="row mb-4">
            <div class="col-12">
                <img src="{{ asset('assets/img/logo.mini.png') }}"/>
                <div class="col-auto align-self-center mt-1">
                    <a href="{{ route('signout') }}" class="btn btn-white w-100">
                        Logout
                    </a>
                </div>
            </div>
        </div>
      </div>
    </div>
</aside>