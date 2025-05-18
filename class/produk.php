<?php
class Produk {
    private $conn;
    private $table_name = "produk";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllProduk() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
