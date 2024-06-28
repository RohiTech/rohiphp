<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clientes</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <style>
    /* Estilos generales para index.php */
    body {
      font-family: sans-serif;
      background-color: #ADD8E6; /* Celeste cielo */
    }

    header {
      background-color: #007bff; /* Azul llamativo */
      padding: 10px;
      text-align: center;
      color: white;
    }

    nav ul {
      list-style: none;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      gap: 20px;
    }

    nav li {
      margin: 0 10px;
    }

    nav a {
      text-decoration: none;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      background-color: #0056b3; /* Azul más oscuro */
      transition: background-color 0.3s; /* Efecto de transición */
    }

    nav a:hover {
      background-color: #004080; /* Azul aún más oscuro */
    }

    /* Estilos para la tabla de clientes */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      text-align: left;
      padding: 8px;
      border: 1px solid #ddd;
    }

    th {
      background-color: #f0f0f0;
    }

    .crud-icons {
      display: flex;
      gap: 10px;
    }

    .crud-icons a {
      text-decoration: none;
      color: black;
      font-size: 20px;
    }

    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 20px;
    }

    .pagination a {
      padding: 8px 16px;
      border: 1px solid #ddd;
      margin: 0 4px;
      text-decoration: none;
      color: black;
    }

    .pagination a.active {
      background-color: #ddd;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#busqueda").keyup(function() {
        var busqueda = $(this).val(); // Obtener el valor del campo de búsqueda
        
        $.ajax({
          url: "clientes_filtrado.php", // Ruta al archivo que procesa la búsqueda
          type: "POST", // Método de petición (POST)
          data: { busqueda: busqueda }, // Datos a enviar
          success: function(data) {
            $("#clientes-table tbody").html(data); // Reemplaza el contenido del cuerpo de la tabla
          }
        });
      });
    });
  </script>
</head>
<body>

  <main>
    <!-- Contenido principal de index.php -->
    <div id="clientes-section">
      <div class="buscador">
        <input type="text" id="busqueda" placeholder="Buscar por nombre, apellido o DNI...">
      </div>
      <table id="clientes-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>DNI</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <!-- Aquí se cargará el cuerpo de la tabla desde clientes_filtrado.php -->
        </tbody>
      </table>
    </div>
  </main>

  <footer>
    <!-- Footer del sitio -->
  </footer>

</body>
</html>