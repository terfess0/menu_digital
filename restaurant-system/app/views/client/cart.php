<?php
session_start();

// Check if the cart session variable is set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Function to calculate the total price of the cart
function calculateTotal($cart) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}

// Handle removing an item from the cart
if (isset($_POST['remove'])) {
    $itemId = $_POST['item_id'];
    unset($_SESSION['cart'][$itemId]);
}

// Handle updating item quantities
if (isset($_POST['update'])) {
    $itemId = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    if ($quantity > 0) {
        $_SESSION['cart'][$itemId]['quantity'] = $quantity;
    } else {
        unset($_SESSION['cart'][$itemId]);
    }
}

// Calculate total price
$totalPrice = calculateTotal($_SESSION['cart']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
    <?php include '../templates/header.php'; ?>

    <h1>Your Shopping Cart</h1>

    <?php if (empty($_SESSION['cart'])): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $itemId => $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo number_format($item['price'], 2); ?> €</td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
                                <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1">
                                <button type="submit" name="update">Update</button>
                            </form>
                        </td>
                        <td><?php echo number_format($item['price'] * $item['quantity'], 2); ?> €</td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
                                <button type="submit" name="remove">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>Total: <?php echo number_format($totalPrice, 2); ?> €</h2>
        <a href="menu.php">Continue Shopping</a>
        <a href="checkout.php">Proceed to Checkout</a>
    <?php endif; ?>

    <?php include '../templates/footer.php'; ?>
</body>
</html>