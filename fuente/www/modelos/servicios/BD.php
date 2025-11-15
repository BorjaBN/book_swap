<?php

class BD{

    private $conexion;

    public function __construct (){
       
         try {

            $config = require('../../config.php');
            $host = $config['bd_host'];
            $nombre = $config['bd_nombre'];
            $usuario = $config['bd_usuario'];
            $clave = $config['bd_clave'];
            $stringConexion = "mysql:host=$host;dbname=$nombre";

            $this->conexion = new PDO($stringConexion, $usuario, $clave);
            $this->conexion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (Throwable $excepcion) {

            http_response_code(500);
            if ($config['debug']){
                echo "Error en modelos/servicios/BD.php: ".$excepcion;
            }
        }
    }

    public function insertar($sql, $parametros){
         // Preparar la sentencia (ya tenemos la conexión en $pdo)
            $sentencia = $this->conexion->prepare($sql);
                
        // Ejecutar con los parámetros
            $sentencia->execute($parametros);
                
        // Obtener el ID del último registro insertado
            return $this->conexion->lastInsertId();

    }

    public function seleccionar($sql, $parametros = null){
        $sentencia = $this->conexion->prepare($sql);
        $sentencia->execute($parametros);
        return $sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

}