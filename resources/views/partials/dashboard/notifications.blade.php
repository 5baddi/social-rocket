<div class="container-xl">
    <div class="row justify-content-center">
      <div class="col-8">
        <div class="card">
          <div class="card-body">
            <div class="divide-y">
                @foreach ($notifications as $notification)
                <div>
                    <div class="row">
                        <div class="col">
                            <div class="text-truncate">
                                {{ $notification->data['subject'] }}
                            </div>
                            <div class="text-muted">{{ $notification->created_at->diffForHumans() }}</div>
                        </div>
                        @if (is_null($notification->read_at))
                        <div class="col-auto align-self-center">
                            <a href="{{ route('dashboard.activity.read', ['notification' => $notification->id]) }}" class="btn btn-ghost-dark w-100">
                                Mark as read 
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>