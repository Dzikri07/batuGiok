<?php
require_once "../config/Database.php";
require_once "produk.php";

$database = new Database();
$db = $database->getConnection();
$produk = new Produk($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    $query = "INSERT INTO produk (nama_produk, jenis, harga, stok, deskripsi)
              VALUES (:nama, :jenis, :harga, :stok, :deskripsi)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":nama", $nama_produk);
    $stmt->bindParam(":jenis", $jenis);
    $stmt->bindParam(":harga", $harga);
    $stmt->bindParam(":stok", $stok);
    $stmt->bindParam(":deskripsi", $deskripsi);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Gagal menambahkan produk.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="../asset/style.css">
</head>
<body>
    <h2>Tambah Produk Baru</h2>
    <div class="create">
        <form method="POST">
        <input type="text" name="nama_produk" placeholder="Nama Produk" required><br>
        <input type="text" name="jenis" placeholder="Jenis" required><br>
        <input type="number" name="harga" placeholder="Harga" required><br>
        <input type="number" name="stok" placeholder="Stok" required><br>
        <textarea name="deskripsi" placeholder="Deskripsi"></textarea><br>
        <button type="submit">Simpan</button>
    </form>
    </div>
</body>
</html>
