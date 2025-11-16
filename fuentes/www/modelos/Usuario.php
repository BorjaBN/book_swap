<?php

    /**Modelo Usuario
     *   Responsabilidad:
     *  -Representa a un usuario 
     *  - Sirve como plantilla
     *  -Gestiona la persistencia
     */

    abstract class Usuario {
        protected $id;
        protected $nombre;
        protected $email;
        protected $pass;
        protected $telefono;
        protected $ciudad;
        protected $id_admin;
        protected $baseDatos;

        public function __construct(string $nombre, string $email, string $pass, string $telefono, string $ciudad, int $id_admin){

            $this->id = null;
            $this->nombre = $nombre;
            $this->email = $email;
            $this->pass = $pass;
            $this->telefono = $telefono;
            $this->ciudad = $ciudad;
            $this->id_admin = $id_admin;
            $this->baseDatos = new BD();

        }

        abstract public function guardar(); //Aquí

    }