@extends('layouts.app')

@section('titulo', 'Registro de usuario común')

@section('header')
    <x-header :mostrarNav="false" />
@endsection

@section('main')

    <x-tarjeta-formulario :titulo="$titulo">

        <form action="{{ route('registrar', ['tipo' => $tipo]) }}" method="POST">
            @csrf

            <input type="hidden" name="tipo_usuario" value="{{ $tipo }}">


            @if($tipo === 'comun')
                {{-- Campos usuario --}}
                <x-input label="Nombre" name="nombre" required />
                <x-input label="Apellidos" name="apellidos" required />
                <x-input label="Correo electrónico" name="email" type="email" required />
                <x-input label="Contraseña" name="clave" type="password" required />
                <x-input label="Teléfono" name="telefono" required />
                <x-input label="Ciudad" name="ciudad" required />
            @endif

            @if($tipo === 'entidad')
                {{-- Campos entidad --}}
                <x-input label="Nombre entidad" name="nombre_entidad" required />
                <x-input label="NIF" name="nif" required />
                <x-input label="Teléfono" name="telefono" required />
                <x-input label="Sitio web" name="web" type="url" />
                <x-input label="Correo electrónico" name="email" type="email" required />
                <x-input label="Contraseña" name="clave" type="password" required />
                <x-input label="Dirección" name="direccion" required />
                <x-input label="Ciudad" name="ciudad" required />
            @endif


            <x-button 
                type="submit"
                variant="btn-custom btn-registrarse mt-3"
            >
                Registrarse en BookSwap
            </x-button>

        </form>

    </x-tarjeta-formulario>


@endsection

@section('footer')
    <x-footer />
@endsection
