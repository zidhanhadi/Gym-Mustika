<?php
include 'koneksi_rekap.php';

$id = $_GET['id'];
$query = "DELETE FROM rekap_keuangan WHERE id=$id";

if ($koneksi->query($query) === TRUE) {
    header("Location: rekap.php");
} else {
    echo "Error: " . $query . "<br>" . $koneksi->error;
}
?>
