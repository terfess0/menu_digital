<?php
session_start();
require_once '../includes/db.php';
require_once '../includes/functions.php';

if (!isset($_SESSION['id_usuario'])) {
    header('Location: ../auth/login.php');
    exit();
}

$userId = $_SESSION['id_usuario'];
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="../assets/js/cart.js" defer></script>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>Carrito de Compras</h1>

    <?php if (empty($cartItems)): ?>
        <p>Tu carrito está vacío.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Plato</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): 
                    $subtotal = $item['precio'] * $item['cantidad'];
                    $total += $subtotal;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($item['cantidad']); ?></td>
                        <td><?php echo number_format($subtotal, 2); ?> €</td>
                        <td>
                            <button onclick="removeFromCart(<?php echo $item['id_plato']; ?>)">Eliminar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h2>Total: <?php echo number_format($total, 2); ?> €</h2>
        <a href="checkout.php" class="btn">Proceder al Pago</a>
    <?php endif; ?>

    <?php include '../includes/footer.php'; ?>
</body>
</html>