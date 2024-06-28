<?php

// Incluimos el archivo de conexión a la base de datos
require_once 'db_connect.php';

// Obtener el valor de búsqueda enviado por AJAX
$busqueda = isset($_POST['busqueda']) ? $_POST['busqueda'] : "";

// Consulta SQL para filtrar los clientes
$sql = "SELECT * FROM clientes 
        WHERE estado = 1 
        AND (nombre LIKE '%$busqueda%' 
        OR apellido LIKE '%$busqueda%' 
        OR dni LIKE '%$busqueda%')";

$result = mysqli_query($conn, $sql);

// Generar el cuerpo de la tabla HTML con los clientes filtrados
echo "<tbody>";
while ($row = mysqli_fetch_assoc($result)) :
?>
  <tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['nombre']; ?></td>
    <td><?php echo $row['apellido']; ?></td>
    <td><?php echo $row['dni']; ?></td>
    <td><?php echo $row['telefono']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td>
      <div class="crud-icons">
        <a href="editar_cliente.php?id=<?php echo $row['id']; ?>" title="Editar"><span class="material-icons">edit</span></a>
        <a href="eliminar_cliente.php?id=<?php echo $row['id']; ?>" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este cliente?')"><span class="material-icons">delete</span></a>
      </div>
    </td>
  </tr>
<?php
endwhile;
echo "</tbody>";

?>