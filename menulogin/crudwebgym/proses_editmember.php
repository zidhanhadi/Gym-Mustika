<?php
include 'koneksi_member.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$alamat = $_POST['alamat'];
$nomor_telepon = $_POST['nomor_telepon'];
$nomor_member = $_POST['nomor_member'];
$biaya_administrasi = $_POST['biaya_administrasi'];
$tanggal = $_POST['tanggal'];

$query = "UPDATE paket_member SET nama='$nama', tanggal_lahir='$tanggal_lahir', alamat='$alamat', nomor_telepon='$nomor_telepon', nomor_member='$nomor_member', biaya_administrasi='$biaya_administrasi', tanggal='$tanggal' WHERE id=$id";

if ($koneksi->query($query) === TRUE) {
    header("Location: member.php");
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}

$koneksi->close();
?>
