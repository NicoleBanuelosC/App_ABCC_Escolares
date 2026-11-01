<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Sistema Escolar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-5">
              <div class="card shadow border-0 rounded-4">
                  <!-- Cabecera elegante -->
                  <div class="card-header bg-primary text-white text-center py-4 rounded-top-4">
                      <h3 class="mb-0 fw-bold">Sistema Escolar</h3>
                      <p class="mb-0 text-white-50 small mt-1">Ingresa tus credenciales</p>
                  </div>
                  
                  <div class="card-body p-4">
                        <form action="../backend/scripts/validar_usuario.php" method="POST">                          
                          <div class="mb-3">
                              <label for="caja_usuario" class="form-label fw-bold text-secondary">Usuario:</label>
                              <input type="text" class="form-control rounded-3 shadow-sm" name="caja_usuario" id="caja_usuario" placeholder="Ingresa tu usuario" required>
                          </div>

                          <div class="mb-3">
                              <label for="caja_password" class="form-label fw-bold text-secondary">Contraseña:</label>
                              <input type="password" class="form-control rounded-3 shadow-sm" name="caja_password" id="caja_password" placeholder="Ingresa tu contraseña" required>
                          </div>

                          <div class="d-grid mt-4">
                              <button type="submit" class="btn btn-primary py-2 rounded-pill shadow-sm fw-bold">Iniciar Sesión</button>
                          </div>

                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>

</body>
</html>