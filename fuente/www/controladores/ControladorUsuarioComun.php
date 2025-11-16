<?php

    /**
     * Controlador Usuario Común
     *      Responsabilidad:
     *      - Recibir los datos de usuario
     *      - Aplicar las reglas de negocio
     *      - Navegación entre vistas
     */

    class ControladorUsuarioComun extends ControladorUsuario {

        public function __construct ($config){
              parent::__construct($config);
        }

        public function verRegistro() {
            $vista = new UsuarioComunVerRegistro($this->config);
            $vista->mostrarFormulario();
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
               

                $usuario = new UsuarioComun($nombre, $apellidos, $email, $pass, $telefono, $ciudad);
                $usuario->guardar();

               
                $_SESSION['mensaje'] = "Registro completado con éxito.";

                $this->verPerfil();

            } catch (Throwable $excepcion){ 

                
                $_SESSION['mensaje'] = "Registro fallido, prueba de nuevo.";
                $_SESSION['exito']   = false;

                // Volver al formulario de registro
                //header("Location: " .  $this->config['dir_html'] . "registro_usuario_comun.html");
                //exit;


                if ($this->config['debug']) {
                    http_response_code(500);
                    echo "Error en registrar usuario: ".$excepcion->getMessage();
                } 
            }
        }

        public function verPerfil(){
            $vista = new VerPerfil($this->config);
            $vista->mostrar();
        }
    
      
    }