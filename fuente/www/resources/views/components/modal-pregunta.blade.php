<div 
    id="{{ $id }}" 
    class="modal-overlay hidden"
>
    <div class="modal-content">

        @isset($titulo)
            <h3>{{ $titulo }}</h3>
        @endisset

        @isset($mensaje)
            <p>{{ $mensaje }}</p>
        @endisset

        <div class="modal-buttons">

            <x-button
                type="button"
                variant="btn-secondary"
                onclick="cerrarModal('{{ $id }}')"
            >
                {{ $textoCancelar ?? 'Cancelar' }}
            </x-button>


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
