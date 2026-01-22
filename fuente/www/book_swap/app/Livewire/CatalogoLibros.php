<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Libro;

class CatalogoLibros extends Component
{
    public $busqueda = '';

    public function render()
    {
        $libros = Libro::query()
            ->when($this->busqueda, fn($q) =>
                $q->where('titulo_libro', 'LIKE', '%' . $this->busqueda . '%')
            )
            ->get();

        return view('livewire.catalogo-libros', compact('libros'));
    }
}
