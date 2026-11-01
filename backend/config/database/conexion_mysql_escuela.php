<?php

    //PDO
    class ConexionBDEscuela{
        private $conexion;
        private $host = "localhost:3306";
        private $usuario = "nicole";
        private $password = "2021";
        private $bd = "BD_Escuela_Web_2026";

        public function __construct(){
            $this->conexion = mysqli_connect($this->host, $this->usuario, $this->password, $this->bd);

            if (!$this->conexion){
                die ("Error en la conexion con MySQL: " . mysqli_connect_error());
            }//if

        }//function__construct

        public function getConexion(){
            return $this->conexion;
        }

    }//class

?>