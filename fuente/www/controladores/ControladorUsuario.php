<?php

    /**
     * Controlador
     *      Responsabilidad:
     *      - Recibir los datos de usuario
     *      - Aplicar las reglas de negocio
     *      - Navegación entre vistas
     */

    class ControladorUsuario {

        private $config;

        public function __construct ($config){
            $this->config = $config;
        }

        public function verRegistro($mensaje = null) {
    
            $vista = new UsuarioVerAlta($this->config);
            $vista->mostrar($mensaje);
        }

      
    }