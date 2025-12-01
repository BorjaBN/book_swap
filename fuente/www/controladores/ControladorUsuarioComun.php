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

        public function verRegistro($datos = null, $mensaje = null) {
            $_SESSION['tipo_registro'] = 'comun';
            $vista = new VerRegistro($this->config);
            $vista->mostrarFormulario($datos, $mensaje);
        }

        public function registrar(){
             try{

                //Sanitización
                $nombre = trim(strip_tags($_POST['nombre']));
                $apellidos = trim(strip_tags($_POST['apellidos']));
                $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
                $pass =  trim($_POST['pass']);
                $telefono = trim(filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT));
                $ciudad = trim(strip_tags($_POST['ciudad']));


                //Persistencia de datos en caso de error
                $datos = [
                    'nombre'        => $nombre,
                    'apellidos'     => $apellidos,
                    'email'         => $email,
                    'telefono'      => $telefono,
                    'ciudad'        => $ciudad
                ];

               
                $usuario = new UsuarioComun($nombre, $apellidos, $email, $pass, $telefono, $ciudad);

                //Validación
                if ($usuario->emailRegistrado()) {
                    $mensaje = "El email ya está registrado.";
                    $this->verRegistro($datos, $mensaje);
                } else {
                    $usuario->guardar();

                     // Guardar datos en sesión para mostrarlos en el perfil
                    $_SESSION['usuario'] = [
                        'tipo' => 'comun',
                        'nombre' => $nombre,
                        'apellidos' => $apellidos,
                        'email' => $email,
                        'telefono' => $telefono,
                        'ciudad' => $ciudad
                    ];

                    $this->verPerfil();
                }

            } catch (Throwable $excepcion){

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
    
        public function verLogin(){
            $vista = new VerInicio($this->config);
            $vista->mostrarLogin();
        }
      
    }