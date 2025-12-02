<?php

class VerInicio {

    private $config;

    public function __construct($config){
        $this->config = $config; 
    }

    public function mostrar(){
        require_once($this->config['dir_html'].'inicio.html');
    }

    public function mostrarOpcion(){
        require_once($this->config['dir_html'].'opcion_registro.html');
    }

    public function mostrarLogin(){
        require_once($this->config['dir_html'].'login.html');
    }

}