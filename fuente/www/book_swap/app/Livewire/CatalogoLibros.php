<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Libro;

class CatalogoLibros extends Component
{
    use WithPagination;

    public $busqueda = '';

    protected $paginationTheme = 'bootstrap';


    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    public function render()
    {
        
    $libros = Libro::with('propietario')
        ->where('estado', 'libre')
        ->where('titulo', 'like', '%' . $this->busqueda . '%')
        ->latest()
        ->paginate(12);


        return view('livewire.catalogo-libros', compact('libros'));
    }
}
