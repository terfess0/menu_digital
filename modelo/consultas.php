<?php
include("database.php");

// Obtener platos por categoría (si tienes columna categoria, o usa id_menu)
function obtenerPlatosPorCategoria($conn, $categoria) {
  $sql = "SELECT id_plato, nombre, descripcion, precio 
          FROM plato 
          WHERE disponible = 1";
  $resultado = mysqli_query($conn, $sql);
  return $resultado;
}

// Obtener todas las categorías (solo si tienes una columna 'categoria' o 'menu')
function obtenerCategorias($conn) {
  $sql = "SELECT DISTINCT id_menu FROM plato";
  return mysqli_query($conn, $sql);
}

// Obtener un plato específico
function obtenerPlatoPorId($conn, $id_plato) {
  $sql = "SELECT * FROM plato WHERE id_plato = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $id_plato);
  mysqli_stmt_execute($stmt);
  $resultado = mysqli_stmt_get_result($stmt);
  return mysqli_fetch_assoc($resultado);
}
?>
