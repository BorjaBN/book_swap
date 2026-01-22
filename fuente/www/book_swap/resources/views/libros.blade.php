@extends('layouts.app')

@section('titulo', 'Catálogo de Libros')

@push('estilos')
<link rel="stylesheet" href="{{ asset('css/app-autenticado.css') }}">
@endpush

@section('header')
    <x-header />
@endsection

@section('main')

<div class="container py-4">

    <h2 class="fw-bold mb-4">Catálogo de Libros</h2>

    @livewire('catalogo-libros')

</div>

<x-nav-inferior />

@endsection

@section('footer')
    <x-footer />
@endsection
