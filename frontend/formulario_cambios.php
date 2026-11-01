<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Registros</title>
</head>

<body>
<form action="../backend/scripts/procesar_altas.php" method="post">
  
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="caja_num_control">Numero de control: </label>
      <input type="text" class="form-control" name="caja_num_control" 
      id="caja_num_control" placeholder="Numero de control">
    </div>

    <div class="form-group col-md-6">
      <label for="caja_nombre">Nombre: </label>
      <input type="text" class="form-control" name="caja_nombre" id="caja_nombre" 
      placeholder="Nombre">
    </div>
  </div>

  <div class="form-group">
    <label for="inputAddress">Address: </label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>

  <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>

  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>

  <button type="submit" class="btn btn-primary">Sign in</button>
</form>

</body>
</html>