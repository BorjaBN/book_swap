@extends('layouts.app')

@section('main')
<div class="container py-4">
    <h2>Hola {{ Auth::user()->nombre_usuario_comun }}</h2>

    <h3 class="mt-4">Novedades en Eventos</h3>
    @foreach($eventos as $evento)
        <p>{{ $evento->titulo }}</p>
    @endforeach

    <h3 class="mt-4">Nocvedades en libros</h3>
    @foreach($libros as $libro)
        <p>{{ $libro->titulo }}</p>
    @endforeach
</div>
@endsection
