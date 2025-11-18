<?php
/**
 * ControladorVistas
 *  Responsabilidad:
 *  - Gestionar la navegación entre vistas
 *  - Mostrar las pantallas principales (HTML Y/O PHP)
 */

class ControladorVistas {

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

    public function verRegistroUsuarioComun(){
        require_once($this->config['dir_html'].'registro_usuario_comun.html');
    }

    public function verRegistroEntidadCultural(){
        require_once($this->config['dir_html'].'registro_entidad_cultural.html');
    }

    public function verPerfil(){
        require_once($this->config['dir_html'].'perfil.html');
    }
}
