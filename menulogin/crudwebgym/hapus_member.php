<?php
include 'koneksi_member.php';

$id = $_GET['id'];

$query = "DELETE FROM paket_member WHERE id = $id";

if ($koneksi->query($query) === TRUE) {
    header("Location: member.php");
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}

$koneksi->close();
?>
