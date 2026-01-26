@props([
    'mostrarBienvenida' => false,
    'mostrarCreditos' => true,
    'mostrarCerrarSesion' => true,
    'mostrarPerfil' => false,
])
<header class="d-flex align-items-center justify-content-between p-3">
    
    {{-- Logo --}}
    <div class="logo-container">
        <img src="{{ asset('img/logo_oscuro.png') }}" class="logo-header" alt="Logo BookSwap">
    </div>

        {{-- ========== USUARIO AUTENTICADO ========== --}}
        <div class="user-info d-flex align-items-center gap-3">
            

            {{-- Icono Perfil --}}
            @if($mostrarPerfil)

                @auth('web')
                    <x-button 
                        href="{{ route('usuarioComun.show', auth('web')->user()->id_usuario_comun) }}" 
                        variant="btn-header"
                    >
                        <i class="bi bi-person-circle fs-4 me-1"></i> Perfil
                    </x-button>
                @endauth

            @endif


            {{-- Créditos --}}
            @if($mostrarCreditos)
                <div class="creditos-container d-flex align-items-center gap-2">
                    <i class="bi bi-piggy-bank"></i>
                    <strong>
                        <span class="creditos-valor">{{Auth::user()->cartera->saldo_total ??  0  }}</span>
                    </strong>
                </div>
            @endif



            {{-- Botón Cerrar Sesión --}}
            @if($mostrarCerrarSesion)
                <form action="{{ route('cerrarSesion') }}" method="POST">
                    @csrf
                    <x-button type="submit" variant="btn-header">
                        <i class="bi bi-box-arrow-right"></i>
                    </x-button>
                </form>
            @endif

        </div>

        {{-- ========== USUARIO NO AUTENTICADO ========== --}}
        @if($mostrarBienvenida)
            <nav>
                <x-button href="{{ route('decisionRegistro') }}" variant="btn-custom btn-registrarse">
                    Registrarse
                </x-button>

                <x-button href="{{ route('formularioInicioSesion') }}" variant="btn-custom btn-login">
                    Iniciar sesión
                </x-button>
            </nav>
        @endif


</header>