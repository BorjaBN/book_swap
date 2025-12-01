<?php
     class VerRegistro {

        private $config;

        public function __construct($config){
            $this->config = $config;
        }


        public function mostrarFormulario($datos = null, $mensaje = null){
            require_once($this->config['dir_html'].'registro.html');
        }

    }

