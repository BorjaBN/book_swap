<?php

    /**
     * Controlador Entidad Cultural
     *      Responsabilidad:
     *      - Recibir los datos de usuario
     *      - Aplicar las reglas de negocio
     *      - Navegación entre vistas
     */

    class ControladorEntidadCultural extends ControladorUsuario {

        public function __construct ($config){
              parent::__construct($config);
        }

        public function verRegistro() {
            $vista = new EntidadCulturalVerRegistro($this->config);
            $vista->mostrarFormulario();
        }

        public function registrar(){
             try{

                $nombre = $_POST['nombre'];
                $email = $_POST['email'];
                $pass =  $_POST['pass'];
                $telefono = $_POST['telefono'];
                $ciudad = $_POST['ciudad'];

                //TODO: SANITIZAR Y VALIDAR
    
                $usuario = new EntidadCultural($nombre, $email, $pass, $telefono, $ciudad);
                $usuario->guardar();
                
                // Guardar datos en sesión para mostrarlos en el perfil
                 $_SESSION['usuario'] = [
                    'nombre' => $nombre,
                    'email' => $email,
                    'telefono' => $telefono,
                    'ciudad' => $ciudad,
                    'tipo' => 'comun'
                ];

                $_SESSION['mensaje'] = "Registro de entidad completado con éxito.";

                $this->verPerfil();

            } catch (Throwable $excepcion){ 
                http_response_code(500);
                if ($this->config['debug']) {
                    echo "Error en registrar usuario: ".$excepcion->getMessage();
                } 
            }
        }

        public function verPerfil(){
            $vista = new VerPerfil($this->config, 'PerfilEntidadCultural.php');
            $vista->mostrar();
        }
      
    }