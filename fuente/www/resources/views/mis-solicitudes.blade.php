@extends('layouts.app')

@section('titulo', 'Solicitudes de intercambio')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
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

<div class="mb-8">
    <h2 class="text-xl fw-bold mb-4">Solicitudes de intercambio</h2>

    <p class="text mt-2">
        Aquí puedes ver todas las solicitudes que has recibido y enviado. Gestiona cada una según tu disponibilidad y decide si quieres aceptar o rechazar el intercambio.
    </p>

</div>

<br>

    <h3 class="mb-3">Solicitudes recibidas</h3>

    @forelse($recibidas as $solicitud)
        <div class="card mb-3 p-3">

            
            <h5 class="fw-bold titulo-libro text-truncate mb-2">
                {{ $solicitud->libro->titulo_libro }}
            </h5>

            
            <p class="mb-1">
                <strong>Solicitante:</strong> 
                {{ $solicitud->solicitante->nombre_usuario_comun }},  {{ $solicitud->solicitante->ciudad_usuario_comun }}
            </p>

            
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

            
            @if($solicitud->estado === 'aceptado')
                <div class="alert alert-success py-2 px-3 mb-2">
                    <strong>Intercambio aceptado</strong><br>
                    Podéis contactar entre vosotros aquí:<br>

                    <span class="d-block mt-1">
                        <strong>Solicitante:</strong> {{ $solicitud->solicitante->email_usuario_comun }}
                    </span>

                    <span class="d-block">
                        <strong>Propietario:</strong> {{ $solicitud->propietario->email_usuario_comun }}
                    </span>
                </div>
            @endif

            
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




    <hr>
    <h3 class="mt-5 mb-3">Solicitudes enviadas</h3>

    @forelse($enviadas as $solicitud)
        <div class="card mb-3 p-3">

            
            <h5 class="mb-2">
                {{ $solicitud->libro->titulo_libro }}
            </h5>

            
            <p class="mb-1">
                <strong>Propietario:</strong> 
                {{ $solicitud->propietario->nombre_usuario_comun }}, {{ $solicitud->propietario->ciudad_usuario_comun }}
            </p>

            
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

            
            <p class="text mb-1">
                <strong>Estado:</strong>
                @if($solicitud->estado === 'pendiente')
                    <span class="text-secondary fw-bold">Pendiente</span>
                @elseif($solicitud->estado === 'aceptado')
                    <span class="text-success fw-bold">Aceptado</span>
                @else
                    <span class="text-danger fw-bold">Rechazado</span>
                @endif
            </p>

            
            @if($solicitud->estado === 'aceptado')
                <div class="alert alert-success py-2 px-3 mb-2">
                    <strong>Intercambio aceptado</strong><br>
                    Podéis contactar entre vosotros aquí:<br>

                    <span class="d-block mt-1">
                        <strong>Propietario:</strong> {{ $solicitud->propietario->email_usuario_comun }}
                    </span>

                    <span class="d-block">
                        <strong>Solicitante:</strong> {{ $solicitud->solicitante->email_usuario_comun }}
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
