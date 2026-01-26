@extends('layouts.app')

@section('titulo', 'Inicio de sesión')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/publico.css') }}">
@endpush

@section('header')
    <x-header :mostrarBienvenida="false" :mostrarCreditos="false" :mostrarCerrarSesion="false"/>
@endsection

@section('main')


    <x-button 
        href="{{url()->previous()}}"
        variant="btn-secondary m-3 d-inline-flex align-items-center gap-2"
    >
        <i class="bi bi-arrow-left"></i>
    </x-button>

    <x-base-formulario titulo="Iniciar sesión">

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
                variant="btn-primary mt-3"
            >
                Entrar en BookSwap
            </x-button>

        </form>

    </x-base-formulario>

@endsection

@section('footer')
    <x-footer />
@endsection
