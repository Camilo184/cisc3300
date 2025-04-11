<?php
require_once 'models/Product.php';

class ProductController {
    private $productModel;
    
    public function __construct($conn) {
        $this->productModel = new Product($conn);
    }
    
    public function index() {
        $products = $this->productModel->getAll();
        include 'views/products/index.php';
    }
    
    public function search() {
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $products = $this->productModel->search($keyword);
        include 'views/products/index.php';
    }
    
    public function create() {
        include 'views/products/create.php';
    }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'stock' => $_POST['stock'],
                'image' => $_POST['image']
            ];
            
            if ($this->productModel->create($data)) {
                $_SESSION['message'] = 'Product created successfully!';
                header('Location: index.php');
                exit;
            } else {
                $_SESSION['error'] = 'Failed to create product.';
                header('Location: index.php?action=create');
                exit;
            }
        }
    }
    
    public function edit() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            $product = $this->productModel->getById($id);
            include 'views/products/edit.php';
        } else {
            header('Location: index.php');
            exit;
        }
    }
    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $data = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'price' => $_POST['price'],
                'stock' => $_POST['stock'],
                'image' => $_POST['image']
            ];
            
            if ($this->productModel->update($id, $data)) {
                $_SESSION['message'] = 'Product updated successfully!';
                header('Location: index.php');
                exit;
            } else {
                $_SESSION['error'] = 'Failed to update product.';
                header('Location: index.php?action=edit&id=' . $id);
                exit;
            }
        }
    }
    
    public function delete() {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        if ($id) {
            if ($this->productModel->delete($id)) {
                $_SESSION['message'] = 'Product deleted successfully!';
            } else {
                $_SESSION['error'] = 'Failed to delete product.';
            }
        }
        header('Location: index.php');
        exit;
    }
}
?>
