<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Alumno</title>
</head>
<body>
    <?php require_once('menu_principal.php'); ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php
                    require_once __DIR__ . '/../backend/controllers/alumno_dao.php';
                    $alumnoDAO = new AlumnoDAO();

                    $alumno = null;
                    if (isset($_GET['nc'])) {
                        $nc = $_GET['nc'];
                        $alumno = $alumnoDAO->buscarAlumno($nc);
                    }

                    if ($alumno) {
                ?>
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-dark text-white text-center py-3">
                        <h3 class="mb-0">Datos del alumno</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold text-muted">Número de Control:</div>
                            <div class="col-sm-8 text-dark fw-bold"><?php echo $alumno['Num_Control']; ?></div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold text-muted">Nombre:</div>
                            <div class="col-sm-8 text-dark"><?php echo $alumno['nombre']; ?></div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold text-muted">Primer Apellido:</div>
                            <div class="col-sm-8 text-dark"><?php echo $alumno['Primer_Ap']; ?></div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold text-muted">Segundo Apellido:</div>
                            <div class="col-sm-8 text-dark"><?php echo $alumno['Segundo_Ap']; ?></div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold text-muted">Fecha de Nacimiento:</div>
                            <div class="col-sm-8 text-dark"><?php echo $alumno['Fecha_Nac']; ?></div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold text-muted">Semestre:</div>
                            <div class="col-sm-8 text-dark"><?php echo $alumno['Semestre']; ?></div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-sm-4 fw-bold text-muted">Carrera:</div>
                            <div class="col-sm-8 text-dark"><?php echo $alumno['Carrera']; ?></div>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-center py-3">
                        <a href="bajas_cambios.php" class="btn btn-secondary px-4">Regresar al Listado</a>
                    </div>
                </div>
                <?php
                    } else {
                        echo "<div class='alert alert-danger text-center shadow'>No se encontró información registrada para este alumno.</div>";
                        echo "<div class='text-center mt-3'><a href='bajas_cambios.php' class='btn btn-secondary'>Regresar</a></div>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>