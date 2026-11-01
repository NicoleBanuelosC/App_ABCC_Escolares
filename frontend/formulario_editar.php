<?php
    require_once __DIR__ . '/../backend/controllers/alumno_dao.php';
    $alumnoDAO = new AlumnoDAO();

    // Obtenemos el número de control que viene por la URL (GET)
    $nc = isset($_GET['nc']) ? $_GET['nc'] : '';
    $alumno = $alumnoDAO->buscarAlumno($nc);

    if (!$alumno) {
        echo "Alumno no encontrado.";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Alumno</title>
</head>
<body>

  <?php require_once('menu_principal.php')?>

  <div class="container mt-5 mb-5">
      <div class="row justify-content-center">
          <div class="col-md-9">
              <div class="card shadow border-0 rounded-4">
                  <!-- Cabecera elegante en tono amarillo/advertencia para edición -->
                  <div class="card-header bg-warning text-dark text-center py-3 rounded-top-4">
                      <h4 class="mb-0 fw-bold">Modificar Datos del Alumno</h4>
                  </div>
                  
                  <div class="card-body p-4">
                      <form action="../backend/scripts/procesar_modificacion.php" method="post">
                          
                          <div class="row mb-3">
                              <div class="col-md-6">
                                  <label for="caja_num_control" class="form-label fw-bold text-secondary">Número de Control:</label>
                                  <!-- El número de control va en readonly porque es la clave primaria -->
                                  <input type="text" class="form-control rounded-3 shadow-sm bg-light" name="caja_num_control" id="caja_num_control" 
                                         value="<?php echo htmlspecialchars($alumno['Num_Control']); ?>" readonly>
                                  <div class="form-text text-muted">El número de control no se puede modificar por ser clave primaria.</div>
                              </div>
                              <div class="col-md-6">
                                  <label for="caja_nombre" class="form-label fw-bold text-secondary">Nombre:</label>
                                  <input type="text" class="form-control rounded-3 shadow-sm" name="caja_nombre" id="caja_nombre" 
                                         value="<?php echo htmlspecialchars($alumno['nombre']); ?>" 
                                         pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" 
                                         title="Solo se permiten letras." required>
                              </div>
                          </div>

                          <div class="row mb-3">
                              <div class="col-md-6">
                                  <label for="caja_primer_ap" class="form-label fw-bold text-secondary">Primer Apellido:</label>
                                  <input type="text" class="form-control rounded-3 shadow-sm" name="caja_primer_ap" id="caja_primer_ap" 
                                         value="<?php echo htmlspecialchars($alumno['Primer_Ap']); ?>" 
                                         pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" 
                                         title="Solo se permiten letras." required>
                              </div>
                              <div class="col-md-6">
                                  <label for="caja_segundo_ap" class="form-label fw-bold text-secondary">Segundo Apellido:</label>
                                  <input type="text" class="form-control rounded-3 shadow-sm" name="caja_segundo_ap" id="caja_segundo_ap" 
                                         value="<?php echo htmlspecialchars($alumno['Segundo_Ap']); ?>" 
                                         pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" 
                                         title="Solo se permiten letras.">
                              </div>
                          </div>

                          <div class="row mb-3">
                              <div class="col-md-4">
                                  <label for="caja_fecha_nac" class="form-label fw-bold text-secondary">Fecha de Nacimiento:</label>
                                  <input type="date" class="form-control rounded-3 shadow-sm" name="caja_fecha_nac" id="caja_fecha_nac" 
                                         value="<?php echo htmlspecialchars($alumno['Fecha_Nac']); ?>" required>
                              </div>
                              <div class="col-md-4">
                                  <label for="caja_semestre" class="form-label fw-bold text-secondary">Semestre:</label>
                                  <input type="number" class="form-control rounded-3 shadow-sm" name="caja_semestre" id="caja_semestre" 
                                         min="1" max="12" value="<?php echo htmlspecialchars($alumno['Semestre']); ?>" required>
                              </div>
                              <div class="col-md-4">
                                  <label for="caja_carrera" class="form-label fw-bold text-secondary">Carrera:</label>
                                  <input type="text" class="form-control rounded-3 shadow-sm" name="caja_carrera" id="caja_carrera" 
                                         value="<?php echo htmlspecialchars($alumno['Carrera']); ?>" 
                                         pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" 
                                         title="Solo se permiten letras." required>
                              </div>
                          </div>

                          <!-- Botones con estilo moderno -->
                          <div class="d-flex justify-content-end gap-2 mt-4">
                              <a href="bajas_cambios.php" class="btn btn-outline-secondary px-4 rounded-pill">Cancelar</a>
                              <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Guardar Cambios</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>

</body>
</html>