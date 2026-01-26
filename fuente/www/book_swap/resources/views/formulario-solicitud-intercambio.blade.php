@extends('layouts.app')

@section('titulo', 'Solicitar intercambio')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/app-publico.css') }}">
@endpush

@section('header')
    <x-header 
        :mostrarBienvenida="false" 
        :mostrarCreditos="true" 
        :mostrarCerrarSesion="true"
        mostrarPerfil="true"
    />
@endsection

@section('main')

    {{-- Botón volver --}}
    <x-button 
        href="{{ url()->previous() }}"
        variant="btn-secondary m-3 d-inline-flex align-items-center gap-2"
    >
        <i class="bi bi-arrow-left"></i>
    </x-button>

    {{-- Formulario --}}
    <x-base-formulario titulo="Solicitar intercambio">

        <form 
            action="{{ route('intercambios.solicitar', $libro) }}" 
            method="POST"
        >
            @csrf

            {{-- Libro que estás solicitando --}}
            <div class="mb-3">
                <p class="fw-semibold mb-1">Libro solicitado:</p>
                <p class="mb-0">
                    {{ $libro->titulo_libro }} — {{ $libro->autor_libro }}
                </p>
                <span class="badge badge-estado badge-morado mt-1">{{ ucfirst($libro->estado_libro) }}</span> <span class="badge badge-estado badge-morado-claro mt-1">{{ $libro->genero_libro }}</span>
            </div>

            {{-- Seleccionar libro ofrecido --}}
            <x-select 
                label="Ofrecer un libro a cambio"
                name="libro_ofrecido_id"
                :options="auth()->user()->libros
                    ->filter(fn($l) => !$l->estaPendienteDeIntercambio())
                    ->pluck('titulo_libro', 'id_libro')
                    ->toArray()"
                placeholder="No ofrecer ninguno"
                required
            />

            {{-- Botón --}}
            <x-button 
                type="submit"
                variant="btn-primary mt-3"
            >
                Enviar solicitud
            </x-button>

        </form>

    </x-base-formulario>

@endsection

@section('footer')
    <x-footer />
@endsection
