<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Administrator') {
    header('Location: /restaurant-system/app/views/auth/login.php');
    exit();
}

// Fetch statistics or data to display on the dashboard
// This is a placeholder for actual data fetching logic
$totalOrders = 100; // Example data
$totalUsers = 50;   // Example data
$totalMenuItems = 20; // Example data
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
    <link rel="stylesheet" href="/restaurant-system/assets/css/styles.css">
</head>
<body>
    <?php include '../templates/header.php'; ?>
    
    <div class="container">
        <h1>Panel de Administración</h1>
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
            <h2>Acciones Rápidas</h2>
            <a href="manage-menu.php">Gestionar Menú</a>
            <a href="manage-orders.php">Gestionar Pedidos</a>
        </div>
    </div>

    <?php include '../templates/footer.php'; ?>
</body>
</html>