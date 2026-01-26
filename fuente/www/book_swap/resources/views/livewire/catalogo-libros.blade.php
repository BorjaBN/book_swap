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
        <div class="empty-state d-flex flex-column justify-content-center align-items-center py-5">
            <i class="bi bi-book"></i>
            <h3>No se encuentraron resultados</h3>
        </div>
        @endforelse
    </div>
    <div class="mt-4 d-flex justify-content-center"> 
      {{ $libros->onEachSide(1)->links('pagination::bootstrap-4') }}
    </div>

</div>
