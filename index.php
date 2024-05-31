<?php
session_start();

// Load products from data.json
$products = json_decode(file_get_contents('data.json'), true);

// Handle add to cart
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $product = array_filter($products, function ($p) use ($product_id) {
        return $p['id'] == $product_id;
    });
    $product = array_values($product)[0];

    
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    array_push($_SESSION['cart'], $product);
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Webshop</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Products</h1>
    <div class="products">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                <p>Price: $<?php echo number_format($product['price'], 2); ?></p>
                <form method="post" action="">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button type="submit" name="add_to_cart">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="cart.php">Go to Cart</a>
</body>
</html>
