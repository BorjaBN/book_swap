@extends('layouts.app')

@section('titulo', 'Editar libro')

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
        href="{{url()->previous()}}"
        variant="btn-secondary m-3 d-inline-flex align-items-center gap-2"
    >
        <i class="bi bi-arrow-left"></i>
    </x-button>

    <x-base-formulario titulo="Editar libro">
        <form 
            action="{{ route('libros.update', $libro->id_libro) }}" 
            method="POST" 
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

        
            <x-input 
                label="Título del libro" 
                name="titulo_libro" 
                :value="old('titulo_libro', $libro->titulo_libro)"
            />

            
            <x-input 
                label="Autor" 
                name="autor_libro" 
                :value="old('autor_libro', $libro->autor_libro)"
            />

            
            <x-input 
                label="ISBN" 
                name="ISBN" 
                :value="old('ISBN', $libro->ISBN)"
            />

            
            <x-select 
                label="Estado"
                name="estado_libro"
                :options="[
                    'nuevo' => 'Nuevo',
                    'seminuevo' => 'Seminuevo',
                    'usado' => 'Usado'
                ]"
                :value="old('estado_libro', $libro->estado_libro)"
            />

            
            <x-input 
                label="Género" 
                name="genero_libro" 
                :value="old('genero_libro', $libro->genero_libro)"
            />

            
            <x-input 
                label="Fecha de publicación" 
                name="fecha_publicacion_libro" 
                type="date"
                :value="old('fecha_publicacion_libro', $libro->fecha_publicacion_libro->format('Y-m-d'))"
            />

           
            <x-file 
                label="Foto del libro"
                name="imagen_libro"
            />

            {{-- Botón --}}
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
