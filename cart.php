<?php

session_start();

// Handle remove from cart
if (isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];
    $_SESSION['cart'] = array_filter($_SESSION['cart'], function ($p) use ($product_id) {
        return $p['id'] != $product_id;
    });
    // header('Location: cart.php');
    exit();
}

// Calculate total
$total = array_reduce($_SESSION['cart'], function ($sum, $product) {
    return $sum + $product['price'];
}, 0.0);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Your Cart</h1>
    <div class="cart">
        <?php if (empty($_SESSION['cart'])): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <?php foreach ($_SESSION['cart'] as $product): ?>
                <div class="cart-item">
                    <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                    <p>Price: $<?php echo number_format($product['price'], 2); ?></p>
                    <form method="post" action="">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" name="remove_from_cart">Remove</button>
                    </form>
                </div>
            <?php endforeach; ?>
            <h3>Total: $<?php echo number_format($total, 2); ?></h3>
        <?php endif; ?>
    </div>
    <a href="index.php">Back to Products</a>
    <a href="checkout.php">Proceed to Checkout</a>
</body>
</html>
