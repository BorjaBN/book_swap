@extends('layouts.app')

@section('titulo', 'Registro')

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

    <x-base-formulario :titulo="$titulo">

        <form action="{{ route('registrar', ['tipo' => $tipo]) }}" method="POST">
            @csrf

            <input type="hidden" name="tipo_usuario" value="{{ $tipo }}">


            @if($tipo === 'comun')
                
                <x-input label="Nombre" name="nombre" required />
                <x-input label="Apellidos" name="apellidos" required />
                <x-input label="Correo electrónico" name="email" type="email" required />
                <x-input label="Contraseña" name="password" type="password" required />
                <x-input label="Teléfono" name="telefono" required />
                <x-input label="Ciudad" name="ciudad" required />
            @endif

            @if($tipo === 'entidad')
                
                <x-input label="Nombre entidad" name="nombre_entidad" required />
                <x-input label="Teléfono" name="telefono" required />
                <x-input label="Sitio web" name="web" type="url" />
                <x-input label="Correo electrónico" name="email" type="email" required />
                <x-input label="Contraseña" name="password" type="password" required />
                <x-input label="Dirección" name="direccion" required />
                <x-input label="Ciudad" name="ciudad" required />
            @endif


            <x-button 
                type="submit"
                variant="btn-primary mt-3"
            >
                Registrarse en BookSwap
            </x-button>

        </form>

    </x-base-formulario>


@endsection

@section('footer')
    <x-footer />
@endsection
