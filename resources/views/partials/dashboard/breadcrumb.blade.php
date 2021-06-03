<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
      <div class="row align-items-center">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            &nbsp;
          </div>
          <h2 class="page-title mt-4">
              @yield('title')
          </h2>
          @if (!request()->routeIs('dashboard'))
          <div class="mt-2">
            <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                @foreach (request()->segments() as $key => $segment)
                    @if ($segment === 'dashboard')
                    @continue
                    @endif
                    <li class="breadcrumb-item {{ (sizeof(request()->segments()) - 1) === ($key) ? 'active' : '' }}"><a href="{{ url('dashboard/' . $segment) }}">{{ ucfirst($segment) }}</a></li>
                @endforeach
              </ol>
          </div>
          @endif
        </div>
    </div>
</div>