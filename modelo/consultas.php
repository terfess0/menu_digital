<?php
include("database.php");

// Obtener todos los platos por categoría
function obtenerPlatosPorCategoria($conn, $categoria) {
  $sql = "SELECT id_plato, nombre, descripcion, precio, imagen 
          FROM plato 
          WHERE categoria = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $categoria);
  mysqli_stmt_execute($stmt);
  $resultado = mysqli_stmt_get_result($stmt);
  return $resultado;
}

// Obtener todas las categorías disponibles (si quieres generar el menú dinámicamente)
function obtenerCategorias($conn) {
  $sql = "SELECT DISTINCT categoria FROM platos ORDER BY categoria ASC";
  return mysqli_query($conn, $sql);
}

// Obtener un plato específico
function obtenerPlatoPorId($conn, $id_plato) {
  $sql = "SELECT * FROM platos WHERE id_plato = ?";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "i", $id_plato);
  mysqli_stmt_execute($stmt);
  $resultado = mysqli_stmt_get_result($stmt);
  return mysqli_fetch_assoc($resultado);
}
?>
