<?php

    class EntidadCultural extends Usuario {

        public function __construct (string $nombre, string $email, string $pass, string $telefono, string $ciudad){
            parent::__construct(string $nombre, string $email, string $pass, string $telefono, string $ciudad);
           
        }
    
        public function guardar(){
            try{
                $sql = "INSERT INTO entidad_cultural (nombre_entidad_cultural, email_entidad_cultural, pass_entidad_cultural, telefono_entidad_cultural, ciudad_entidad_cultural) VALUES (?, ?, ?, ?, ?)";
                $parametros = [$this->nombre, $this->email, $this->pass, $this->telefono, $this->ciudad];

                $this->id = $this->base_datos->insertar($sql, $parametros);
                return $this->id;
    
            } catch (Throwable $excepcion) {
                
               http_response_code(500); 

               if ($config['debug']){
                    echo "Error en modelos/EntidadCultural.php:".$excepcion;
                }
            }
        }

    }
