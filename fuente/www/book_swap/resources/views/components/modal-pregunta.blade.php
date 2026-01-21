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
                class="btn-cancelar" 
                onclick="cerrarModal('{{ $id }}')"
            >
                {{ $textoCancelar ?? 'Cancelar' }}
            </button>

            {{-- Aceptar --}}
            <a 
                href="{{ $accionAceptar }}" 
                class="btn-salir"
            >
                {{ $textoAceptar ?? 'Aceptar' }}
            </a>

        </div>

    </div>
</div>
