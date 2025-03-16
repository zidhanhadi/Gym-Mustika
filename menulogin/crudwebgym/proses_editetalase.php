<?php
// Sisipkan koneksi ke database
include 'koneksi_etalase.php';

// Ambil data yang dikirimkan dari form
$id = $_POST['id'];
$nama_barang = $_POST['nama_barang'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];
$tanggal = $_POST['tanggal'];

// Hitung total harga
$total = $jumlah * $harga;

// Query untuk memperbarui data di dalam database
$query = "UPDATE etalase_penjualan SET nama_barang='$nama_barang', jumlah=$jumlah, harga=$harga, total=$total, tanggal='$tanggal' WHERE id=$id";
$result = mysqli_query($koneksi, $query);

// Periksa apakah data berhasil diperbarui atau tidak
if ($result) {
    // Jika berhasil, redirect ke halaman index.php dengan pesan sukses
    header("Location: etalase.php?pesan=Data berhasil diperbarui");
} else {
    // Jika gagal, redirect ke halaman index.php dengan pesan gagal
    header("Location: etalase.php?pesan=Data gagal diperbarui");
}
?>
