@extends('layouts.app')

@section('titulo', 'Registro')

@push('estilos')
    {{-- Carga el CSS público con fondo de imagen --}}
    <link rel="stylesheet" href="{{ asset('css/app-publico.css') }}">
@endpush

@section('header')
 <x-header :mostrarNav="false"/>
@endsection

@section('main')



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
