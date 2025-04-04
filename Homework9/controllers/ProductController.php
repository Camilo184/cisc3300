<?php

require_once 'models/ProductModel.php';

class ProductController {
    public function search() {
        $query = $_GET['query'] ?? '';
        $productModel = new ProductModel();
        $products = $productModel->searchProducts($query);
        include 'views/search_view.php';
    }
}
