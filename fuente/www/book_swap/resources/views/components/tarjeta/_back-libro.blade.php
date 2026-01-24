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
    {{-- Botón adicional: Solicitar intercambio --}}
    @cannot('update', $elem)
        <x-button 
            href="{{ route('intercambio', $elem->id_libro) }}"
            variant="btn-primary w-100 mb-2"
        >
            Solicitar intercambio
        </x-button>
    @endcannot

    {{-- Botones Editar / Borrar solo para el propietario --}}
    @can('update', $elem)
        <div class="d-flex gap-2 mb-2">

            {{-- Editar --}}
            <x-button
                href="{{ route('libros.edit', $elem->id_libro) }}"
                variant="btn-outline-edit  btn-sm w-50"
            >
               <i class="bi bi-pen fs-6 me-2"></i> Editar
            </x-button>

            {{-- Borrar --}}
            <form method="POST" action="{{ route('libros.destroy', $elem->id_libro) }}" class="w-50">
                @csrf
                @method('DELETE')

                <x-button 
                    type="button"
                    variant="btn-outline-danger btn-sm w-100"
                    onclick="abrirModal('modal-pregunta-libro-{{ $elem->id_libro }}')"
                >
                    <i class="bi bi-trash3 fs-6 me-2"></i> Borrar
                </x-button>
            </form>

            <x-modal-pregunta
                id="modal-pregunta-libro-{{ $elem->id_libro }}"
                titulo="Confirmar borrado"
                mensaje="¿Seguro que quieres eliminar este libro?"
                textoCancelar="Cancelar"
                textoAceptar="Sí, borrar"
                accionAceptar="{{ route('libros.destroy', $elem->id_libro) }}"
            />
        </div>
    @endcan

    {{-- Slot para botones extra --}}
    {{ $slot ?? '' }}

    <x-button 
        type="button"
        variant="btn-tertiary-ghost w-100 mt-2"
        @click.stop="flipped = false"
    >
        Volver
    </x-button>
</div>
