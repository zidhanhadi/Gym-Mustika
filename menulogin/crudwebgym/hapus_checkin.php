<?php
include 'koneksi_checkin.php';

$id = $_GET['id'];

$sql = "DELETE FROM checkin WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: checkin.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
