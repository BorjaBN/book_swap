@extends('layouts.app')

@section('titulo', 'Perfil')


@push('estilos')
<link rel="stylesheet" href="{{ asset('css/app-autenticado.css') }}">
@endpush

@section('header')
    <x-header :mostrarBienvenida="false" :mostrarCreditos="false" :mostrarCerrarSesion="true"/>
@endsection


@section('main')
<div class="row justify-content-center m-4 position-relative">

    <div class="col-lg-8">
    <div class="perfil-card">
        <div class="p-4 position-relative">

            {{-- Nombre completo --}}
            <h2 class="text-center mb-3">
                {{ $entidad->nombre_entidad_cultural }}
            </h2>

            {{-- Información del usuario --}}
            <div class="row">
                <div class="col-md-6">

                    {{-- Email --}}
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-envelope me-1"></i> Email
                        </div>
                        <div class="info-value">
                            {{ $entidad->email_entidad_cultural ?? 'No disponible' }}
                        </div>
                    </div>

                    {{-- Teléfono --}}
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-telephone me-1"></i> Teléfono
                        </div>
                        <div class="info-value">
                            {{ $entidad->telefono_entidad_cultural ?? 'No disponible' }}
                        </div>
                    </div>

                    {{-- Web --}}
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-globe me-1"></i> Web
                        </div>
                        <div class="info-value">
                            @if ($entidad->web_entidad_cultural)
                                <a href="{{ $entidad->web_entidad_cultural }}" target="_blank">
                                    {{ $entidad->web_entidad_cultural }}
                                </a>
                            @else
                                No disponible
                            @endif
                        </div>
                    </div>

                </div>

                <div class="col-md-6">

                    {{-- Ciudad --}}
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-geo-alt me-1"></i> Ciudad
                        </div>
                        <div class="info-value">
                            {{ $entidad->ciudad_entidad_cultural ?? 'No disponible' }}
                        </div>
                    </div>

                    {{-- Miembro desde --}}
                    <div class="info-item">
                        <div class="info-label">
                            <i class="bi bi-calendar me-1"></i> Miembro desde
                        </div>
                        <div class="info-value">
                            {{ $entidad->created_at->format('d/m/Y') }}
                        </div>
                    </div>

                </div>
            </div>

            
            <br>
            {{-- Botones de acciones --}}
                <div class="d-flex gap-2 mt-4">

                    {{-- Editar --}}
                    <x-button
                        href="{{ route('usuarioComun.edit', $entidad->id_entidad_cultural)}}"
                        variant="btn-outline-edit btn-sm w-100"
                    >
                        <i class="bi bi-pen fs-6 me-2"></i> Editar perfil
                    </x-button>

                    {{-- Eliminar --}}
                    <form 
                        method="POST" 
                        action="{{ route('usuarioComun.destroy', $entidad->id_entidad_cultural) }}"
                        class="w-100"
                    >
                        @csrf
                        @method('DELETE')

                        <x-button 
                            type="button"
                            variant="btn-outline-danger btn-sm w-100"
                            onclick="abrirModal('modal-pregunta-usuario-{{ $entidad->id_entidad_cultural }}')"
                        >
                            <i class="bi bi-trash3 fs-6 me-2"></i> Eliminar perfil
                        </x-button>
                    </form>
                    <x-modal-pregunta
                        id="modal-pregunta-entidad-{{ $entidad->id_entidad_cultural }}"
                        titulo="Confirmar borrado"
                        mensaje="¿Seguro que quieres eliminar tu perfil?"
                        textoCancelar="Cancelar"
                        textoAceptar="Sí, borrar"
                        accionAceptar="{{ route('usuarioComun.destroy', $entidad->id_entidad_cultural) }}"
                    />

                </div>

        </div>
    </div>
</div>



            
<x-nav-inferior />
@endsection

@section('footer')
    <x-footer />
@endsection
