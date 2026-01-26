<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Libro;

/**
 * Componente Livewire encargado de mostrar el catálogo de libros disponibles.
 *
 * Permite realizar búsquedas por título y paginar los resultados. Utiliza
 * Bootstrap como tema de paginación. Cuando cambia el término de búsqueda,
 * se reinicia la página actual para evitar inconsistencias en la paginación.
 */
class CatalogoLibros extends Component
{
    use WithPagination;

    /**
     * Término de búsqueda introducido por el usuario.
     *
     * Se utiliza para filtrar los libros por coincidencia en el título.
     *
     * @var string
     */
    public $busqueda = '';

    /**
     * Tema de paginación utilizado por Livewire.
     *
     * @var string
     */
    protected $paginationTheme = 'bootstrap';

    /**
     * Reinicia la paginación cuando cambia el término de búsqueda.
     *
     * Livewire ejecuta este método automáticamente al detectar cambios
     * en la propiedad pública $busqueda.
     *
     * @return void
     */
    public function updatingBusqueda()
    {
        $this->resetPage();
    }

    /**
     * Renderiza la vista del componente con los libros filtrados.
     *
     * Filtra únicamente libros en estado "libre", aplica búsqueda por título
     * y ordena los resultados por fecha de creación descendente. Finalmente,
     * pagina los resultados en bloques de 12 elementos.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $libros = Libro::with('propietario')
            ->where('estado_intercambio', 'libre')
            ->where('titulo_libro', 'like', '%' . $this->busqueda . '%')
            ->latest()
            ->paginate(12);

        return view('livewire.catalogo-libros', compact('libros'));
    }
}
