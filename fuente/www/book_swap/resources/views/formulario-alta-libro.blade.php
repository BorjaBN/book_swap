@extends('layouts.app')

@section('titulo', 'Registrar libro')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/app-publico.css') }}">
@endpush

@section('header')
    <x-header 
        :mostrarBienvenida="false" 
        :mostrarCreditos="false" 
        :mostrarCerrarSesion="true"
    />
@endsection

@section('main')

    <x-button 
        href="{{ route('inicio') }}"
        variant="btn-secondary m-3 d-inline-flex align-items-center gap-2"
    >
        <i class="bi bi-arrow-left"></i>
    </x-button>


    <x-tarjeta-formulario titulo="Registrar nuevo libro">
        <form 
            action="{{ route('darAltaLibro') }}" 
            method="POST" 
            enctype="multipart/form-data"
        >
            @csrf

            {{-- Título --}}
            <x-input 
                label="Título del libro" 
                name="titulo_libro" 
                :value="old('titulo_libro')"
                required
            />

            {{-- Autor --}}
            <x-input 
                label="Autor" 
                name="autor_libro" 
                :value="old('autor_libro')"
                required
            />

            {{-- ISBN --}}
            <x-input 
                label="ISBN" 
                name="ISBN" 
                :value="old('ISBN')"
                required
            />

            {{-- Estado --}}
            <x-select 
                label="Estado"
                name="estado_libro"
                :options="[
                    'nuevo' => 'Nuevo',
                    'seminuevo' => 'Seminuevo',
                    'usado' => 'Usado'
                ]"
                required
            />

            {{-- Género (opcional) --}}
            <x-input 
                label="Género" 
                name="genero_libro" 
                :value="old('genero_libro')"
            />

            {{-- Fecha de publicación --}}
            <x-input 
                label="Fecha de publicación" 
                name="fecha_publicacion_libro" 
                type="date"
                :value="old('fecha_publicacion_libro')"
                required
            />

            {{-- Imagen --}}
            <x-file 
                label="Foto del libro"
                name="imagen_libro"
                required
            />


            {{-- Botón --}}
            <x-button 
                type="submit"
                variant="btn-custom btn-registrarse mt-3"
            >
                Registrar libro
            </x-button>

        </form>

    </x-tarjeta-formulario>

@endsection

@section('footer')
    <x-footer />
@endsection