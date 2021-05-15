@extends('layouts.dashboard')

@section('title')
    {{ strtoupper($title) }}
@endsection

@section('content')
    @include('partials.dashboard.notifications')
@endsection