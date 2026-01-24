@props([
    'titulo' => null,
])

<div class="formulario-tarjeta">

    @if($titulo)
        <h2 class="mb-4 text-center">{{ $titulo }}</h2>
    @endif

    {{ $slot }}

</div>