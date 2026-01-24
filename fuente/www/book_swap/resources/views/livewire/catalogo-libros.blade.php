<div>

    <div class="row g-2 mb-4">
        <x-input
            name="busqueda" 
            wire:model.live="busqueda"
            placeholder="Buscar por título..."
        />
    </div>


    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-2 row-cols-xl-3 g-4">
        @forelse($libros as $libro)
            <div class="col">
                <x-tarjeta-mostrar 
                    :elem="$libro"
                    tipo="libro"
                    :dobleTarjeta="true"
                    :mostrarImagen="true"
                />
            </div>
        @empty
            <p class="text-muted fst-italic p-2">No se encuentra ningún libro.</p>
        @endforelse
    </div>

</div>
