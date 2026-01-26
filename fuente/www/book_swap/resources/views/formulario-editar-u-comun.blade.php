@extends('layouts.app')

@section('titulo', 'Editar perfil')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/app-publico.css') }}">
@endpush

@section('header')
    <x-header 
        :mostrarBienvenida="false" 
        :mostrarCreditos="false" 
        :mostrarCerrarSesion="false"
    />
@endsection

@section('main')

    <x-button 
        href="{{ url()->previous() }}"
        variant="btn-secondary m-3 d-inline-flex align-items-center gap-2"
    >
        <i class="bi bi-arrow-left"></i>
    </x-button>

    <x-base-formulario titulo="Editar perfil">

       <form action="{{ route('usuarioComun.update', $usuario->id_usuario_comun) }}" method="POST">
            @csrf
            @method('PUT')



            <x-input 
                label="Nombre" 
                name="nombre_usuario_comun" 
                :value="old('nombre_usuario_comun', $usuario->nombre_usuario_comun)"
            />

            <x-input 
                label="Apellidos" 
                name="apellidos_usuario_comun" 
                :value="old('apellidos_usuario_comun', $usuario->apellidos_usuario_comun)"
            />

            <x-input 
                label="Correo electrónico" 
                name="email_usuario_comun" 
                type="email"
                :value="old('email_usuario_comun', $usuario->email_usuario_comun)"
            />

            <x-input 
                label="Teléfono" 
                name="telefono_usuario_comun" 
                :value="old('telefono_usuario_comun', $usuario->telefono_usuario_comun)"
            />

            <x-input 
                label="Ciudad" 
                name="ciudad_usuario_comun" 
                :value="old('ciudad_usuario_comun', $usuario->ciudad_usuario_comun)"
            />

            <x-button 
                type="submit"
                variant="btn-primary mt-3"
            >
                Guardar cambios
            </x-button>

        </form>

    </x-base-formulario>

@endsection

@section('footer')
    <x-footer />
@endsection
