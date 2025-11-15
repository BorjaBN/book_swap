<?php
    /**
     * index.php
     * Responsabilidades:
     *  - Cargar configuración inicial
     *  - Configuración de errores
     *  - Middleware
     *  - Routing
     * 
     */

    try {
    
        //Cargar configuración inicial   
        $config = require_once('config.php'); 

        //Autoload: Permite cargar automáticamente la clase (si no está disponible) en el momento en el que se instancie 
        spl_autoload_register(function($clase) use ($config){

            $directorios = [
                $config['dir_controladores'],
                $config['dir_modelos'],
                $config['dir_vistas'],
            ];

            foreach ($directorios as $dir) {
                $ruta = $dir.$clase.'.php';
                
                if (file_exists($ruta)){
                    require_once $ruta;
                    return; 
                }    
            }
        });

        //Configuración de errores, modo debug
            if ($config['debug']){
                ini_set('display_errors', 1); 
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

            }
            else{

                ini_set('display_errors', 0);
                ini_set('display_startup_errors', 0);
                error_reporting(0);
            }
        
        //Routing: procesamiento de la petición
        $controlador = $_GET['controlador'];
        $metodo = $_GET['metodo'];

        $controlador = new $controlador($config); //Acceso a los parámetros de la configuración 
        $controlador->$metodo();

    } catch (Throwable $exception){

        http_response_code(500); //Para indicar el tipo de error y no preocuparnos por la versión del protocolo HTTP

        if ($config['debug']){
            echo "Error en index.php:". $exception; //Para indicar donde ha sido el error
        }

    }