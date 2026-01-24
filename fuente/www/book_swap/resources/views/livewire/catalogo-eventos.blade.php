<div>

    {{-- BUSCADOR --}}
    <div class="row g-2 mb-4">
        {{-- Tipo de evento --}}
        <div class="col-12 col-md-6">
            <select class="form-select" wire:model.live="tipo">
                <option value="">Todos los tipos</option>
                <option value="encuentro con autor/a">Encuentro con autor/a</option>
                <option value="club de lectura">Club de lectura</option>
                <option value="feria del libro">Feria del libro</option>
            </select>
        </div>

    </div>

    {{-- TARJETAS --}}
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-2 row-cols-xl-3 g-4">
        @forelse($eventos as $evento)
            <div class="col">
                <x-tarjeta-mostrar 
                    :elem="$evento"
                    tipo="evento"
                    :dobleTarjeta="true"
                />
            </div>
        @empty
            <p class="text-muted fst-italic p-2">No se encuentra ningún evento</p>
        @endforelse
    </div>

</div>