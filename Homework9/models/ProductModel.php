<?php
class ProductModel {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;port=8888;dbname=mybusiness;charset=utf8', 'root', 'root');

    }

    public function searchProducts($query) {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE name LIKE ?");
        $stmt->execute(["%$query%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
