@extends('layouts.dashboard')

@section('title')
    {{ ucfirst($title) }}
@endsection

@section('content')
    @include('partials.dashboard.notifications')
@endsection