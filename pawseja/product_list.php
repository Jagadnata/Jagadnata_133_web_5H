<?php
include_once 'config/DatabaseConfig.php';
include_once 'models/Product.php';

$database = new DatabaseConfig();
$db = $database->connect();
$product = new Product($db);
$products = $product->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - PawSeja</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Navbar */
        .navbar {
            background-color: #333;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        /* Product Table */
        .product-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            text-align: left;
        }

        .product-table th,
        .product-table td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        .product-table th {
            background-color: #333;
            color: white;
        }

        .product-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 8px 16px;
            margin: 5px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            background-color: #28a745;
        }

        .btn:hover {
            background-color: #218838;
        }

        .add-product-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #007bff;
            text-align: center;
            color: white;
            border-radius: 5px;
            font-size: 1rem;
            text-decoration: none;
        }

        .add-product-btn:hover {
            background-color: #0056b3;
        }

        /* Footer */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <h1>PawSeja</h1>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1>Daftar Produk</h1>
        <a href="add_product.php" class="add-product-btn">Tambah Produk</a>
        <table class="product-table">
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Action</th>
            </tr>
            <?php foreach ($products as $product) { ?>
                <tr>
                    <td><?= $product['name'] ?></td>
                    <td>Rp <?= number_format($product['price'], 0, ',', '.') ?></td>
                    <td>
                        <a href="edit_product.php?id=<?= $product['id'] ?>" class="btn">Edit</a>
                        <a href="delete_product.php?id=<?= $product['id'] ?>" class="btn">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 PawSeja - All Rights Reserved</p>
    </footer>

</body>
</html>
