<?php

    include_once('../backend/config/database/conexion_mysql_escuela.php');

    $con = new ConexionBDEscuela();
    $conexion = $con->getConexion();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $cadenaJSON = file_get_contents('php://input');

        if(!$cadenaJSON){
            echo "no hay cadena JSON";
        } else {
            $datos = json_decode($cadenaJSON, true);
            $nc = $datos['nc']; //numero de control
            $n = $datos['n']; //nombre
            $pa = $datos['pa']; //primer apellido
            $sa = $datos['sa']; //Segundo apellido
            $fn = $datos['fn']; //fecha nacimiento
            $s = $datos['s']; //semestre
            $c = $datos['c']; //carrera

            $sql = "INSERT INTO Alumnos VALUES ('$nc', '$n', '$pa', '$sa', '$fn', '$s', '$c')";

            $res = mysqli_query($conexion, $sql);

            $respuesta = array();
            if($res){
                $respuesta['alta'] = true;
            } else {
                $respuesta['alta'] = false;
            }

            echo json_encode($respuesta); //codificar la respuesta
        }
    }

?>