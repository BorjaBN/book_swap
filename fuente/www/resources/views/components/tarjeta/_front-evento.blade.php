<div class="d-flex align-items-center gap-2 mb-2">
    @if($elem->entidad)
        <img src="https://avatars.laravel.cloud/{{ urlencode($elem->entidad->email_entidad_cultural) }}"
             alt="{{ $elem->entidad->nombre_entidad_cultural }} avatar"
             class="rounded-circle border"
             width="36" height="36">

        <div class="lh-sm">
            <span class="fw-semibold titulo-usuario d-block">{{ $elem->entidad->nombre_entidad_cultural }}</span>
            <small class="text-muted">{{ $elem->created_at->locale('es')->diffForHumans() }}</small>
        </div>
    @endif
</div>

<h5 class="fw-bold titulo-libro mb-2 text-truncate text-center">
    {{ $elem->nombre_evento }}
</h5>

<div class="small"><strong>Fecha:</strong> {{ $elem->fecha_evento->locale('es')->translatedFormat('d F Y H:i') }}</div>
<div class="small"><strong>Tipo:</strong> {{ ucfirst($elem->tipo_evento) }}</div>
<div class="small"><strong>Ubicación:</strong> {{ $elem->ubicacion_evento }}</div>

<div class="small mb-3">
    <strong>Descripción:</strong>
    <p class="mt-1">{{ $elem->descripcion_evento }}</p>
</div>

@can('update', $elem)
    <div class="d-flex gap-2">
        <x-button
            href="{{ route('entidad.eventos.edit', $elem->id_evento) }}"
            variant="btn-outline-edit btn-sm w-50"
        >
            <i class="bi bi-pen fs-6 me-2"></i> Editar
        </x-button>

        
        <form method="POST" action="{{ route('entidad.eventos.destroy', $elem->id_evento) }}" class="w-50">
            @csrf
            @method('DELETE')

            <x-button 
                type="button"
                variant="btn-outline-danger btn-sm w-100"
                onclick="abrirModal('modal-pregunta-evento-{{ $elem->id_evento }}')"
            >
                <i class="bi bi-trash fs-6 me-2"></i> Borrar
            </x-button>
        </form>

        <x-modal-pregunta
            id="modal-pregunta-evento-{{ $elem->id_evento }}"
            titulo="Confirmar borrado"
            mensaje="¿Seguro que quieres eliminar este evento?"
            textoCancelar="Cancelar"
            textoAceptar="Sí, borrar"
            accionAceptar="{{ route('entidad.eventos.destroy', $elem->id_evento) }}"
        />
    </div>
@endcan
