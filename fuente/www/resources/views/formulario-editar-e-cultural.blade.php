@extends('layouts.app')

@section('titulo', 'Editar perfil')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/publico.css') }}">
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
        href="{{ url()->previous()}}"
        variant="btn-secondary m-3 d-inline-flex align-items-center gap-2"
    >
        <i class="bi bi-arrow-left"></i>
    </x-button>

    <x-base-formulario titulo="Editar perfil">

        <form action="{{ route('entidad.perfil.update', $entidad->id_entidad_cultural) }}" method="POST">
            @csrf
            @method('PUT')

            
            <x-input 
                label="Nombre de la entidad" 
                name="nombre_entidad_cultural" 
                :value="old('nombre_entidad_cultural', $entidad->nombre_entidad_cultural)"
            />

            
            <x-input 
                label="Teléfono" 
                name="telefono_entidad_cultural" 
                :value="old('telefono_entidad_cultural', $entidad->telefono_entidad_cultural)"
            />

            
            <x-input 
                label="Correo electrónico" 
                name="email_entidad_cultural" 
                type="email"
                :value="old('email_entidad_cultural', $entidad->email_entidad_cultural)"
            />

            
            <x-input 
                label="Dirección" 
                name="direccion_entidad_cultural" 
                :value="old('direccion_entidad_cultural', $entidad->direccion_entidad_cultural)"
            />

            
            <x-input 
                label="Ciudad" 
                name="ciudad_entidad_cultural" 
                :value="old('ciudad_entidad_cultural', $entidad->ciudad_entidad_cultural)"
            />

            
            <x-input 
                label="Página web" 
                name="web_entidad_cultural" 
                :value="old('web_entidad_cultural', $entidad->web_entidad_cultural)"
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
