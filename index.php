<?php
require_once "config/Database.php";
require_once "class/Produk.php";

$database = new Database();
$db = $database->getConnection();

$produk = new Produk($db);
$stmt = $produk->getAllProduk();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Produk Batu Giok</title>
    <link rel="stylesheet" href="asset/style.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Produk Batu Giok</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Produk</th>
                    <th>Jenis</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                    <td><?= $row['jenis'] ?></td>
                    <td>Rp <?= number_format($row['harga']) ?></td>
                    <td><?= $row['stok'] ?></td>
                    <td><?= $row['deskripsi'] ?></td>
                    <td>
                        <a href="class/create.php"><button>+ Tambah Produk</button></a>
                        <a href="class/update.php?id=<?= $row['id'] ?>"><button>Edit</button></a>
                        <a href="class/delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin hapus?')">
                            <button>Hapus</button>
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="asset/script.js"></script>
</body>
</html>
