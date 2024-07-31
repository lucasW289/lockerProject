@extends('layouts.app')

@section('title', 'Login')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/register-style.css') }}">
@endsection

@section('content')
    @livewire('login')
@endsection
