<?php
include 'koneksi_checkin.php';

$nama = $_POST['nama'];
$biaya_checkin = $_POST['biaya_checkin'];
$tanggal = $_POST['tanggal'];

$sql = "INSERT INTO checkin (nama, biaya_checkin, tanggal) VALUES ('$nama', '$biaya_checkin', '$tanggal')";

if ($conn->query($sql) === TRUE) {
    header('Location: checkin.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
