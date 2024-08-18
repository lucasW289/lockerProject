@extends('layouts.app')

@section('title', 'Check Status')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/sepa-steps.css') }}">
@endsection

@section('content')
    @livewire('user-check-status')
@endsection
