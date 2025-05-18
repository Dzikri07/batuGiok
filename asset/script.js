function editProduk(id) {
    alert("Edit produk ID: " + id);
    // Arahkan ke edit.php?id=... nanti
}

function hapusProduk(id) {
    if (confirm("Yakin mau hapus produk ID " + id + "?")) {
        // Redirect ke hapus.php?id=... (belum dibuat)
        alert("Produk dengan ID " + id + " dihapus (belum real).");
    }
}
