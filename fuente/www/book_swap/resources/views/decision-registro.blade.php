@extends('layouts.app')

@section('titulo', 'Registro')

@section('header')
 <x-header :mostrarNav="false"/>
@endsection

@section('main')
    <x-hero
        titulo="Usuario Común"
        subtitulo="Los usuarios comunes intercambian libros con otros usuarios de la plataforma y pueden informarse sobre eventos culturales a nivel nacional."
        textoBoton="Registrarse como Usuario común"
        hrefBoton="{{ route('registroUComun') }}"
    />
    <x-hero
        titulo="Entidad cultural"
        subtitulo="Las entidades culturales publicitan los eventos que organizan para atraer al público lector y fomentar la cultura."
        textoBoton="Registrarse como Entidad cultural"
        hrefBoton="{{ route('registroECultural') }}"
    />
@endsection

@section('footer')
  <x-footer />
@endsection
