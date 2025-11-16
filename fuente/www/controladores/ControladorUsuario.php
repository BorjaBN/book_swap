<?php

    /**
     * ControladorUsuario
     *      Responsabilidad:
     *      - Recibir los datos de usuario
     *      - Aplicar las reglas de negocio
     *      - Navegación entre vistas
     */

    abstract class ControladorUsuario {

        protected $config;

        public function __construct ($config){
            $this->config = $config;
        }

        public abstract function verRegistro();

        public abstract function registrar();

        public abstract function verPerfil();
      
    }