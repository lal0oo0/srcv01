<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Mapa de Asientos - Sala de Cine</title>
  <style>
    /* Estilo adicional para resaltar los asientos ocupados */
    .asiento-ocupado {
      background-color: #dc3545; /* Rojo */
      color: #fff;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <h2 class="text-center">Mapa de Asientos - Sala de Cine</h2>

  <div class="row">
    <div class="col-md-6 offset-md-3">
      <!-- Fila 1 -->
      <div class="mb-2">
        <div class="d-inline-block mx-1 asiento">1</div>
        <div class="d-inline-block mx-1 asiento asiento-ocupado">2</div>
        <div class="d-inline-block mx-1 asiento">3</div>
        <!-- Agrega más asientos según sea necesario -->
      </div>

      <!-- Fila 2 -->
      <div class="mb-2">
        <div class="d-inline-block mx-1 asiento">4</div>
        <div class="d-inline-block mx-1 asiento">5</div>
        <div class="d-inline-block mx-1 asiento">6</div>
        <!-- Agrega más asientos según sea necesario -->
      </div>

      <!-- Agrega más filas según sea necesario -->

    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
