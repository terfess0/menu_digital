<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $id_rol = 1; // Assuming 1 is the role ID for 'Cliente'

    $query = "INSERT INTO usuario (nombre, telefono, direccion, email, contrasena, id_rol) VALUES ('$nombre', '$telefono', '$direccion', '$email', '$contrasena', $id_rol)";
    
    if (mysqli_query($conexion, $query)) {
        header('Location: login.php?success=1');
        exit();
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Registro</title>
</head>
<body>
    <div class="container">
        <h2>Registro de Usuario</h2>
        <form action="register.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required>
            
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
            
            <button type="submit">Registrarse</button>
        </form>
        <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a>.</p>
    </div>
</body>
</html>