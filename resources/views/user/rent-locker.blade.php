@extends('layouts.app')

@section('title', 'RentLocker')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/rent-locker-style.css') }}">
@endsection

@section('content')
    @livewire('rent-locker')
@endsection
