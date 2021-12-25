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
                  <th>Slug</th>
                  <th>Title</th>
                  <th>Published at</th>
                  <th>Updated at</th>
                  <th></th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    @include('partials.dashboard.scripts.form')
@endsection