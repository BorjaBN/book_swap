@extends('layouts.app')

@push('estilos')
    {{-- Carga el CSS de autenticados con header/footer verde --}}
    <link rel="stylesheet" href="{{ asset('css/app-autenticado. css') }}">
@endpush

@section('main')
<div class="container py-4">
    <h2>Panel de {{ Auth::guard('entidad')->user()->nombre_entidad_cultural }}</h2>

    <h3 class="mt-4">Tus eventos</h3>
    @foreach($eventos as $evento)
        <p>{{ $evento->titulo }}</p>
    @endforeach
</div>
@endsection
