@extends('layouts.app')

@section('title', 'Manage Classes')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user-dashboard-style.css') }}">
@endsection

@section('content')
    @livewire('manage-classes')
@endsection
