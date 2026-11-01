<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Registros</title>
</head>
<body>
    <?php require_once('menu_principal.php')?>

    <div class="container mt-4">
        <h3>Listado de alumnos</h3>
        
        <!-- BARRA DE BÚSQUEDA CON RADIO BUTTONS -->
        <form method="GET" action="" class="row g-3 mb-4 mt-2 align-items-center">
            <div class="col-auto">
                <label class="fw-bold text-secondary">Buscar por:</label>
            </div>
            <div class="col-auto">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="filtro" id="filtro_nc" value="nc" 
                        <?php echo (!isset($_GET['filtro']) || $_GET['filtro'] == 'nc') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="filtro_nc">Num. Control</label>
                </div>
            </div>
            <div class="col-auto">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="filtro" id="filtro_nombre" value="nombre"
                        <?php echo (isset($_GET['filtro']) && $_GET['filtro'] == 'nombre') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="filtro_nombre">Nombre</label>
                </div>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control form-control-sm" name="busqueda" 
                       value="<?php echo isset($_GET['busqueda']) ? $_GET['busqueda'] : ''; ?>" 
                       placeholder="Escribe lo que deseas buscar..." required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-sm px-3">Filtrar</button>
                <a href="bajas_cambios.php" class="btn btn-outline-secondary btn-sm">Ver Todos</a>
            </div>
        </form>

        <?php
            require_once __DIR__ . '/../backend/controllers/alumno_dao.php';      
            $alumnoDAO = new AlumnoDAO();

            // Si se usó el buscador, trae los filtrados; si no, trae todos.
            if (isset($_GET['busqueda']) && !empty($_GET['busqueda'])) {
                $filtro = $_GET['filtro'];
                $valor = $_GET['busqueda'];
                $datos = $alumnoDAO->buscarAlumnos($filtro, $valor);
            } else {
                $datos = $alumnoDAO->mostrarAlumnos();
            }

            if(mysqli_num_rows($datos) == 0) {
                echo "<div class='alert alert-warning mt-3'>No se encontraron registros</div>";
            } else {
                echo '<table class="table table-striped mt-3 align-middle">';
                echo '<thead>';
                echo '<tr>';
                echo '<th scope="col">No.</th>';
                echo '<th scope="col">Num. Control</th>';
                echo '<th scope="col">Nombre</th>';
                echo '<th scope="col">Primer Ap.</th>';
                echo '<th scope="col">Segundo Ap.</th>';
                echo '<th scope="col">ACCIONES</th>';
                echo '</tr>';                
                echo '</thead>';
                echo '<tbody>';

                $contador = 1;
                while($fila = mysqli_fetch_assoc($datos)){
                    printf( "<tr> 
                            <td>%d</td> 
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>
                            <td>%s</td>   
                            <td> 
                                <a href='detalle_alumno.php?nc=%s' class='btn btn-info btn-sm text-white'> DETALLE </a> | 
                                <a href='formulario_editar.php?nc=%s' class='btn btn-warning btn-sm'> EDITAR </a> | 
                                <a href='../backend/scripts/procesar_baja.php?nc=%s' class='btn btn-danger btn-sm'> ELIMINAR </a> 
                            </td>
                           </tr>",
                           $contador++,
                           $fila['Num_Control'],
                           $fila['nombre'],    
                           $fila['Primer_Ap'], 
                           $fila['Segundo_Ap'],
                           $fila['Num_Control'], // para DETALLE
                           $fila['Num_Control'], // para EDITAR
                           $fila['Num_Control']  // para ELIMINAR
                    );
                }
                echo '</tbody>';
                echo '</table>';
            }
        ?>
    </div>

</body>
</html>