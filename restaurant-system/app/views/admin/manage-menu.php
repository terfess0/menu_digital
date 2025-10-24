<?php
// manage-menu.php

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Administrador') {
    header('Location: /restaurant-system/app/views/auth/login.php');
    exit();
}

include_once '../../models/Menu.php';
$menuModel = new Menu();
$platos = $menuModel->obtenerPlatos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add') {
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $disponible = isset($_POST['disponible']) ? 1 : 0;
            $menuModel->insertarPlato($nombre, $precio, $disponible);
        } elseif ($_POST['action'] === 'edit') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $disponible = isset($_POST['disponible']) ? 1 : 0;
            $menuModel->actualizarPlato($id, $nombre, $precio, $disponible);
        } elseif ($_POST['action'] === 'delete') {
            $id = $_POST['id'];
            $menuModel->eliminarPlato($id);
        }
        header('Location: manage-menu.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <title>Gestionar Menú</title>
</head>
<body>
    <?php include '../templates/header.php'; ?>
    <h1>Gestionar Menú</h1>

    <form method="POST">
        <input type="hidden" name="action" value="add">
        <input type="text" name="nombre" placeholder="Nombre del Plato" required>
        <input type="number" name="precio" placeholder="Precio" required>
        <label>
            <input type="checkbox" name="disponible" checked> Disponible
        </label>
        <button type="submit">Agregar Plato</button>
    </form>

    <h2>Platos Disponibles</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Disponible</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($platos as $plato): ?>
                <tr>
                    <td><?php echo $plato['id']; ?></td>
                    <td><?php echo $plato['nombre']; ?></td>
                    <td><?php echo $plato['precio']; ?></td>
                    <td><?php echo $plato['disponible'] ? 'Sí' : 'No'; ?></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="<?php echo $plato['id']; ?>">
                            <input type="text" name="nombre" value="<?php echo $plato['nombre']; ?>" required>
                            <input type="number" name="precio" value="<?php echo $plato['precio']; ?>" required>
                            <label>
                                <input type="checkbox" name="disponible" <?php echo $plato['disponible'] ? 'checked' : ''; ?>> Disponible
                            </label>
                            <button type="submit">Actualizar</button>
                        </form>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $plato['id']; ?>">
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php include '../templates/footer.php'; ?>
</body>
</html>