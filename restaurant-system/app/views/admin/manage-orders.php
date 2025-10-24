<?php
session_start();
include_once '../../models/Order.php';
include_once '../../models/OrderStatus.php';

$orderModel = new Order();
$orderStatusModel = new OrderStatus();

// Fetch all orders
$orders = $orderModel->getAllOrders();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Pedidos</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../templates/header.php'; ?>

    <div class="container">
        <h1>Gestionar Pedidos</h1>
        <table>
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?php echo $order['id']; ?></td>
                        <td><?php echo $order['cliente']; ?></td>
                        <td><?php echo $order['fecha']; ?></td>
                        <td><?php echo $order['total']; ?></td>
                        <td><?php echo $orderStatusModel->getStatusName($order['id_estado']); ?></td>
                        <td>
                            <a href="edit-order.php?id=<?php echo $order['id']; ?>">Editar</a>
                            <a href="delete-order.php?id=<?php echo $order['id']; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php include '../templates/footer.php'; ?>
</body>
</html>