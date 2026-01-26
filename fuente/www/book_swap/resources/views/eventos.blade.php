@extends('layouts.app')

@section('titulo', 'Eventos')

@push('estilos')
<link rel="stylesheet" href="{{ asset('css/app-autenticado.css') }}">
@endpush

@section('header')
    <x-header mostrarPerfil="true"/>
@endsection

@section('main')

<div class="container py-4">

    <div class="mb-8">
        <h2 class="text-xl fw-bold mb-4">Eventos culturales</h2>
        <p class="text mt-2">Conecta con la cultura: encuentros, charlas y actividades que te inspiran a seguir leyendo.</p>
        <p class="text mt-2">Filtra los eventos por tipo para encontrar justo lo que te interesa.</p>
    </div>
    

   @livewire('catalogo-eventos')

</div>

<x-nav-inferior />

@endsection

@section('footer')
    <x-footer />
@endsection
