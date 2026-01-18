<header class="d-flex align-items-center justify-content-between p-3">
    <img src="{{ asset('img/logo_oscuro.png') }}" class="logo-header" alt="Logo BookSwap">

    @if($mostrarNav)
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
