<?php

    class EntidadCultural extends Usuario {

        public function __construct (string $nombre, string $email, string $pass, string $telefono, string $ciudad){
            parent::__construct($nombre, $email, $pass, $telefono, $ciudad);
           
        }
    
        public function guardar(){
            try{
                $sql = "INSERT INTO entidad_cultural (nombre_entidad_cultural, email_entidad_cultural, pass_entidad_cultural, telefono_entidad_cultural, ciudad_entidad_cultural) VALUES (?, ?, MD5(?), ?, ?)";
                $parametros = [$this->nombre, $this->email, $this->pass, $this->telefono, $this->ciudad];

                
                $this->id = $this->baseDatos->insertar($sql, $parametros);
                return $this->id;
                
    
            } catch (Throwable $excepcion) {

                http_response_code(500);
               
                throw $excepcion;
                
            }
        }

         public function emailRegistrado(){
            $sql = "SELECT COUNT(*) FROM entidad_cultural WHERE email_entidad_cultural = ?";
            $resultado = $this->baseDatos->seleccionar($sql, [$this->email]);
            return $resultado[0]["COUNT(*)"] > 0;
        }

    }