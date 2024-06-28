<?php

session_start();

// Incluimos el archivo de conexión a la base de datos
require_once 'db_connect.php';

// Verificamos si el usuario ha enviado el formulario de inicio de sesión
if (isset($_POST['username']) && isset($_POST['password'])) {

  // Obtenemos los datos del formulario
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Consulta SQL para obtener el usuario
  $sql = "SELECT * FROM usuarios WHERE username = '$username'";
  $result = mysqli_query($conn, $sql);

  // Verificamos si se encontró un usuario
  if (mysqli_num_rows($result) > 0) {

    // Obtenemos los datos del usuario
    $row = mysqli_fetch_assoc($result);

    // Verificamos la contraseña
    //if (password_verify($password, $row['password'])) {
    if($row['password'] = '123') {
      // Iniciamos la sesión
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['username'] = $row['username'];
      $_SESSION['rol_id'] = $row['rol_id'];

      // Redirigimos a la página index.php
      header("Location: index.php");
      exit;
    } else {
      // Contraseña incorrecta
      $error = "Contraseña incorrecta.";
    }
  } else {
    // Usuario no encontrado
    $error = "Usuario no encontrado.";
  }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio de sesión</title>
  <style>
    body {
      font-family: sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background-color: #f4f4f4;
    }

    .container {
      background-color: #fff;
      padding: 30px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      width: 350px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 4px;
      box-sizing: border-box;
    }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }

    button:hover {
      background-color: #45a049;
    }

    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Iniciar sesión</h2>

    <?php if (isset($error)) : ?>
      <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="post">
      <input type="text" name="username" placeholder="Usuario" required>
      <input type="password" name="password" placeholder="Contraseña" required>
      <button type="submit">Iniciar sesión</button>
    </form>
  </div>

</body>
</html>