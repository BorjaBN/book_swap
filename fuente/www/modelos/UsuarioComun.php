<?php

    class UsuarioComun extends Usuario {

        public function __construct (string $nombre, string $apellidos, string $email, string $pass, string $telefono, string $ciudad){
            parent::__construct(string $nombre, string $email, string $pass, string $telefono, string $ciudad);
            $this->apellidos = $apellidos;
        }
    
        public function guardar(){
            try{
                $sql = "INSERT INTO user_comun (nombre_user_comun, apellidos_user_comun, email_user_comun, pass_user_comun, telefono_user_comun, ciudad_user_comun) VALUES (?, ?, ?, ?, ?, ?)";
                $parametros = [$this->nombre, $this->apellidos, $this->email, $this->pass, $this->telefono, $this->ciudad];

                $this->id = $this->base_datos->insertar($sql, $parametros);
                return $this->id;
    
            } catch (Throwable $excepcion) {
               header('HTTP/2 500 Internal Server Error');
               if ($config['debug']){
                    echo "Error en modelos/UsuarioComun.php:".$excepcion;
                }
            }
        }

    }








