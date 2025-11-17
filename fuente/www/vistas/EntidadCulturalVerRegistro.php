<?php
    class EntidadCulturalVerRegistro extends VerRegistro{
        

        public function __construct($config){
            parent::__construct($config);
        }

        public function mostrarFormulario(){
            require_once($this->config['dir_html'].'registro_entidad_cultural.html');
        }

    }