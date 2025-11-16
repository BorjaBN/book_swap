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
                $usuario = new UsuarioComun($nombre, $apellidos, $email, $pass, $telefono, $ciudad, 1);
                $id = $usuario->guardar();
                $mensaje= "Usuario ($id) registrado correctamente";
                $this->verRegistro($mensaje); //Se va a la siguiente alta

            } catch (Throwable $excepcion){ //Así es el controlador quien decide si mostrar o no el error (siendo específico)
                http_response_code(500);
                if ($this->config['debug']) {
                    echo "Error en registrar usuario: ".$excepcion->getMessage();
                } else {
                    // mostrar vista genérica de error
                    $this->verRegistro("Ha ocurrido un error al registrar el usuario.");
                }
            }
        }
      
    }