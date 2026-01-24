<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\EventoCultural;

class CatalogoEventos extends Component
{
    public $busqueda = '';
    public $tipo = '';

    public function render()
    {
        $eventos = EventoCultural::query()
            ->when($this->tipo, function ($query) {
                $query->where('tipo_evento', $this->tipo);
            })
            ->orderBy('fecha_evento', 'asc')
            ->get();

        return view('livewire.catalogo-eventos', [
            'eventos' => $eventos
        ]);
    }
}
