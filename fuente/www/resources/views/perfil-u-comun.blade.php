@extends('layouts.app')

@section('titulo', 'Perfil')

@push('estilos')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endpush

@section('header')
    <x-header :mostrarBienvenida="false" :mostrarCreditos="true" :mostrarCerrarSesion="true" mostrarPerfil="true"/>
@endsection


@section('main')
<div class="row justify-content-center m-4 position-relative">

<div class="col-lg-8">
    <div class="perfil-card">
        <div class="p-4 position-relative">

            <h2 class="text-center mb-3">
                {{ $usuario->nombre_usuario_comun }} {{ $usuario->apellidos_usuario_comun }}
            </h2>

            <div class="row">
                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-envelope me-1"></i> Email
                        </div>
                        <div class="info-value">{{ $usuario->email_usuario_comun }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-telephone me-1"></i> Teléfono
                        </div>
                        <div class="info-value">{{ $usuario->telefono_usuario_comun }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-geo-alt me-1"></i> Ciudad
                        </div>
                        <div class="info-value">{{ $usuario->ciudad_usuario_comun }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-calendar me-1"></i> Miembro desde
                        </div>
                        <div class="info-value">{{ $usuario->created_at->format('d/m/Y') }}</div>
                    </div>
                </div>
            </div>

                <div class="d-flex gap-2 mt-4">

                    <x-button
                        href="{{ route('usuarioComun.edit', $usuario->id_usuario_comun)}}"
                        variant="btn-outline-edit btn-sm w-100"
                    >
                        <i class="bi bi-pen fs-6 me-2"></i> Editar perfil
                    </x-button>

                    <form 
                        method="POST" 
                        action="{{ route('usuarioComun.destroy', $usuario->id_usuario_comun) }}"
                        class="w-100"
                    >
                        @csrf
                        @method('DELETE')

                        <x-button 
                            type="button"
                            variant="btn-outline-danger btn-sm w-100"
                            onclick="abrirModal('modal-pregunta-usuario-{{ $usuario->id_usuario_comun }}')"
                        >
                            <i class="bi bi-trash3 fs-6 me-2"></i> Eliminar perfil
                        </x-button>
                    </form>
                    <x-modal-pregunta
                        id="modal-pregunta-usuario-{{ $usuario->id_usuario_comun }}"
                        titulo="Eliminar perfil"
                        mensaje="Esta acción es irreversible. Se eliminarán todos tus datos, libros publicados, historial de intercambios y créditos acumulados."
                        textoCancelar="Cancelar"
                        textoAceptar="Sí, borrar"
                        accionAceptar="{{ route('usuarioComun.destroy', $usuario->id_usuario_comun) }}"
                    />
            </div>
        </div>
    </div>
</div>


    <div class="seccion-libros">
        <div class="row mb-4">
            <div class="col">
                <h3>Mis Libros</h3>
                <p class="text-muted">Libros que has publicado en BookSwap</p>
            </div>
        </div>

        @if($usuario->libros && $usuario->libros->count() > 0)
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            @foreach($usuario->libros as $libro)
             <div class="col">
                        <x-tarjeta-mostrar 
                            :elem="$libro"
                            tipo="libro"
                            :dobleTarjeta="true"
                            :mostrarImagen="true"
                        />
                    </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <i class="bi bi-book"></i>
            <h3>No has publicado libros aún</h3>
            <p>Comienza a compartir tus libros con la comunidad BookSwap</p>
        </div>
        @endif
    </div>
</div>


            
<x-nav-inferior />
@endsection

@section('footer')
    <x-footer />
@endsection
