<?php
include_once 'app/Config/DatabaseConfig.php';
include_once 'app/Models/Product.php';

class ProductController {

    private $conn;
    private $product;

    // Constructor untuk inisialisasi koneksi dan model produk
    public function __construct() {
        $database = new DatabaseConfig();
        $this->conn = $database->connect();
        $this->product = new Product($this->conn);
    }

    // Fungsi untuk mendapatkan semua produk
    public function getAllProducts() {
        $stmt = $this->product->read();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($products);
    }

    // Fungsi untuk mendapatkan produk berdasarkan ID
    public function getProductById($id) {
        $product = $this->product->getProductById($id);

        header('Content-Type: application/json');
        echo json_encode($product ? $product : ['message' => 'Product not found']);
    }

    // Fungsi untuk membuat produk baru
    public function createProduct() {
        $data = json_decode(file_get_contents("php://input"), true);

        // Validasi input
        if (empty($data['name']) || empty($data['price']) || empty($data['stock']) || empty($data['category_id'])) {
            echo json_encode(['message' => 'Incomplete data']);
            return;
        }

        // Menambahkan produk baru
        $this->product->name = $data['name'];
        $this->product->description = $data['description'] ?? null;
        $this->product->price = $data['price'];
        $this->product->stock = $data['stock'];
        $this->product->category_id = $data['category_id'];

        if ($this->product->create()) {
            echo json_encode(['message' => 'Product created successfully']);
        } else {
            echo json_encode(['message' => 'Failed to create product']);
        }
    }

    // Fungsi untuk memperbarui produk berdasarkan ID
    public function updateProduct($id) {
        $data = json_decode(file_get_contents("php://input"), true);

        // Validasi input
        if (empty($data['name']) || empty($data['price']) || empty($data['stock']) || empty($data['category_id'])) {
            echo json_encode(['message' => 'Incomplete data']);
            return;
        }

        // Mengupdate produk
        $this->product->id = $id;
        $this->product->name = $data['name'];
        $this->product->description = $data['description'] ?? null;
        $this->product->price = $data['price'];
        $this->product->stock = $data['stock'];
        $this->product->category_id = $data['category_id'];

        if ($this->product->update()) {
            echo json_encode(['message' => 'Product updated successfully']);
        } else {
            echo json_encode(['message' => 'Failed to update product']);
        }
    }

    // Fungsi untuk menghapus produk berdasarkan ID
    public function deleteProduct($id) {
        if ($this->product->delete($id)) {
            echo json_encode(['message' => 'Product deleted successfully']);
        } else {
            echo json_encode(['message' => 'Failed to delete product']);
        }
    }
}
?>
