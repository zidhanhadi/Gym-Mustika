<?php
include 'koneksi_checkin.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$biaya_checkin = $_POST['biaya_checkin'];
$tanggal = $_POST['tanggal'];

$sql = "UPDATE checkin SET nama='$nama', biaya_checkin='$biaya_checkin', tanggal='$tanggal' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: checkin.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
