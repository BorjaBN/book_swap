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

    <div class="mb-8">
        <h2 class="text-xl fw-bold mb-4">Catálogo de libros</h2>
        <p class="text mt-2">Explora libros para intercambiar con otros lectores. Cada intercambio es una nueva aventura.</p>
        <p class="text mt-2">¿Buscas algo concreto? Puedes buscar por el título del libro en nuestro catálogo, seguro que tenemos lo que estás buscando.</p>
        <div class="col">
    </div>
    

    @livewire('catalogo-libros')

</div>

<x-nav-inferior />

@endsection

@section('footer')
    <x-footer />
@endsection