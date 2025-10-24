<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Fetch available dishes from the database
$query = "SELECT * FROM plato WHERE disponible = 1";
$result = mysqli_query($conexion, $query);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>Menú del Restaurante</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>

    <h1>Menú del Restaurante</h1>
    <div class="menu-items">
        <?php while ($plato = mysqli_fetch_assoc($result)): ?>
            <div class="menu-item">
                <h2><?php echo $plato['nombre']; ?></h2>
                <p><?php echo $plato['descripcion']; ?></p>
                <p>Precio: $<?php echo number_format($plato['precio'], 2); ?></p>
                <input type="number" id="cantidad_<?php echo $plato['id_plato']; ?>" value="1" min="1">
                <button onclick="addToCart(<?php echo $plato['id_plato']; ?>)">Añadir al carrito</button>
            </div>
        <?php endwhile; ?>
    </div>

    <?php include '../includes/footer.php'; ?>
    <script src="../assets/js/cart.js"></script>
</body>
</html>