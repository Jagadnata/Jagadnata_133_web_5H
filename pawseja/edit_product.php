<?php
include_once 'config/DatabaseConfig.php';
include_once 'models/Product.php';

$database = new DatabaseConfig();
$db = $database->connect();
$product = new Product($db);

// Mendapatkan ID produk dari query string
if (isset($_GET['id'])) {
    $product->id = $_GET['id'];
    $products = $product->read();

    // Cari produk dengan ID yang sesuai
    $product_data = null;
    foreach ($products as $prod) {
        if ($prod['id'] == $product->id) {
            $product_data = $prod;
            break;
        }
    }

    if (!$product_data) {
        die('Produk tidak ditemukan.');
    }
}

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form dan menyetelnya ke objek produk
    $product->id = $_POST['id'];
    $product->name = $_POST['name'];
    $product->description = $_POST['description'];
    $product->price = $_POST['price'];
    $product->stock = $_POST['stock'];
    $product->category_id = $_POST['category_id'];

    // Memperbarui produk
    if ($product->update()) {
        echo '<div class="success-message">Produk berhasil diperbarui!</div>';
    } else {
        echo '<div class="error-message">Gagal memperbarui produk.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - PawSeja</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }

        input, textarea {
            padding: 10px;
            font-size: 16px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Produk</h1>
        <form action="edit_product.php?id=<?= $product->id ?>" method="POST">
            <input type="hidden" name="id" value="<?= $product->id ?>">

            <label for="name">Nama Produk:</label>
            <input type="text" name="name" value="<?= $product_data['name'] ?>" required>

            <label for="description">Deskripsi:</label>
            <textarea name="description" required><?= $product_data['description'] ?></textarea>

            <label for="price">Harga:</label>
            <input type="number" name="price" value="<?= $product_data['price'] ?>" required>

            <label for="stock">Stok:</label>
            <input type="number" name="stock" value="<?= $product_data['stock'] ?>" required>

            <label for="category_id">Kategori ID:</label>
            <input 
                type="number" 
                id="category_id" 
                name="category_id" 
                value="<?= isset($product_data['category_id']) ? htmlspecialchars($product_data['category_id']) : '' ?>" 
                required>



            <button type="submit">Perbarui Produk</button>
        </form>
    </div>
</body>
</html>
