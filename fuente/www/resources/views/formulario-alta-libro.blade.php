@extends('layouts.app')

@section('titulo', 'Registrar libro')

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
        href="{{url()->previous()}}"
        variant="btn-secondary m-3 d-inline-flex align-items-center gap-2"
    >
        <i class="bi bi-arrow-left"></i>
    </x-button>


    <x-base-formulario titulo="Registrar nuevo libro">
        <form 
            action="{{ route('libros.store') }}" 
            method="POST" 
            enctype="multipart/form-data"
        >
            @csrf

            
            <x-input 
                label="Título del libro" 
                name="titulo_libro" 
                :value="old('titulo_libro')"
                required
            />

            
            <x-input 
                label="Autor" 
                name="autor_libro" 
                :value="old('autor_libro')"
                required
            />

            
            <x-input 
                label="ISBN" 
                name="ISBN" 
                :value="old('ISBN')"
                required
            />

            
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

            
            <x-input 
                label="Género" 
                name="genero_libro" 
                :value="old('genero_libro')"
            />

            
            <x-input 
                label="Fecha de publicación" 
                name="fecha_publicacion_libro" 
                type="date"
                :value="old('fecha_publicacion_libro')"
                required
            />

            
            <x-file 
                label="Foto del libro"
                name="imagen_libro"
                required
            />


            <x-button 
                type="submit"
                variant="btn-primary mt-3"
            >
                Registrar libro
            </x-button>

        </form>

    </x-base-formulario>

@endsection

@section('footer')
    <x-footer />
@endsection