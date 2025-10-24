<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM usuario WHERE email = '$email'";
    $result = mysqli_query($conexion, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['contrasena'])) {
        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['rol'] = $user['id_rol'];
        header('Location: ../client/menu.php');
        exit();
    } else {
        $error = "Email o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" required>
            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>
            <button type="submit">Iniciar Sesión</button>
        </form>
        <p>¿No tienes una cuenta? <a href="register.php">Regístrate aquí</a></p>
    </div>
</body>
</html>