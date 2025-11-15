<?php

    /**
     * Controlador
     *      Responsabilidad:
     *      - Recibir los datos de usuario
     *      - Aplicar las reglas de negocio
     *      - Navegación entre vistas
     */

    class ControladorUsuarioComun extends ControladorUsuario {

        public function __construct ($config){
              parent::__construct($config);
        }

        public function verRegistro($mensaje = null) {
            $vista = new UsuarioComunVerRegistro($this->config);
            $vista->mostrar($mensaje);
        }

        public function registrar(){
             try{

                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $email = $_POST['email'];
                $pass =  $_POST['pass'];
                $telefono = $_POST['telefono'];
                $ciudad = $_POST['ciudad'];

                //TODO: SANITIZAR Y VALIDAR
               

                require_once($this->config['dir_modelos'].'UsuarioComun.php');
                $usuario = new UsuarioComun($nombre, $apellidos, $email, $pass, $telefono, $ciudad);
                $id = $usuario->guardar();
                $mensaje= "Usuario ($id) registrado correctamente";
                $this->verAlta($mensaje); //Se va a la siguiente alta

            } catch (Throwable $excepcion){
               //require_once($this->config['dir_vistas'].'vista_error.html');  
               header('HTTP/2 500 Internal Server Error');
               if ($this->config['debug']){
                echo "Error en ControladorUsuarioComun.php: ".$excepcion;
               }
              
            }
        }
      
    }