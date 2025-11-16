<?php

    class EntidadCultural extends Usuario {

        public function __construct (string $nombre, string $email, string $pass, string $telefono, string $ciudad){
            parent::__construct($nombre, $email, $pass, $telefono, $ciudad);
           
        }
    
        public function guardar(){
            try{
                $sql = "INSERT INTO entidad_cultural (nombre_entidad_cultural, email_entidad_cultural, pass_entidad_cultural, telefono_entidad_cultural, ciudad_entidad_cultural, id_admin) VALUES (?, ?, ?, ?, ?, ?)";
                $parametros = [$this->nombre, $this->email, $this->pass, $this->telefono, $this->ciudad, $this->idAdmin];

                //$this->id = 
                $this->baseDatos->insertar($sql, $parametros);
                //return $this->id;
    
            } catch (Throwable $excepcion) {

                http_response_code(500);
                //error_log("Error en modelos/UsuarioComun.php: ".$excepcion); 
                throw $excepcion;
                
            }
        }

    }