@extends('layouts.app')

@section('main')
<div class="container py-4">
    <h2>Panel de {{ Auth::guard('entidad')->user()->nombre_entidad_cultural }}</h2>

    <h3 class="mt-4">Tus eventos</h3>
    @foreach($eventos as $evento)
        <p>{{ $evento->titulo }}</p>
    @endforeach
</div>
@endsection
