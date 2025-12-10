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

        /**
         * Autentica al usuario en el sistema.
         *
         * Verifica si existe un registro en la base de datos con el nombre y la clave proporcionados.
         * La clave se valida mediante la función MD5 en la consulta SQL.
         *
         * @return int|null Devuelve el identificador del usuario si la autenticación es exitosa,
         *                  o null si las credenciales no son válidas.
         */
        public function autenticar(){

            $baseDatos = new BD();

	        $sql = "SELECT id
	            	FROM entidad_cultural 
					WHERE email_entidad_cultural = ? AND pass_entidad_cultural = MD5(?)";

            $parametros = [$this->nombre, $this->pass];        
			$resultado = $baseDatos->seleccionarTodos($sql, $parametros);
            
			if (!empty($resultado)) {
                
                $this->id = $resultado[0]['id'];
                return $this->id;
            }

           
            return null;
      
	    }

    }