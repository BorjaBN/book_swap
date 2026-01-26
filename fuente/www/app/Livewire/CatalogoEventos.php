<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EventoCultural;

/**
 * Componente Livewire encargado de mostrar el catálogo de eventos culturales.
 *
 * Permite filtrar los eventos por tipo y realizar búsquedas por texto.
 * Además, pagina los resultados utilizando Bootstrap como tema visual.
 *
 * Cuando cambia el término de búsqueda ($busqueda), se reinicia la página
 * actual para evitar inconsistencias en la paginación.
 */
class CatalogoEventos extends Component
{
    use WithPagination;

    /**
     * Término de búsqueda introducido por el usuario.
     *
     * @var string
     */
    public $busqueda = '';

    /**
     * Tipo de evento seleccionado para el filtrado.
     *
     * @var string
     */
    public $tipo = '';

    /**
     * Tema de paginación tipo Bootstrap utilizado por Livewire.
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
     * Renderiza la vista del componente con los eventos filtrados.
     *
     * Aplica:
     * - un filtro opcional por tipo de evento,
     * - un filtro opcional por búsqueda textual (si se usa en la vista),
     * - un orden por fecha de evento ascendente,
     * - paginación de 12 elementos por página.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $eventos = EventoCultural::query()
            ->when($this->tipo, function ($consulta) {
                $consulta->where('tipo_evento', $this->tipo);
            })
            ->orderBy('fecha_evento', 'asc')
            ->paginate(12);

        return view('livewire.catalogo-eventos', [
            'eventos' => $eventos,
        ]);
    }
}
