<?php
session_start();
require_once '../../models/Menu.php';

$menuModel = new Menu();
$platos = $menuModel->obtenerPlatosDisponibles();

include '../templates/header.php';
?>

<h1>Menú del Restaurante</h1>
<table>
    <thead>
        <tr>
            <th>Nombre del Plato</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Agregar al Carrito</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($platos as $plato): ?>
        <tr>
            <td><?php echo htmlspecialchars($plato['nombre']); ?></td>
            <td><?php echo htmlspecialchars($plato['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($plato['precio']); ?> €</td>
            <td>
                <input type="number" name="cantidad[<?php echo $plato['id']; ?>]" min="1" value="1">
            </td>
            <td>
                <button onclick="agregarAlCarrito(<?php echo $plato['id']; ?>)">Agregar</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="../../assets/js/main.js"></script>

<?php include '../templates/footer.php'; ?>