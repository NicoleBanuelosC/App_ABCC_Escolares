<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Alumno</title>
</head>
<body>

  <?php require_once('menu_principal.php'); ?>

  <!-- avisa al usuario que lo que realizo lo hizo correctamente y manda un aviso de ello -->  
  <div class="container"
  style="display: <?php echo isset($_SESSION['insercion_correcta']) ? 'content' : 'none' ?> ;">
    <div class="alert alert-success" role="alert">
        Alumno agregado con EXITO
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
    </div>
  </div>

  <div class="container mt-5 mb-5">
      <div class="row justify-content-center">
          <div class="col-md-9">
              <div class="card shadow border-0 rounded-4">
                  <!-- inicio de la pagina -->
                  <div class="card-header bg-primary text-white text-center py-3 rounded-top-4">
                      <h4 class="mb-0 fw-bold">Registro de Nuevo Alumno</h4>
                  </div>
                  
                  <div class="card-body p-4">
                      <form action="../backend/scripts/procesar_altas.php" method="post">
                          
                          <div class="row mb-3">
                              <div class="col-md-6">
                                  <label for="caja_num_control" class="form-label fw-bold text-secondary">Número de Control:</label>
                                  <input type="text" class="form-control rounded-3 shadow-sm" name="caja_num_control" id="caja_num_control"
                                       value="<?php echo isset($_SESSION['nc']) ? $_SESSION['nc'] : ''; ?>" 
                                       placeholder="Ej. ISC2201" pattern="[A-Za-z0-9]+" 
                                       title="Solo se permiten letras y números, sin espacios ni caracteres especiales." required>
                              </div>

                              <div style="color: <?php echo (isset($_SESSION['error_nc'])) ? 'red' : 'black'; ?>">
                                    <?php echo isset($_SESSION['error_nc']) ? 'Debes ingresar solo numeros' : ''; ?>
                              </div>

                              <div class="col-md-6">
                                  <label for="caja_nombre" class="form-label fw-bold text-secondary">Nombre:</label>
                                  <input type="text" class="form-control rounded-3 shadow-sm" name="caja_nombre" id="caja_nombre" 
                                         value="<?php echo isset($_SESSION['nombre']) ? $_SESSION['nombre'] : ''; ?>"
                                         placeholder="Nombre(s)" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" 
                                         title="Solo se permiten letras." required>
                              </div>
                          </div>

                          <div class="row mb-3">
                              <div class="col-md-6">
                                  <label for="caja_primer_ap" class="form-label fw-bold text-secondary">Primer Apellido:</label>
                                  <input type="text" class="form-control rounded-3 shadow-sm" name="caja_primer_ap" id="caja_primer_ap" 
                                         value="<?php echo isset($_SESSION['primer_ap']) ? $_SESSION['primer_ap'] : ''; ?>"
                                         placeholder="Primer apellido" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" 
                                         title="Solo se permiten letras." required>
                              </div>
                              <div class="col-md-6">
                                  <label for="caja_segundo_ap" class="form-label fw-bold text-secondary">Segundo Apellido:</label>
                                  <input type="text" class="form-control rounded-3 shadow-sm" name="caja_segundo_ap" id="caja_segundo_ap" 
                                         value="<?php echo isset($_SESSION['segundo_ap']) ? $_SESSION['segundo_ap'] : ''; ?>"
                                         placeholder="Segundo apellido (opcional)" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" 
                                         title="Solo se permiten letras.">
                              </div>
                          </div>

                          <div class="row mb-3">
                              <div class="col-md-4">
                                  <label for="caja_fecha_nac" class="form-label fw-bold text-secondary">Fecha de Nacimiento:</label>
                                  <input type="date" class="form-control rounded-3 shadow-sm" name="caja_fecha_nac" id="caja_fecha_nac" 
                                         value="<?php echo isset($_SESSION['fecha_nac']) ? $_SESSION['fecha_nac'] : ''; ?>" required>
                              </div>
                              <div class="col-md-4">
                                  <label for="caja_semestre" class="form-label fw-bold text-secondary">Semestre:</label>
                                  <input type="number" class="form-control rounded-3 shadow-sm" name="caja_semestre" id="caja_semestre" 
                                         value="<?php echo isset($_SESSION['semestre']) ? $_SESSION['semestre'] : ''; ?>"
                                         min="1" max="12" placeholder="Ej. 9" required>
                              </div>
                              <div class="col-md-4">
                                  <label for="caja_carrera" class="form-label fw-bold text-secondary">Carrera:</label>
                                  <input type="text" class="form-control rounded-3 shadow-sm" name="caja_carrera" id="caja_carrera" 
                                         value="<?php echo isset($_SESSION['carrera']) ? $_SESSION['carrera'] : ''; ?>"
                                         placeholder="Ej. ISC" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+" 
                                         title="Solo se permiten letras." required>
                              </div>
                          </div>

                          <!-- botones mas bonitos -->
                          <div class="d-flex justify-content-end gap-2 mt-4">
                              <a href="bajas_cambios.php" class="btn btn-outline-secondary px-4 rounded-pill">Cancelar</a>
                              <button type="submit" class="btn btn-success px-4 rounded-pill shadow-sm">Guardar Alumno</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>

</body>
</html>

<!-- sirve para limpiar y borrar las variables de la sesion ya cuadno se han mostrado en la pantalla -->
<?php
    unset($_SESSION['insercion_correcta']);
    unset($_SESSION['error_nc']);
    unset($_SESSION['nc']);
    unset($_SESSION['nombre']);
    unset($_SESSION['primer_ap']);
    unset($_SESSION['segundo_ap']);
    unset($_SESSION['fecha_nac']);
    unset($_SESSION['semestre']);
    unset($_SESSION['carrera']);
?>