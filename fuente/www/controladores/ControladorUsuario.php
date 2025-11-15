<?php

    /**
     * ControladorUsuario
     *      Responsabilidad:
     *      - Recibir los datos de usuario
     *      - Aplicar las reglas de negocio
     *      - Navegación entre vistas
     */

    abstract class ControladorUsuario {

        private $config;

        public function __construct ($config){
            $this->config = $config;
        }

        public function verRegistro() {}

        public function registrar(){}
      
    }