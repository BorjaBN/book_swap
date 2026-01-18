@extends('layouts.app')

@section('titulo')

@section('header')
 <x-header :mostrarNav="true"/>
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
