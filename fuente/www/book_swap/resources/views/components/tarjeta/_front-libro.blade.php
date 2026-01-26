{{-- HEADER --}}
<div class="d-flex align-items-center gap-3 mb-2">
    @if($elem->propietario)
        <img src="https://avatars.laravel.cloud/{{ urlencode($elem->propietario->email_usuario_comun) }}"
             alt="{{ $elem->propietario->nombre_usuario_comun }} avatar"
             class="rounded-circle border"
             width="40" height="40">

        <div class="d-flex flex-column">
            <span class="fw-semibold titulo-usuario">{{ $elem->propietario->nombre_usuario_comun }}</span>
            <small class="text-muted">{{ $elem->created_at->locale('es')->diffForHumans() }}</small>
        </div>
    @endif
</div>

{{-- IMAGEN --}}
@if($mostrarImagen)
    <div class="tarjeta-img-wrapper mb-2">
        @if($elem->imagen_libro)
            <img src="{{ asset('storage/' . $elem->imagen_libro) }}" class="tarjeta-img">
        @else
            <div class="tarjeta-img placeholder d-flex justify-content-center align-items-center">
                <i class="bi bi-image text-white fs-1 opacity-75"></i>
            </div>
        @endif
    </div>
@endif

{{-- FOOTER --}}
<div class="mt-2">
    <h5 class="fw-bold titulo-libro text-truncate">{{ $elem->titulo_libro }}</h5>
    <small class="text-muted"> <i class="bi bi-person me-1"></i> Autor: {{ $elem->autor_libro }}</small>
    <div>
        @if(isset($elem->estado_libro))
            <span class="badge badge-estado badge-morado">
                {{ ucfirst($elem->estado_libro) }}
            </span>
        @endif

        @if(isset($elem->genero_libro))
            <span class="badge badge-estado badge-morado-claro ms-1">
                {{ $elem->genero_libro }}
            </span>
        @endif

        </div>
    <x-button 
        type="button"
        variant="btn-tertiary-ghost w-100 mt-2"
        @click.stop="flipped = true"
    >
        Más detalles
    </x-button>
</div>
