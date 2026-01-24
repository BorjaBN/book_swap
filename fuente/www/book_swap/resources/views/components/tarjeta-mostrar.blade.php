@props([
    'elem',
    'tipo' => 'libro',
    'dobleTarjeta' => true,
    'mostrarImagen' => true,
])

<div class="tarjeta-wrapper mx-auto mb-4 {{ $tipo === 'evento' ? 'tarjeta-evento' : '' }}">

    <div 
        x-data="{ flipped: false }"
        class="tarjeta-inner"
        :class="flipped ? 'flipped' : ''"
        @click.away="flipped = false"
    >

        {{-- ================= FRONT ================= --}}
        <div class="tarjeta-front card shadow-sm p-3 d-flex flex-column justify-content-between">
            @includeIf('components.tarjeta._front-' . $tipo, [
                'elem' => $elem,
                'tipo' => $tipo,
                'mostrarImagen' => $mostrarImagen,   
            ])
        </div>
        {{-- ================= BACK ================= --}}
        <div class="tarjeta-back card shadow-sm p-3 d-flex flex-column justify-content-between">
            @includeIf('components.tarjeta._back-' . $tipo, [
                'elem' => $elem,
                'tipo' => $tipo,
                'slot' => $slot,
            ])
        </div>

    </div>
</div>