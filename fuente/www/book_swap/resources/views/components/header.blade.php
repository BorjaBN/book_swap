<header class="d-flex align-items-center justify-content-between p-3">
    
    {{-- Logo --}}
    <div class="logo-container">
        <a href="{{ Auth::check() ? route('inicio') : route('welcome') }}">
            <img src="{{ asset('img/logo_oscuro.png') }}" class="logo-header" alt="Logo BookSwap">
        </a>
    </div>

    @auth
        {{-- ========== USUARIO AUTENTICADO ========== --}}
        <div class="user-info d-flex align-items-center gap-3">
            
            {{-- Créditos --}}
            @if($mostrarCreditos ??  true)
                <div class="creditos-container d-flex align-items-center gap-2">
                    <svg class="icono-credito" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1. 41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-. 98 2.4-1.59 0-. 83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.67 0-1.72 1.39-2.84 3.11-3.21V4h2.67v1.95c1.86.45 2.79 1.86 2.85 3.39H14.3c-. 05-1.11-.64-1.87-2.22-1.87-1.5 0-2.4.68-2.4 1.64 0 .84.65 1.39 2.67 1.91s4.18 1.39 4.18 3.91c-.01 1.83-1.38 2.83-3.12 3.16z"/>
                    </svg>
                    <strong>
                        <span class="creditos-valor">{{Auth::user()->cartera->saldo_total ??  0  }}</span>
                        <span class="creditos-texto">créditos</span>
                    </strong>
                </div>
            @endif

            {{-- Botón Cerrar Sesión --}}
            @if($mostrarCerrarSesion ?? true)
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            @endif

        </div>

    @else
        {{-- ========== USUARIO NO AUTENTICADO ========== --}}
        @if($mostrarNav ?? true)
            <nav>
                <x-button href="{{ route('decisionRegistro') }}" variant="btn-custom btn-registrarse">
                    Registrarse
                </x-button>

                <x-button href="{{ route('formularioInicioSesion') }}" variant="btn-custom btn-login">
                    Iniciar sesión
                </x-button>
            </nav>
        @endif
    @endauth

</header>