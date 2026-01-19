@extends('layouts.app')

@section('titulo', 'Inicio de sesión')

@push('estilos')
    {{-- Carga el CSS público con fondo de imagen --}}
    <link rel="stylesheet" href="{{ asset('css/app-publico.css') }}">
@endpush

@section('header')
    <x-header :mostrarNav="false" />
@endsection

@section('main')

    <x-tarjeta-formulario titulo="Iniciar sesión">

        <form action="{{ route('iniciarSesion') }}" method="POST">
            @csrf

            <x-input 
                label="Correo electrónico" 
                name="email" 
                type="email" 
                 
            />

            <x-input 
                label="Contraseña" 
                name="password" 
                type="password" 
             
            />

            <x-button 
                type="submit"
                variant="btn-custom btn-registrarse mt-3"
            >
                Entrar en BookSwap
            </x-button>

        </form>

    </x-tarjeta-formulario>

@endsection

@section('footer')
    <x-footer />
@endsection
