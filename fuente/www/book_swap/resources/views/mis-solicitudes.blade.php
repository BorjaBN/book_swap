@extends('layouts.app')

@section('titulo', 'Solicitudes de intercambio')

@push('estilos')
<link rel="stylesheet" href="{{ asset('css/app-autenticado.css') }}">
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
<div class="container py-4">

    <h2 class="mb-4">Solicitudes de intercambio</h2>

    {{-- ============================
         SOLICITUDES RECIBIDAS
    ============================= --}}
    <h4 class="mb-3">Solicitudes recibidas</h4>

    @forelse($recibidas as $solicitud)
        <div class="card mb-3 p-3">

            {{-- Libro solicitado --}}
            <h5 class="mb-2">
                {{ $solicitud->libro->titulo_libro }}
            </h5>

            {{-- Solicitante --}}
            <p class="mb-1">
                <strong>Solicitante:</strong> 
                {{ $solicitud->solicitante->nombre_usuario_comun }}
            </p>

            {{-- Libro ofrecido --}}
            @if($solicitud->libroOfrecido)
                <p class="mb-1">
                    <strong>Libro ofrecido a cambio:</strong>
                    {{ $solicitud->libroOfrecido->titulo_libro }}
                </p>
            @else
                <p class="mb-1 text-muted">
                    <strong>Libro ofrecido:</strong> Ninguno
                </p>
            @endif

            {{-- Estado --}}
            <p class="mb-2">
                <strong>Estado:</strong>
                @if($solicitud->estado === 'pendiente')
                    <span class="text-warning">Pendiente</span>
                @elseif($solicitud->estado === 'aceptado')
                    <span class="text-success">Aceptado</span>
                @else
                    <span class="text-danger">Rechazado</span>
                @endif
            </p>

            {{-- CONTACTO cuando está aceptado --}}
            @if($solicitud->estado === 'aceptado')
                <div class="alert alert-info py-2 px-3 mb-2">
                    <strong>Intercambio aceptado</strong><br>
                    Podéis contactar entre vosotros aquí:<br>

                    <span class="d-block mt-1">
                        <strong>Solicitante:</strong> {{ $solicitud->solicitante->email }}
                    </span>

                    <span class="d-block">
                        <strong>Propietario:</strong> {{ $solicitud->propietario->email }}
                    </span>
                </div>
            @endif

            {{-- Botones solo si está pendiente --}}
            @if($solicitud->estado === 'pendiente')
                <div class="d-flex gap-2 mt-2">
                    <form method="POST" action="{{ route('intercambios.aceptar', $solicitud) }}">
                        @csrf
                        <x-button type="submit" variant="btn-success btn-sm">Aceptar</x-button>
                    </form>

                    <form method="POST" action="{{ route('intercambios.rechazar', $solicitud) }}">
                        @csrf
                        <x-button type="submit" variant="btn-outline-danger btn-sm">Rechazar</x-button>
                    </form>
                </div>
            @endif

        </div>
    @empty
        <p class="text-muted">No tienes solicitudes recibidas.</p>
    @endforelse



    {{-- ============================
         SOLICITUDES ENVIADAS
    ============================= --}}
    <h4 class="mt-5 mb-3">Solicitudes enviadas</h4>

    @forelse($enviadas as $solicitud)
        <div class="card mb-3 p-3">

            {{-- Libro solicitado --}}
            <h5 class="mb-2">
                {{ $solicitud->libro->titulo_libro }}
            </h5>

            {{-- Propietario --}}
            <p class="mb-1">
                <strong>Propietario:</strong> 
                {{ $solicitud->propietario->nombre_usuario_comun }}
            </p>

            {{-- Libro ofrecido --}}
            @if($solicitud->libroOfrecido)
                <p class="mb-1">
                    <strong>Libro ofrecido a cambio:</strong>
                    {{ $solicitud->libroOfrecido->titulo_libro }}
                </p>
            @else
                <p class="mb-1 text-muted">
                    <strong>Libro ofrecido:</strong> Ninguno
                </p>
            @endif

            {{-- Estado --}}
            <p class="text-muted mb-1">
                <strong>Estado:</strong>
                @if($solicitud->estado === 'pendiente')
                    <span class="text-warning">Pendiente</span>
                @elseif($solicitud->estado === 'aceptado')
                    <span class="text-success">Aceptado</span>
                @else
                    <span class="text-danger">Rechazado</span>
                @endif
            </p>

            {{-- CONTACTO cuando está aceptado --}}
            @if($solicitud->estado === 'aceptado')
                <div class="alert alert-info py-2 px-3 mb-2">
                    <strong>Intercambio aceptado</strong><br>
                    Podéis contactar entre vosotros aquí:<br>

                    <span class="d-block mt-1">
                        <strong>Propietario:</strong> {{ $solicitud->propietario->email }}
                    </span>

                    <span class="d-block">
                        <strong>Solicitante:</strong> {{ $solicitud->solicitante->email }}
                    </span>
                </div>
            @endif

        </div>
    @empty
        <p class="text-muted">No has enviado solicitudes.</p>
    @endforelse

</div>

<x-nav-inferior />
@endsection

@section('footer')
    <x-footer />
@endsection
