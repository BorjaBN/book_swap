@extends('layouts.app')

@section('titulo')

@push('estilos')
    {{-- Carga el CSS público con fondo de imagen --}}
    <link rel="stylesheet" href="{{ asset('css/app-publico.css') }}">
@endpush

@section('header')
 <x-header :mostrarBienvenida="true" :mostrarCreditos="false" :mostrarCerrarSesion="false"/>
@endsection

@section('main')
    <x-hero
        titulo="Te damos la bienvenida a BookSwap"
        subtitulo="Intercambia libros y descubre nuevas historias. <br><br>Publicita tus eventos culturales y promueve el acceso a la cultura para todos los públicos."
        textoBoton="Empezar ahora"
        hrefBoton="{{ route('decisionRegistro') }}"
/>
    />
@endsection

@section('footer')
  <x-footer />
@endsection
