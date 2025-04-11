<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechGadgetry - Products</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>The Grocery Store</h1>
            <p>Products</p>
        </header>
        
        <nav>
            <a href="index.php" class="active">Products</a>
            <a href="index.php?action=create" class="btn-create">Add New Product</a>
        </nav>
        
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert success">
                <?php 
                    echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert error">
                <?php 
                    echo $_SESSION['error']; 
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>
        
        <div class="search-container">
            <form action="index.php" method="GET">
                <input type="hidden" name="action" value="search">
                <input type="text" name="keyword" placeholder="Search products..." value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
                <button type="submit">Search</button>
            </form>
        </div>
        
        <div class="products-grid">
            <?php if (empty($products)): ?>
                <p class="no-products">No products found.</p>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <div class="product-image">
                            <img src="assets/images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        </div>
                        <div class="product-info">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p class="product-description"><?php echo htmlspecialchars($product['description']); ?></p>
                            <p class="product-price">$<?php echo number_format($product['price'], 2); ?></p>
                            <p class="product-stock">In Stock: <?php echo $product['stock']; ?></p>
                            <div class="product-actions">
                                <a href="index.php?action=edit&id=<?php echo $product['id']; ?>" class="btn-edit">Edit</a>
                                <a href="index.php?action=delete&id=<?php echo $product['id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
       
    </div>
</body>
</html>
