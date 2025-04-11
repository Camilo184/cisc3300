<?php
$host = 'localhost';
$dbname = 'GroceryStore';
$username = 'root';
$password = 'root';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}


try {
    $sql = "CREATE TABLE IF NOT EXISTS products (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        price DECIMAL(10,2) NOT NULL,
        stock INT(11) NOT NULL,
        image VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->exec($sql);
    
 
    $stmt = $conn->query("SELECT COUNT(*) FROM products");
    $count = $stmt->fetchColumn();
    
    if ($count == 0) {
        $sampleProducts = [
            [
                'name' => 'Milk',
                'description' => '100 percent pure cow milk',
                'price' => 2.99,
                'stock' => 50,
                'image' => 'milk.jpg'
                
            ],
            [
                'name' => 'Bread',
                'description' => 'Freshly baked whole grain bread',
                'price' => 1.99,
                'stock' => 100,
                'image' => 'bread.jpg'
               
            ],
            [
                'name' => 'Eggs',
                'description' => 'Dozen organic free-range eggs',
                'price' => 10.99,
                'stock' => 0,
                'image' => 'eggs.jpg'
                
            ],
            [
                'name' => 'Water',
                'description' => 'Bottled spring water',
                'price' => 0.99,
                'stock' => 200,
                'image' => 'water.jpg'
                
            ],
            [
                'name' => 'Banana',
                'description' => 'Fresh organic bananas',
                'price' => 0.59,
                'stock' => 150,
                'image' => 'banana.jpg'
                
            ]
        ];
        
        $stmt = $conn->prepare("INSERT INTO products (name, description, price, stock, image) VALUES (?, ?, ?, ?, ?)");
        
        foreach ($sampleProducts as $product) {
            $stmt->execute([
                $product['name'],
                $product['description'],
                $product['price'],
                $product['stock'],
                $product['image']
            ]);
        }
    }
} catch(PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}
?>
