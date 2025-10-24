<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Check if the user is logged in and is an administrator
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'Administrador') {
    header('Location: ../auth/login.php');
    exit();
}

// Fetch statistics or data for the dashboard
$totalOrders = getTotalOrders(); // Function to get total orders
$totalUsers = getTotalUsers(); // Function to get total users
$totalMenuItems = getTotalMenuItems(); // Function to get total menu items

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Dashboard - Administrador</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <h1>Panel de Control - Administrador</h1>
        <div class="stats">
            <div class="stat">
                <h2>Total de Pedidos</h2>
                <p><?php echo $totalOrders; ?></p>
            </div>
            <div class="stat">
                <h2>Total de Usuarios</h2>
                <p><?php echo $totalUsers; ?></p>
            </div>
            <div class="stat">
                <h2>Total de Platos en el Menú</h2>
                <p><?php echo $totalMenuItems; ?></p>
            </div>
        </div>
        <div class="actions">
            <a href="menu_management.php" class="btn">Gestionar Menú</a>
            <a href="order_management.php" class="btn">Gestionar Pedidos</a>
        </div>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>