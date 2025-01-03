<?php
class Product {
    private $conn;
    private $table = 'products'; // Tabel produk

    public $id;
    public $name;
    public $description;
    public $price;
    public $stock;
    public $category_id;

    // Constructor dengan database connection
    public function __construct($db) {
        $this->conn = $db;
    }

    // Fungsi untuk mendapatkan semua produk
    public function read() {
        try {
            $query = 'SELECT p.id, p.name, p.description, p.price, p.stock, c.name as category_name
                      FROM ' . $this->table . ' p
                      LEFT JOIN categories c ON p.category_id = c.id';  // Pastikan nama tabel kategori benar
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            // Mengambil hasil dan mengembalikan sebagai array
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    // Fungsi untuk mendapatkan produk berdasarkan ID
    public function getProductById($id) {
        try {
            $query = 'SELECT p.id, p.name, p.description, p.price, p.stock, c.name as category_name
                      FROM ' . $this->table . ' p
                      LEFT JOIN categories c ON p.category_id = c.id
                      WHERE p.id = ? LIMIT 0,1';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();

            // Mengambil hasil dan mengembalikan produk jika ditemukan
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            return $product ? $product : null;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // Fungsi untuk membuat produk baru
    public function create() {
        try {
            $query = 'INSERT INTO ' . $this->table . ' (name, description, price, stock, category_id) 
                      VALUES (?, ?, ?, ?, ?)';
            $stmt = $this->conn->prepare($query);

            // Bind parameter
            $stmt->bindParam(1, $this->name);
            $stmt->bindParam(2, $this->description);
            $stmt->bindParam(3, $this->price);
            $stmt->bindParam(4, $this->stock);
            $stmt->bindParam(5, $this->category_id);

            // Eksekusi query dan cek hasilnya
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Fungsi untuk memperbarui produk
    public function update() {
        try {
            $query = 'UPDATE ' . $this->table . ' SET name = ?, description = ?, price = ?, stock = ?, category_id = ? 
                      WHERE id = ?';
            $stmt = $this->conn->prepare($query);

            // Bind parameter
            $stmt->bindParam(1, $this->name);
            $stmt->bindParam(2, $this->description);
            $stmt->bindParam(3, $this->price);
            $stmt->bindParam(4, $this->stock);
            $stmt->bindParam(5, $this->category_id);
            $stmt->bindParam(6, $this->id);

            // Eksekusi query dan cek hasilnya
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // Fungsi untuk menghapus produk berdasarkan ID
    public function delete($id) {
        try {
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = ?';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);

            // Eksekusi query dan cek hasilnya
            if ($stmt->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
