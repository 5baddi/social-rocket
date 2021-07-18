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
          <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
                </span>
                <span class="nav-link-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item dropdown {{ request()->routeIs('dashboard.customize') ? 'active' : '' }}">
            <a class="nav-link dropdown-toggle" href="{{ route('dashboard.customize') }}" aria-expanded="false">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-adjustments-horizontal" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="14" cy="6" r="2"></circle>
                        <line x1="4" y1="6" x2="12" y2="6"></line>
                        <line x1="16" y1="6" x2="20" y2="6"></line>
                        <circle cx="8" cy="12" r="2"></circle>
                        <line x1="4" y1="12" x2="6" y2="12"></line>
                        <line x1="10" y1="12" x2="20" y2="12"></line>
                        <circle cx="17" cy="18" r="2"></circle>
                        <line x1="4" y1="18" x2="15" y2="18"></line>
                        <line x1="19" y1="18" x2="20" y2="18"></line>
                    </svg>
                </span>
                <span class="nav-link-title">Customize</span>
            </a>
            <div class="dropdown-menu {{ (request()->routeIs('dashboard.customize') || request()->routeIs('dashboard.customize.*')) ? 'show' : '' }}">
              <div class="dropdown-menu-columns">
                <div class="dropdown-menu-column">
                  <a class="dropdown-item {{ request()->routeIs('dashboard.customize.integrations') ? 'active' : '' }}" href="{{ route('dashboard.customize.integrations') }}">Integrations</a>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item {{ request()->routeIs('dashboard.payouts') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.payouts') }}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-coin" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                        <path d="M14.8 9a2 2 0 0 0 -1.8 -1h-2a2 2 0 0 0 0 4h2a2 2 0 0 1 0 4h-2a2 2 0 0 1 -1.8 -1"></path>
                        <path d="M12 6v2m0 8v2"></path>
                    </svg>
                </span>
                <span class="nav-link-title">Payouts</span>
            </a>
          </li>
          <li class="nav-item {{ request()->routeIs('dashboard.account') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.account') }}">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                  </svg>
                </span>
                <span class="nav-link-title">Account</span>
            </a>
          </li>
          <li class="nav-item {{ request()->routeIs('dashboard.settings') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.settings') }}">
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
          @if (config('rocket.help_url'))
          <li class="nav-item {{ request()->routeIs('dashboard.help') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard.help') }}" target="_blank">
                <span class="nav-link-icon d-md-none d-lg-inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-help" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="12" cy="12" r="9"></circle>
                        <line x1="12" y1="17" x2="12" y2="17.01"></line>
                        <path d="M12 13.5a1.5 1.5 0 0 1 1 -1.5a2.6 2.6 0 1 0 -3 -4"></path>
                    </svg>
                </span>
                <span class="nav-link-title">Help</span>
            </a>
          </li>
          @endif
        </ul>
        <div class="row mb-4">
            <div class="col-12">
                {{-- <img src="{{ asset('assets/img/logo.mini.png') }}"/> --}}
                <div class="col-auto align-self-center mt-3">
                    <a href="{{ route('dashboard.plan.upgrade') }}" class="btn btn-white w-100">
                        Upgrade plan
                    </a>
                </div>
                <div class="col-auto align-self-center mt-1">
                    <a href="mailto:{{ $settings->support_email ?? env('SUPPORT_EMAIL', 'info@clnkgo.com') }}" class="btn btn-white w-100">
                        Contact Us
                    </a>
                </div>
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