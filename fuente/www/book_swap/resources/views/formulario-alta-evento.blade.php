@extends('layouts.app')

@section('titulo', 'Crear evento')

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

    {{-- Botón volver --}}
    <x-button 
        href="{{url()->previous()}}"
        variant="btn-secondary m-3 d-inline-flex align-items-center gap-2"
    >
        <i class="bi bi-arrow-left"></i>
    </x-button>

    {{-- Formulario base --}}
    <x-base-formulario titulo="Crear nuevo evento">

        <form 
            action="{{ route('entidad.eventos.store') }}" 
            method="POST"
        >
            @csrf

            {{-- Nombre del evento --}}
            <x-input 
                label="Nombre del evento" 
                name="nombre_evento" 
                :value="old('nombre_evento')"
                required
            />

            {{-- Fecha del evento --}}
            <x-input 
                label="Fecha del evento" 
                name="fecha_evento" 
                type="date"
                :value="old('fecha_evento')"
                required
            />

            {{-- Descripción --}}
            <x-input 
                label="Descripción del evento" 
                name="descripcion_evento" 
                type="textarea"
                :value="old('descripcion_evento')"
                required
            />

            {{-- Ubicación --}}
            <x-input 
                label="Ubicación" 
                name="ubicacion_evento" 
                :value="old('ubicacion_evento')"
                required
            />

            {{-- Tipo de evento --}}
            <x-select 
                label="Tipo de evento"
                name="tipo_evento"
                :options="[
                    'encuentro con autor/a' => 'Encuentro con autor/a',
                    'club de lectura' => 'Club de lectura',
                    'feria del libro' => 'Feria del libro'
                ]"
                required
            />

            {{-- Botón --}}
            <x-button 
                type="submit"
                variant="btn-primary mt-3"
            >
                Crear evento
            </x-button>

        </form>

    </x-base-formulario>

@endsection

@section('footer')
    <x-footer />
@endsection
