<?php
// Sisipkan koneksi ke database
include 'koneksi_etalase.php';

// Ambil ID barang yang akan dihapus dari URL
$id = $_GET['id'];

// Query untuk menghapus data barang berdasarkan ID
$query = "DELETE FROM etalase_penjualan WHERE id=$id";
$result = mysqli_query($koneksi, $query);

// Periksa apakah data berhasil dihapus atau tidak
if ($result) {
    // Jika berhasil, redirect ke halaman index.php dengan pesan sukses
    header("Location: etalase.php?pesan=Data berhasil dihapus");
} else {
    // Jika gagal, redirect ke halaman index.php dengan pesan gagal
    header("Location: etalase.php?pesan=Data gagal dihapus");
}
?>
