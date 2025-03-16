<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "datagym";

// Membuat koneksi
$koneksi = new mysqli($servername, $username, $password, $database);

// Mengecek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
