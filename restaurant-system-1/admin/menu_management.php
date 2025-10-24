<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'Administrador') {
    header('Location: ../auth/login.php');
    exit();
}

// Handle adding a new menu item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_menu_item'])) {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $disponible = isset($_POST['disponible']) ? 1 : 0;

    $query = "INSERT INTO plato (id_menu, nombre, descripcion, precio, disponible) VALUES (1, '$nombre', '$descripcion', '$precio', '$disponible')";
    mysqli_query($conexion, $query);
}

// Handle editing a menu item
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_menu_item'])) {
    $id_plato = $_POST['id_plato'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $disponible = isset($_POST['disponible']) ? 1 : 0;

    $query = "UPDATE plato SET nombre='$nombre', descripcion='$descripcion', precio='$precio', disponible='$disponible' WHERE id_plato='$id_plato'";
    mysqli_query($conexion, $query);
}

// Handle deleting a menu item
if (isset($_GET['delete'])) {
    $id_plato = $_GET['delete'];
    $query = "DELETE FROM plato WHERE id_plato='$id_plato'";
    mysqli_query($conexion, $query);
}

// Fetch menu items
$query = "SELECT * FROM plato WHERE id_menu = 1";
$result = mysqli_query($conexion, $query);
$platos = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Menú</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>Gestión de Menú</h1>

    <form method="POST">
        <h2>Agregar Plato</h2>
        <input type="text" name="nombre" placeholder="Nombre" required>
        <textarea name="descripcion" placeholder="Descripción"></textarea>
        <input type="number" name="precio" placeholder="Precio" required>
        <label>
            <input type="checkbox" name="disponible" checked> Disponible
        </label>
        <button type="submit" name="add_menu_item">Agregar</button>
    </form>

    <h2>Platos Disponibles</h2>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($platos as $plato): ?>
        <tr>
            <td><?php echo $plato['nombre']; ?></td>
            <td><?php echo $plato['descripcion']; ?></td>
            <td><?php echo $plato['precio']; ?></td>
            <td>
                <a href="?edit=<?php echo $plato['id_plato']; ?>">Editar</a>
                <a href="?delete=<?php echo $plato['id_plato']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este plato?');">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php include '../includes/footer.php'; ?>
</body>
</html>