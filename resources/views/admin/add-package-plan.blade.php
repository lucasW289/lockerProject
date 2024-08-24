@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user-dashboard-style.css') }}">
@endsection

@section('content')
    @livewire('add-package-plan')
@endsection
