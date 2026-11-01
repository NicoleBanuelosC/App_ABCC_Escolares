<?php
    session_start();
    include('../controllers/alumno_dao.php');
    $alumnoDAO = new AlumnoDAO();

    // capturamos todos los campos enviados por POST desde el formulario
    $nc        = $_POST['caja_num_control'];
    $nombre    = $_POST['caja_nombre'];
    $primerAp  = $_POST['caja_primer_ap'];
    $segundoAp = $_POST['caja_segundo_ap'];
    $fechaNac  = $_POST['caja_fecha_nac'];
    $semestre  = $_POST['caja_semestre'];
    $carrera   = $_POST['caja_carrera'];

    /*
    Validaciones
    Suponiendo que el numero de control debe de ser numerico (cadena con numeros)
        - No vacios
        - Que exista la variable relacionada con el dato
        - Que sean solo numeros
    */

    $nc_correcto = false;

    // si el número de control no está vacío y es numérico
    if(isset($nc) && !empty($nc) && is_numeric($nc)){
        $nc_correcto = true;
    } else {
        $_SESSION['error_nc'] = true;
    }

    // creamos objeto alumno si es correcto
    if($nc_correcto){
        $res = $alumnoDAO->agregarAlumno($nc, $nombre, $primerAp, $segundoAp, $fechaNac, $semestre, $carrera);
        
        if($res) {
            $_SESSION['insercion_correcta'] = true;
            header('location: ../../frontend/formulario_altas.php');
            exit(); 
        } else {
            $_SESSION['insercion_correcta'] = false;
        }

    } else {
        // SI FALLA LA VALIDACION - guardamos TODOS los datos en la sesión para que no se borren
        $_SESSION['nc']        = $nc;
        $_SESSION['nombre']    = $nombre;
        $_SESSION['primer_ap'] = $primerAp;
        $_SESSION['segundo_ap']= $segundoAp;
        $_SESSION['fecha_nac'] = $fechaNac;
        $_SESSION['semestre']  = $semestre;
        $_SESSION['carrera']   = $carrera;

        header('location: ../../frontend/formulario_altas.php');
        exit();
    }//else
?>