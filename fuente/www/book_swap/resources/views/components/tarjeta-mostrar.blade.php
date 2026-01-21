@props([
    'elem',
    'tipo' => 'libro',
    'dobleTarjeta' => true
])

<div class="tarjeta-wrapper mx-auto mb-4">
    <div 
        x-data="{ flipped: false }"
        class="tarjeta-inner"
        :class="flipped ? 'flipped' : ''"
        @click.away="flipped = false"
    >

        {{-- ================= FRONT ================= --}}
        <div class="tarjeta-front card shadow-sm p-3 d-flex flex-column justify-content-between">

            {{-- HEADER --}}
            <div class="d-flex align-items-center gap-3 mb-2">

                @if($elem->propietario)
                    <img src="https://avatars.laravel.cloud/{{ urlencode($elem->propietario->email_usuario_comun) }}"
                         alt="{{ $elem->propietario->nombre_usuario_comun }} avatar"
                         class="rounded-circle border"
                         width="40" height="40">

                    <div class="d-flex flex-column">
                        <span class="fw-semibold titulo-usuario">{{ $elem->propietario->nombre_usuario_comun }}</span>
                        <small class="text-muted">{{ $elem->created_at->diffForHumans() }}</small>
                    </div>
                @endif
            </div>

            {{-- IMAGEN --}}
            <div class="tarjeta-img-wrapper mb-2">
                @if($elem->imagen_libro)
                    <img src="{{ asset('storage/' . $elem->imagen_libro) }}" class="tarjeta-img">
                @else
                    <div class="tarjeta-img placeholder d-flex justify-content-center align-items-center">
                        <i class="bi bi-image text-white fs-1 opacity-75"></i>
                    </div>
                @endif
            </div>

            {{-- FOOTER --}}
            <div class="mt-2">
                <h6 class="fw-bold titulo-libro text-truncate">{{ $elem->titulo_libro }}</h6>
                <small class="text-muted">Autor: {{ $elem->autor_libro }}</small>

                <x-button 
                    type="button"
                    variant="btn-tertiary-ghost w-100 mt-2"
                    @click.stop="flipped = true"
                >
                    Más detalles
                </x-button>
            </div>

        </div>

        {{-- ================= BACK ================= --}}
        <div class="tarjeta-back card shadow-sm p-3 d-flex flex-column justify-content-between">

            <h6 class="fw-bold titulo-libro border-bottom pb-2">{{ $elem->titulo_libro }}</h6>

            <div class="small"><strong>Autor:</strong> {{ $elem->autor_libro }}</div>
            <div class="small"><strong>ISBN:</strong> {{ $elem->ISBN }}</div>
            <div class="small"><strong>Estado:</strong> {{ ucfirst($elem->estado_libro) }}</div>
            <div class="small"><strong>Género:</strong> {{ $elem->genero_libro }}</div>

            <div class="small mb-3">
                <strong>Propietario:</strong>
                @if($elem->propietario)
                    <div class="d-flex align-items-center gap-2 mt-1">
                        <img src="https://avatars.laravel.cloud/{{ urlencode($elem->propietario->email_usuario_comun) }}"
                             class="rounded-circle border"
                             width="40" height="40">
                        <span>{{ $elem->propietario->nombre_usuario_comun }}</span>
                    </div>
                @endif
            </div>

            <div>
                {{ $slot }}

                <x-button 
                    type="button"
                    variant="btn-tertiary-ghost w-100 mt-2"
                    @click.stop="flipped = false"
                >
                    Volver
                </x-button>
            </div>

        </div>

    </div>
</div>
