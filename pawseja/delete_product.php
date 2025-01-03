<?php
include_once 'config/DatabaseConfig.php';
include_once 'models/Product.php';

// Ambil ID produk dari query string
$product_id = isset($_GET['id']) ? $_GET['id'] : die('ID produk tidak ditemukan.');

// Membuat objek database dan produk
$database = new DatabaseConfig();
$db = $database->connect();
$product = new Product($db);

// Panggil metode delete untuk menghapus produk berdasarkan ID
if ($product->delete($product_id)) {
    header('Location: product_list.php'); // Redirect ke daftar produk setelah berhasil dihapus
    exit;
} else {
    echo "Gagal menghapus produk!";
}
?>
