<?php
/**
 * ControladorInicio
 *  Responsabilidad:
 *  - Gestionar la navegación entre vistas
 *  - Mostrar las pantallas principales (HTML Y/O PHP)
 */

class ControladorInicio {

    protected $config;

    public function __construct($config){
        $this->config = $config;
    }

    public function verInicio(){
        require_once($this->config['dir_html'].'inicio.html');
    }

    public function verOpcionRegistro(){
        require_once($this->config['dir_html'].'opcion_registro.html');
    }

    
}
