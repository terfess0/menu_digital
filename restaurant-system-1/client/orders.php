<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../auth/login.php');
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$query = "SELECT p.id_pedido, p.fecha, p.total, ep.nombre AS estado 
          FROM pedido p 
          JOIN estado_pedido ep ON p.id_estado = ep.id_estado 
          WHERE p.id_usuario = $id_usuario 
          ORDER BY p.fecha DESC";

$result = mysqli_query($conexion, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Mis Pedidos</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <div class="container">
        <h1>Mis Pedidos</h1>
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
                <?php while ($pedido = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $pedido['id_pedido']; ?></td>
                        <td><?php echo $pedido['fecha']; ?></td>
                        <td><?php echo number_format($pedido['total'], 2); ?> €</td>
                        <td><?php echo $pedido['estado']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php include '../includes/footer.php'; ?>
</body>
</html>