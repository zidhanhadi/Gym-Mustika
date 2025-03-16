<?php
// Sisipkan koneksi ke database
include 'koneksi_etalase.php';

// Ambil data yang dikirimkan dari form tambah.php
$nama_barang = $_POST['nama_barang'];
$jumlah = $_POST['jumlah'];
$harga = $_POST['harga'];
$tanggal = $_POST['tanggal'];

// Hitung total harga
$total = $jumlah * $harga;

// Query untuk menyimpan data ke dalam database
$query = "INSERT INTO etalase_penjualan (nama_barang, jumlah, harga, total, tanggal) VALUES ('$nama_barang', $jumlah, $harga, $total, '$tanggal')";
$result = mysqli_query($koneksi, $query);

// Periksa apakah data berhasil disimpan atau tidak
if ($result) {
    // Jika berhasil, redirect ke halaman index.php dengan pesan sukses
    header("Location: etalase.php?pesan=Data berhasil ditambahkan");
} else {
    // Jika gagal, redirect ke halaman index.php dengan pesan gagal
    header("Location: etalase.php?pesan=Data gagal ditambahkan");
}
?>
