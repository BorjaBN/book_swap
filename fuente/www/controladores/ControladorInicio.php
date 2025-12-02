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
        $vista = new VerInicio($this->config);
        $vista->mostrar();

    }

    public function verOpcionRegistro(){
        $vista = new VerInicio($this->config);
        $vista->mostrarOpcion();
    }

    public function verLogin(){
            $vista = new VerInicio($this->config);
            $vista->mostrarLogin();
    }

    
}
