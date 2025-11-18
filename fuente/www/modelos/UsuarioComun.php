<?php

    class UsuarioComun extends Usuario {

        protected $apellidos;

        public function __construct (string $nombre, string $apellidos, string $email, string $pass, string $telefono, string $ciudad){
            parent::__construct($nombre, $email, $pass, $telefono, $ciudad);
            $this->apellidos = $apellidos;
        }
    
        public function guardar(){
            try{
                $sql = "INSERT INTO user_comun (nombre_user_comun, apellidos_user_comun, email_user_comun, pass_user_comun, telefono_user_comun, ciudad_user_comun, id_admin) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $parametros = [$this->nombre, $this->apellidos, $this->email, $this->pass, $this->telefono, $this->ciudad, $this->idAdmin];

                //$this->id = 
                $this->baseDatos->insertar($sql, $parametros);
                //return $this->id;
    
            } catch (Throwable $excepcion) {
        
                http_response_code(500);
                error_log("Error en modelos/UsuarioComun.php: ".$excepcion);
                throw $excepcion;
                
            }
        }

    }






