<?php
include('../controllers/alumno_dao.php');
$alumnoDAO = new AlumnoDAO();

if (isset($_POST['caja_num_control']) && isset($_POST['caja_nombre'])) {
    $nc = $_POST['caja_num_control'];
    $nombre = $_POST['caja_nombre'];
    $primerAp = $_POST['caja_primer_ap'];
    $segundoAp = $_POST['caja_segundo_ap'];
    $fechaNac = $_POST['caja_fecha_nac'];
    $semestre = $_POST['caja_semestre'];
    $carrera = $_POST['caja_carrera'];

    // se manda llamar con los datos que se piden en el formualrio o que salen en el formulario
    $res = $alumnoDAO->modificarAlumno($nc, $nombre, $primerAp, $segundoAp, $fechaNac, $semestre, $carrera);

    if ($res) {
        header('location: ../../frontend/bajas_cambios.php');
        exit();
    } else {
        echo "Error al intentar actualizar el registro en la base de datos";
    }

} else {
    echo "Faltan datos obligatorios para procesar la modificación.";
}
?>