@extends('layouts.app')

@section('titulo', 'Inicio')

@push('estilos')
    {{-- Carga el CSS de autenticados con header/footer verde --}}
    <link rel="stylesheet" href="{{ asset('css/app-autenticado.css') }}">
@endpush

@section('header')
    <x-header/>
@endsection

@section('main')
<div class="container py-4">

    {{-- Saludo personalizado --}}
    <div class="mb-5">
        <h2 class="fs-2 fw-bold">
            Hola, {{ Auth::user()->nombre_usuario_comun }}
        </h2>
        <p>Explora las últimas novedades en libros y eventos.</p>
    </div>

    <hr class="my-2">
    {{-- Sección de Novedades en Libros --}}
    <section class="mb-5">
        <h3 class="fs-4 fw-bold mb-4">Novedades en Libros</h3>
        
        @if($libros->count() > 0)
            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-2 row-cols-xl-3 g-4">
                @foreach($libros as $libro)
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
            <div class="p-5 text-center">
                <p class="text-muted fst-italic p-2">Aún no hay libros publicados.</p>
            </div>
        @endif
    </section>

    <hr class="my-2">

    {{-- Sección de Novedades en Eventos --}}
    <section>
        <h3 class="fs-4 fw-bold mb-4">Novedades en Eventos</h3>
        
        @if($eventos->count() > 0)
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                @foreach($eventos as $evento)
                    <div class="col">
                        <x-tarjeta-mostrar 
                            :elem="$evento" 
                            tipo="evento" 
                            :dobleTarjeta="false"
                            :mostrarImagen="false" 
                        />
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-5 text-center">
                <p class="text-muted fst-italic p-2">Aún no hay eventos publicados.</p>
            </div>
        @endif
    </section>

</div>

<x-nav-inferior />
@endsection

@section('footer')
    <x-footer />
@endsection
