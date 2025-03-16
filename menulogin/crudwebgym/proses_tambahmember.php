<?php
include 'koneksi_member.php';

$nama = $_POST['nama'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat = $_POST['alamat'];
$nomor_telepon = $_POST['nomor_telepon'];
$nomor_member = $_POST['nomor_member'];
$biaya_administrasi = $_POST['biaya_administrasi'];
$tanggal = $_POST['tanggal'];

$query = "INSERT INTO paket_member (nama, tanggal_lahir, alamat, nomor_telepon, nomor_member, biaya_administrasi, tanggal) VALUES ('$nama', '$tanggal_lahir', '$alamat', '$nomor_telepon', '$nomor_member', '$biaya_administrasi', '$tanggal')";

if ($koneksi->query($query) === TRUE) {
    header("Location: member.php");
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}

$koneksi->close();
?>
