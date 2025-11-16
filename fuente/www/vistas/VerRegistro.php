<?php
    abstract class VerRegistro {

        protected $config;

        public function __construct($config){
            $this->config = $config;
        }

       public abstract function mostrarFormulario();


    }

