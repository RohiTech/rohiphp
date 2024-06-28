<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel Principal</title>
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
      $("#clientes-link").click(function(event) {
        event.preventDefault(); // Previene el comportamiento por defecto del enlace

        $.ajax({
          url: "clientes.php", // Ruta al archivo clientes.php
          type: "GET", // Método de petición (GET o POST)
          success: function(data) {
            $("#clientes-section").html(data); // Reemplaza el contenido del div con la respuesta
          }
        });
      });

      $("#productos-link").click(function(event) {
        event.preventDefault(); // Previene el comportamiento por defecto del enlace

        $.ajax({
          url: "productos.php", // Ruta al archivo clientes.php
          type: "GET", // Método de petición (GET o POST)
          success: function(data) {
            $("#clientes-section").html(data); // Reemplaza el contenido del div con la respuesta
          }
        });
      });
    });
  </script>
</head>
<body>

  <header>
    <h1>Panel Principal - Punto de Venta</h1>
  </header>

  <nav>
    <ul>
      <li><a href="#">Inicio</a></li>
      <li><a href="#" id="clientes-link">Clientes</a></li>
      <li><a href="#" id="productos-link">Productos</a></li>
      <li><a href="#">Ventas</a></li>
      <li><a href="#">Reportes</a></li>
      <li><a href="#">Configuración</a></li>
    </ul>
  </nav>

  <main>
    <!-- Contenido principal de index.php -->
    <div id="clientes-section">
      <!-- Aquí se mostrará la tabla de clientes -->
    </div>
  </main>

  <footer>
    <!-- Footer del sitio -->
  </footer>

</body>
</html>