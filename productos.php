<?php

// Incluimos el archivo de conexión a la base de datos
require_once 'db_connect.php';

// Obtener datos de la base de datos para productos
$sql = "SELECT * FROM productos WHERE estado = 1"; 
$result = mysqli_query($conn, $sql);

// Paginación para productos (si es necesario)
$resultadosPorPagina = 10;
$totalResultados = mysqli_num_rows($result);
$numeroPaginas = ceil($totalResultados / $resultadosPorPagina);
$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$inicio = ($paginaActual - 1) * $resultadosPorPagina;

// Volver a ejecutar la consulta con el límite para la paginación
$sql = "SELECT * FROM productos WHERE estado = 1 LIMIT $inicio, $resultadosPorPagina";
$result = mysqli_query($conn, $sql);

?>

<!-- Tabla HTML para productos -->
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Código</th>
      <th>Nombre</th>
      <th>Descripción</th>
      <th>Precio Compra</th>
      <th>Precio Venta</th>
      <th>Stock</th>
      <th>Categoría</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['codigo']; ?></td>
        <td><?php echo $row['nombre']; ?></td>
        <td><?php echo $row['descripcion']; ?></td>
        <td><?php echo $row['precio_compra']; ?></td>
        <td><?php echo $row['precio_venta']; ?></td>
        <td><?php echo $row['stock']; ?></td>
        <td><?php echo $row['categoria_id']; ?></td>
        <td>
          <div class="crud-icons">
            <a href="editar_producto.php?id=<?php echo $row['id']; ?>" title="Editar"><span class="material-icons">edit</span></a>
            <a href="eliminar_producto.php?id=<?php echo $row['id']; ?>" title="Eliminar" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?')"><span class="material-icons">delete</span></a>
          </div>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<!-- Paginación (si es necesario) -->
<div class="pagination">
  <?php for ($i = 1; $i <= $numeroPaginas; $i++) : ?>
    <a href="?pagina=<?php echo $i; ?>" <?php if ($i == $paginaActual) echo 'class="active"'; ?>><?php echo $i; ?></a>
  <?php endfor; ?>
</div>