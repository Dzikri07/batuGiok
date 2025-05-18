<?php
require_once "../config/Database.php";
require_once "produk.php";

$database = new Database();
$db = $database->getConnection();
$produk = new Produk($db);

$id = $_GET['id'] ?? null;

if ($id) {
    $query = "DELETE FROM produk WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":id", $id);
    if ($stmt->execute()) {
      header("Location: ../index.php");
        exit;
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID tidak ditemukan.";
}
