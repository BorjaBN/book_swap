@extends('layouts.app')

@section('titulo', 'Inicio')

@push('estilos')
    {{-- Carga el CSS de autenticados con header/footer verde --}}
    <link rel="stylesheet" href="{{ asset('css/app-autenticado.css') }}">
@endpush

@section('header')
    <x-header :mostrarBienvenida="false" :mostrarCreditos="false" :mostrarCerrarSesion="true"/>
@endsection

@section('main')
<div class="container py-4">

    <div class="mb-5">
        <h2>Panel de {{ Auth::guard('entidad')->user()->nombre_entidad_cultural }}</h2>
        <p>Revisa y organiza tus actividades culturales desde este panel: cada evento que creas es una semilla que hace florecer la vida cultural de la ciudad.</p>
    </div>

    <hr class="my-2">

    <h3 class="fw-bold mt-4">Tus eventos</h3>

    @if($eventos->count() > 0)
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-2 row-cols-xl-3 g-4">
            @foreach($eventos as $evento)
                <x-tarjeta-mostrar 
                    :elem="$evento"
                    tipo="evento"
                    :dobleTarjeta="false"
                    :mostrarImagen="false"
                />
            @endforeach
        </div>
    @else
        <div class="p-5 text-center">
            <p class="text-muted fst-italic p-2">
                Aún no has creado ningún evento. Puedes hacerlo fácilmente desde el botón "Añadir" que aparece abajo.
            </p>
        </div>
    @endif

</div>

<x-nav-inferior />
@endsection

@section('footer')
    <x-footer />
@endsection
