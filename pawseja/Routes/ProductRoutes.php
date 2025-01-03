<?php
// Melibatkan controller
include_once 'app/Controllers/ProductController.php';

// Routing untuk API
$request_method = $_SERVER['REQUEST_METHOD'];
$request_uri = $_SERVER['REQUEST_URI'];

// Menangani permintaan API produk
if (strpos($request_uri, '/api/products') !== false) {
    $controller = new ProductController();
    if ($request_method == 'GET' && $request_uri == '/api/products') {
        $controller->getAllProducts();
    } elseif ($request_method == 'POST' && $request_uri == '/api/products') {
        $controller->createProduct();
    }
    // Periksa apakah URI mengandung ID produk untuk update atau delete
    elseif (preg_match('/^\/api\/products\/(\d+)$/', $request_uri, $matches)) {
        $id = $matches[1];
        if ($request_method == 'GET') {
            $controller->getProductById($id);
        } elseif ($request_method == 'PUT') {
            $controller->updateProduct($id);
        } elseif ($request_method == 'DELETE') {
            $controller->deleteProduct($id);
        }
    }
}
?>
