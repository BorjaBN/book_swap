@extends('layouts.app')

@section('titulo', 'Registro')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/publico.css') }}">
@endpush

@section('header')
 <x-header  :mostrarCreditos="false" :mostrarCerrarSesion="false"/>
@endsection

@section('main')

    <x-button 
        href="{{route('bienvenida')}}"
        variant="btn-secondary m-3 d-inline-flex align-items-center gap-2"
    >
        <i class="bi bi-arrow-left"></i>
    </x-button>

    <x-hero
        titulo="Usuario Común"
        subtitulo="Los usuarios comunes intercambian libros con otros usuarios de la plataforma y pueden informarse sobre eventos culturales a nivel nacional."
        textoBoton="Registrarse como Usuario común"
        hrefBoton="{{ route('formularioRegistro', ['tipo' => 'comun']) }}"
    />
    <x-hero
        titulo="Entidad cultural"
        subtitulo="Las entidades culturales publicitan los eventos que organizan para atraer al público lector y fomentar la cultura."
        textoBoton="Registrarse como Entidad cultural"
        hrefBoton="{{ route('formularioRegistro', ['tipo' => 'entidad']) }}"
    />
@endsection

@section('footer')
  <x-footer />
@endsection
