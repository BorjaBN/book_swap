<?php
      class UsuarioComunVerRegistro{
        private $config;

        public function __construct($config){
            $this->config = $config;
        }

        public function mostrar($mensaje = null){
            require_once($this->config['dir_html'].'registro_usuario_comun.html');
        }

    }