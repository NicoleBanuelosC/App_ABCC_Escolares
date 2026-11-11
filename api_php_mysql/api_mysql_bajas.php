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
            
            $nc = isset($datos['nc']) ? $datos['nc'] : '';
            $n = isset($datos['n']) ? $datos['n'] : ''; // nombre


            $sql = "DELETE FROM Alumnos WHERE Num_Control = '$nc' OR nombre = '$n'";

            $res = mysqli_query($conexion, $sql);

            $respuesta = array();
            if($res){
                if(mysqli_affected_rows($conexion) > 0){
                    $respuesta['baja'] = true;
                    $respuesta['mensaje'] = "Alumno eliminado correctamente.";
                } else {
                    $respuesta['baja'] = false;
                    $respuesta['mensaje'] = "No se encontró ningún alumno con esos datos.";
                }
            } else {
                $respuesta['baja'] = false;
                $respuesta['mensaje'] = "Error en la consulta SQL.";
            }

            echo json_encode($respuesta);
        }
    }

?>