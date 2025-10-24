<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../auth/login.php');
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$usuario = obtenerUsuarioPorId($id_usuario); // Función que obtiene los datos del usuario

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];

    actualizarUsuario($id_usuario, $nombre, $telefono, $direccion, $email); // Función que actualiza los datos del usuario
    $usuario = obtenerUsuarioPorId($id_usuario); // Actualiza los datos del usuario después de la modificación
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Perfil del Cliente</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="container">
        <h1>Perfil del Cliente</h1>
        <form method="POST" action="">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>

            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono']); ?>">

            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($usuario['direccion']); ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>

            <button type="submit">Actualizar Perfil</button>
        </form>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>