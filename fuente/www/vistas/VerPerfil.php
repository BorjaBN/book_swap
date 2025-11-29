<?php
    class VerPerfil {

      protected $config;
      protected $archivo_perfil;

      public function __construct($config, $archivo_perfil){
          $this->config = $config;
          $this->archivo_perfil = $archivo_perfil;
      }

      public function mostrar(){
          require_once($this->config['dir_vistas'] . $this->archivo_perfil);
      }
    }

