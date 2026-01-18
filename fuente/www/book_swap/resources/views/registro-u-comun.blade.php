@extends('layouts.app')

@section('titulo', 'Registro de usuario común')

@section('header')
    <x-header :mostrarNav="false" />
@endsection

@section('main')

    <x-tarjeta-formulario titulo="Registro de usuario común">

        <form action="{{ route('registroUComun.store') }}" method="POST">
            @csrf

            <x-input 
                label="Nombre"
                name="nombre"
                type="text"
                required
            />

            <x-input 
                label="Apellidos"
                name="apellidos"
                type="text"
                required
            />

            <x-input 
                label="Correo electrónico"
                name="email"
                type="email"
                required
            />

            <x-input 
                label="Contraseña"
                name="password"
                type="password"
                required
            />

            <x-input 
                label="Teléfono"
                name="telefono"
                type="tel"
                required
            />

            <x-input 
                label="Ciudad"
                name="ciudad"
                type="text"
                required
            />


            <x-button 
                type="submit"
                variant="btn-custom btn-registrarse mt-3"
            >
                Registrarse
            </x-button>

        </form>

    </x-tarjeta-formulario>


@endsection

@section('footer')
    <x-footer />
@endsection
