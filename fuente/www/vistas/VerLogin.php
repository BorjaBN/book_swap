<?php

/**
 * Clase VerLogin
 *
 * Vista encargada de mostrar el formulario de inicio de sesión.
 *
 * Responsabilidades:
 * - Cargar la plantilla HTML de login.
 * - Permitir mostrar mensajes opcionales en la vista.
 * 
 * 
 */
    class VerLogin{
        private $config;

        /**
         * Constructor de la clase VerLogin.
         *
         * @param array $config Configuración de la aplicación (incluye directorios de vistas).
         */
        public function __construct($config){
            $this->config = $config;

        }

 
        /**
         * Muestra la vista de login.
         *
         * Carga el archivo HTML correspondiente desde el directorio configurado.
         *
         * @param string|null $mensaje Mensaje opcional para mostrar en la vista.
         *
         * @return void
         */
        public function mostrar($mensaje = null){
            require_once($this->config['dir_html'].'login.html');
        }
}