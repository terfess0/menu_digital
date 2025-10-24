<?php
$host = "localhost";
$user = "colmind_menu_d";
$pass = "Menud123456789";
$db   = "colminds_menu_digital";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  die("Error de conexión: " . mysqli_connect_error());
}
?>





