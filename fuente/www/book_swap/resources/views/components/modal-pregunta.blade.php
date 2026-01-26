<div 
    id="{{ $id }}" 
    class="modal-overlay hidden"
>
    <div class="modal-content">

        {{-- Título --}}
        @isset($titulo)
            <h3>{{ $titulo }}</h3>
        @endisset

        {{-- Mensaje --}}
        @isset($mensaje)
            <p>{{ $mensaje }}</p>
        @endisset

        {{-- Botones --}}
        <div class="modal-buttons">

            {{-- Botón Cancelar (usa tu componente x-button) --}}
            <x-button
                type="button"
                variant="btn-secondary"
                onclick="cerrarModal('{{ $id }}')"
            >
                {{ $textoCancelar ?? 'Cancelar' }}
            </x-button>

            {{-- Botón Aceptar (usa tu componente x-button dentro del form) --}}
            <form 
                id="form-delete-{{ $id }}" 
                action="{{ $accionAceptar }}" 
                method="POST"
            >
                @csrf
                @method('DELETE')

                <x-button
                    type="submit"
                    variant="btn-danger"
                >
                    {{ $textoAceptar ?? 'Aceptar' }}
                </x-button>
            </form>

        </div>

    </div>
</div>
