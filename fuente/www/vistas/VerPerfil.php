<?php
    class VerPerfil {

        protected $config;

        public function __construct($config){
            $this->config = $config;
        }

       public function mostrar(){
         require_once($this->config['dir_html'].'perfil.html');
       }

       /*public function mensajeRegistro(){
            if (isset($_SESSION['mensaje'])) {
        
            echo '<div class="container-md d-flex justify-content-center align-items-center mt-2">';
            echo '<div class="alert alert-danger" role="alert" w-50>' . ($_SESSION['mensaje']) . '</div>';
            echo '</div>';

            // limpiar para que no se repita al refrescar
            unset($_SESSION['mensaje']);
            }
       }*/

    }

