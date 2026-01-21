<section class="hero">
    <div class="hero-content d-flex flex-column align-items-center">

        {{-- Logo centrado --}}
        <img src="{{ asset('img/logo_oscuro.png') }}" class="img-fluid logo" alt="Logo BookSwap">

        {{-- Título --}}
        @if($titulo)
            <h1 class="hero-title">{{ $titulo }}</h1>
        @endif

        {{-- Subtítulo --}}
        @if($subtitulo)
            <p class="hero-subtitle">{!! $subtitulo !!}</p>
        @endif

        {{-- Botón --}}
        @if($textoBoton && $hrefBoton)
            <x-button 
                href="{{ $hrefBoton }}" 
                variant="btn-primary mt-3"
            >
                {{ $textoBoton }}
            </x-button>
        @endif


    </div>
</section>
