<!DOCTYPE html>
<html>
<head>
    <title>Product Search</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .product { border: 1px solid #ddd; padding: 10px; margin: 10px; }
    </style>
</head>
<body>
    <h1>Search Products</h1>
    <form method="GET">
        <input type="hidden" name="route" value="search">
        <input type="text" name="query" placeholder="Search...">
        <button type="submit">Search</button>
    </form>
    <div>
        <?php foreach ($products as $product): ?>
            <div class="product">
                <h2><?= htmlspecialchars($product['name']) ?></h2>
                <p><?= htmlspecialchars($product['description']) ?></p>
                <p><strong>Price:</strong> $<?= htmlspecialchars($product['price']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
