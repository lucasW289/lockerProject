@extends('layouts.app')

@section('title', 'Register')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/register-style.css') }}">
@endsection

@section('content')
    @livewire('register')
@endsection
