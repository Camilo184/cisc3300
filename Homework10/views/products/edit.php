<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechGadgetry - Edit Product</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>TechGadgetry</h1>
            <p>Your One-Stop Shop for Tech Gadgets</p>
        </header>
        
        <nav>
            <a href="index.php">Products</a>
            <a href="index.php?action=create">Add New Product</a>
        </nav>
        
        <div class="form-container">
            <h2>Edit Product</h2>
            
            <?php if (isset($product) && $product): ?>
                <form action="index.php?action=update" method="POST">
                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($product['description']); ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="price">Price ($)</label>
                        <input type="number" id="price" name="price" step="0.01" min="0" value="<?php echo $product['price']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <input type="number" id="stock" name="stock" min="0" value="<?php echo $product['stock']; ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="image">Image Filename</label>
                        <input type="text" id="image" name="image" value="<?php echo htmlspecialchars($product['image']); ?>" required>
                        <small>Enter image filename (e.g., product.jpg). Images should be placed in assets/images/ folder.</small>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">Update Product</button>
                        <a href="index.php" class="btn-cancel">Cancel</a>
                    </div>
                </form>
            <?php else: ?>
                <p class="error">Product not found.</p>
                <a href="index.php" class="btn-back">Back to Products</a>
            <?php endif; ?>
        </div>
        
       
    </div>
</body>
</html>
