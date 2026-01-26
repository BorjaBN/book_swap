<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EventoCultural;

class CatalogoEventos extends Component
{

    public $tipo = '';

    protected $paginationTheme = 'bootstrap';

    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    public function render()
    {
        $eventos = EventoCultural::query()
            ->when($this->tipo, function ($query) {
                $query->where('tipo_evento', $this->tipo);
            })
            ->orderBy('fecha_evento', 'asc')
            ->latest()
            ->paginate(12);

        return view('livewire.catalogo-eventos', [
            'eventos' => $eventos
        ]);
    }
}
