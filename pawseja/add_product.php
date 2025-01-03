<?php
include_once 'config/DatabaseConfig.php';
include_once 'models/Product.php';

// Membuat objek database dan produk
$database = new DatabaseConfig();
$db = $database->connect();
$product = new Product($db);

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Set data produk dari form
    $product->name = $_POST['name'];
    $product->description = $_POST['description'];
    $product->price = $_POST['price'];
    $product->stock = $_POST['stock'];
    $product->category_id = $_POST['category_id'];

    // Coba tambahkan produk
    if ($product->create()) {
        header('Location: product_list.php'); // Redirect ke daftar produk
        exit;
    } else {
        echo "Gagal menambahkan produk!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - PawSeja</title>
    <style>
        /* Styling similar to previous file */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            font-size: 1rem;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #218838;
        }

    </style>
</head>
<body>

    <div class="form-container">
        <h1>Tambah Produk</h1>
        <form action="add_product.php" method="POST">
            <div class="form-group">
                <label for="name">Nama Produk</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Harga</label>
                <input type="number" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="stock">Stok</label>
                <input type="number" id="stock" name="stock" required>
            </div>
            <div class="form-group">
                <label for="category_id">Kategori ID</label>
                <input type="number" id="category_id" name="category_id" required>
            </div>
            <div class="form-group">
                <button type="submit">Tambah Produk</button>
            </div>
        </form>
    </div>

</body>
</html>
