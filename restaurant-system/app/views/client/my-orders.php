<?php
session_start();
include_once '../../models/Order.php';
include_once '../../models/OrderStatus.php';

$orderModel = new Order();
$orderStatusModel = new OrderStatus();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../auth/login.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$orders = $orderModel->getOrdersByUserId($id_usuario);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Pedidos</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../templates/header.php'; ?>

    <h1>Mis Pedidos</h1>

    <?php if (empty($orders)): ?>
        <p>No tienes pedidos anteriores.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['id_pedido']; ?></td>
                        <td><?php echo $order['fecha']; ?></td>
                        <td><?php echo $order['total']; ?></td>
                        <td><?php echo $orderStatusModel->getStatusName($order['id_estado']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php include '../templates/footer.php'; ?>
</body>
</html>