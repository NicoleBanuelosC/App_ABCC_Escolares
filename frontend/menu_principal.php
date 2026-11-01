<?php
    session_start();
    
    if(!isset($_SESSION['usuario_autenticado']) || $_SESSION['usuario_autenticado'] !== true) {
        header('location: login.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABBC ESCOLARES</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
    
<div class="container my-4">
    <!-- aqui es la barra de navegacion principal con el menú, la bienvenida y el botón de salir -->
    <nav class="navbar navbar-expand-md navbar-light bg-white rounded shadow-sm px-4 py-3 border">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold text-primary" href="menu_principal.php">ITSJ</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link active fw-semibold" aria-current="page" href="formulario_altas.php">AGREGAR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="bajas_cambios.php">ELIMINAR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="#">MODIFICAR</a>
                    </li>
                    
                    <!-- menu desplegable -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Menu
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- bienvenidx nombreUsuario y cerrar sesion -->
                <div class="d-flex align-items-center gap-3 mt-3 mt-md-0">
                    <span class="text-secondary small">
                        Bienvenido, <span class="text-dark fw-bold"><?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?></span>
                    </span>
                    <a href="../backend/scripts/cerrar_sesion.php" class="btn btn-outline-danger btn-sm px-3">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>