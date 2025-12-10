<?php
/**
 * ControladorRecibidor
 *  Responsabilidad:
 *  - Gestionar la navegación entre vistas
 *  - Mostrar las pantallas principales (HTML Y/O PHP)
 */

class ControladorRecibidor {

    private $config;

    public function __construct($config){
        $this->config = $config;
    }

    public function verRecibidor(){
        $vista = new verRecibidor($this->config);
        $vista->mostrar();

    }

    public function verOpcionRegistro(){
        $vista = new verRecibidor($this->config);
        $vista->mostrarOpcion();
    }
    
}
