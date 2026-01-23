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
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800">
            Hola, {{ Auth:: user()->nombre_usuario_comun }}
        </h2>
        <p class="text-gray-600 mt-2">Aquí tienes las novedades en libros y eventos.</p>
    </div>
    <br><br>
    {{-- Sección de Novedades en Libros --}}
    <section class="mb-12">
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Novedades en Libros</h3>
        
        @if($libros->count() > 0)
        <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-2 row-cols-xl-3 g-4">
            @foreach($libros as $libro)
                <div class="col">
                    <x-tarjeta-mostrar 
                        :elem="$libro"
                        tipo="libro"
                        :dobleTarjeta="true"
                    />
                </div>
            @endforeach
        </div>
        @else
            <div class="bg-gray-50 rounded-lg p-8 text-center">
                <p class="text-gray-500">Aún no hay libros publicados.</p>
            </div>
        @endif
    </section>

    {{-- Sección de Novedades en Eventos --}}
    <section>
        <h3 class="text-2xl font-bold text-gray-800 mb-4">Novedades en Eventos</h3>
        
        @if($eventos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($eventos as $evento)
                    <x-tarjeta-mostrar :elem="$evento" tipo="evento" :dobleTarjeta="false" />
                @endforeach
            </div>
        @else
            <div class="bg-gray-50 rounded-lg p-8 text-center">
                <p class="text-gray-500">Aún no hay eventos publicados.</p>
            </div>
        @endif
    </section>

</div>
<x-nav-inferior />
@endsection



@section('footer')
    <x-footer />
@endsection