@extends('layouts.app')

@section('title', 'Login')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login-style.css') }}">
@endsection

@section('content')
    @livewire('login')
@endsection
