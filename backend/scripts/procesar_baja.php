<?php 
    include_once('../controllers/alumno_dao.php');
    $alumnoDAO = new AlumnoDAO();

    if (isset($_GET['nc'])) {
        $nc = $_GET['nc'];

        if($alumnoDAO->eliminarAlumno($nc)){
            header('location:../../frontend/bajas_cambios.php');
            exit();
        } else {
            echo "Error al intentar eliminar el registro en la base de datos.";
        }
    } else {
        echo "No se especificó el número de control del alumno.";
    }
?>