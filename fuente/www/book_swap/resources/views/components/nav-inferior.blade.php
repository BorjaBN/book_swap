<nav class="bottom-nav">

    {{-- Usuario común --}}
    @auth('web')
        <a href="{{ route('inicio') }}">
            <i class="bi bi-house-door-fill"></i>
            <span>Inicio</span>
        </a>

        <a href="{{ route('libros.index') }}">
            <i class="bi bi-book"></i>
            <span>Catálogo</span>
        </a>

        <a href="{{ route('libros.create') }}">
            <i class="bi bi-plus-circle-fill"></i>
            <span>Añadir</span>
        </a>

        <a href="{{ route('eventos.index') }}">
            <i class="bi bi-calendar-event"></i>
            <span>Eventos</span>
        </a>

        <a href="{{ route('intercambios.misSolicitudes') }}" class="nav-item position-relative">
        <i class="bi bi-bell fs-4"></i>

        @if($solicitudesPendientes > 0)
            <span 
                class="badge bg-danger rounded-pill position-absolute"
                style="top: -4px; right: -6px;"
            >
                {{ $solicitudesPendientes }}
            </span>
        @endif

        <span>Solicitudes</span>
    </a>


    @endauth

    {{-- Entidad cultural --}}
    @auth('entidad')
        <a href="{{ route('entidad.inicio') }}">
            <i class="bi bi-house-door-fill"></i>
            <span>Inicio</span>
        </a>

        <a href="{{ route('entidad.eventos.create') }}">
            <i class="bi bi-plus-circle-fill"></i>
            <span>Añadir</span>
        </a>

        <a href="{{ route('entidad.perfil.show', auth('entidad')->user()->id_entidad_cultural) }}">
            <i class="bi bi-person-circle"></i>
            <span>Perfil</span>
        </a>
    @endauth

</nav>
