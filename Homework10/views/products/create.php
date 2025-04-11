<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechGadgetry - Add New Product</title>
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
            <a href="index.php?action=create" class="active">Add New Product</a>
        </nav>
        
        <div class="form-container">
            <h2>Add New Product</h2>
            
            <form action="index.php?action=store" method="POST">
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="price">Price ($)</label>
                    <input type="number" id="price" name="price" step="0.01" min="0" required>
                </div>
                
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" id="stock" name="stock" min="0" required>
                </div>
                
                <div class="form-group">
                    <label for="image">Image Filename</label>
                    <input type="text" id="image" name="image" required>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn-submit">Add Product</button>
                    <a href="index.php" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
        
      
    </div>
</body>
</html>
