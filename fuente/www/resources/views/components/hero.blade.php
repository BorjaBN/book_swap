<section class="hero">
    <div class="hero-content d-flex flex-column align-items-center">

        <img src="{{ asset('img/logo_oscuro.png') }}" class="img-fluid logo" alt="Logo BookSwap">

        @if($titulo)
            <h1 class="hero-title">{{ $titulo }}</h1>
        @endif

        @if($subtitulo)
            <p class="hero-subtitle">{!! $subtitulo !!}</p>
        @endif

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
