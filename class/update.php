<?php
require_once "../config/Database.php";
require_once "produk.php";

$database = new Database();
$db = $database->getConnection();
$produk = new Produk($db);

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID tidak ditemukan.");
}

// Ambil data lama
$query = "SELECT * FROM produk WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(":id", $id);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    die("Produk tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_produk = $_POST['nama_produk'];
    $jenis = $_POST['jenis'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $deskripsi = $_POST['deskripsi'];

    $query = "UPDATE produk SET nama_produk=:nama, jenis=:jenis, harga=:harga, stok=:stok, deskripsi=:deskripsi WHERE id=:id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":nama", $nama_produk);
    $stmt->bindParam(":jenis", $jenis);
    $stmt->bindParam(":harga", $harga);
    $stmt->bindParam(":stok", $stok);
    $stmt->bindParam(":deskripsi", $deskripsi);
    $stmt->bindParam(":id", $id);

    if ($stmt->execute()) {
       header("Location: ../index.php");
        exit;
    } else {
        echo "Gagal update data.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="../asset/style.css">
</head>
<body>
    <h2>Edit Produk</h2>
   <div class="update">
     <form method="POST">
        <input type="text" name="nama_produk" value="<?= $data['nama_produk'] ?>" required><br>
        <input type="text" name="jenis" value="<?= $data['jenis'] ?>" required><br>
        <input type="number" name="harga" value="<?= $data['harga'] ?>" required><br>
        <input type="number" name="stok" value="<?= $data['stok'] ?>" required><br>
        <textarea name="deskripsi"><?= $data['deskripsi'] ?></textarea><br>
        <button type="submit">Update</button>
    </form>
   </div>
</body>
</html>
