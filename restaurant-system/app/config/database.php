<?php
$host = "localhost";
$user = "colminds_menu_d";
$password = "Menud123456789";
$dbname = "menu_digital";

$connection = mysqli_connect($host, $user, $password, $dbname);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>