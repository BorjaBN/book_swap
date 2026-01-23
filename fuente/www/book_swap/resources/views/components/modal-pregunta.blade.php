<div 
    id="{{ $id }}" 
    class="modal-overlay hidden"
>
    <div class="modal-content">

        {{-- Título --}}
        @if(isset($titulo))
            <h3>{{ $titulo }}</h3>
        @endif

        {{-- Mensaje --}}
        @if(isset($mensaje))
            <p>{{ $mensaje }}</p>
        @endif

        {{-- Botones --}}
        <div class="modal-buttons">

            {{-- Cancelar --}}
            <button 
                type="button" 
                class="btn-secondary" 
                onclick="cerrarModal('{{ $id }}')"
            >
                {{ $textoCancelar ?? 'Cancelar' }}
            </button>

            {{-- Aceptar --}}
            <form id="form-delete-{{ $id }}" 
                action="{{ $accionAceptar }}" 
                method="POST">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn-danger">
                    {{ $textoAceptar ?? 'Aceptar' }}
                </button>
            </form>


        </div>

    </div>
</div>
