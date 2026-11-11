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
            $nc = $datos['nc']; 
            $n = $datos['n'];   
            $pa = $datos['pa']; 
            $sa = $datos['sa']; 
            $fn = $datos['fn']; 
            $s = $datos['s'];   
            $c = $datos['c'];   

            $sql = "UPDATE Alumnos SET nombre = '$n', Primer_Ap = '$pa', Segundo_Ap = '$sa', Fecha_Nac = '$fn', Semestre = '$s', Carrera = '$c' WHERE Num_Control = '$nc'";

            $res = mysqli_query($conexion, $sql);

            $respuesta = array();
            if($res){
                $respuesta['cambio'] = true;
            } else {
                $respuesta['cambio'] = false;
            }

            echo json_encode($respuesta);
        }
    }

?>