@extends('layouts.app')

@section('title', 'sepa-steps')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/sepa-steps.css') }}">
@endsection

@section('content')
    @livewire('sepa-steps')
@endsection
