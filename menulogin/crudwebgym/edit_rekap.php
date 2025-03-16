<?php
include 'koneksi_rekap.php';

$id = $_GET['id'];
$query = "SELECT * FROM rekap_keuangan WHERE id=$id";
$result = $koneksi->query($query);
$data = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal = $_POST['tanggal'];
    $total_checkin_harian = $_POST['total_checkin_harian'];
    $paket_member = $_POST['paket_member'];
    $etalase_penjualan = $_POST['etalase_penjualan'];
    $total_semua = $total_checkin_harian + $paket_member + $etalase_penjualan;

    $query = "UPDATE rekap_keuangan SET 
              tanggal='$tanggal', 
              total_checkin_harian='$total_checkin_harian', 
              paket_member='$paket_member', 
              etalase_penjualan='$etalase_penjualan', 
              total_semua='$total_semua'
              WHERE id=$id";
    
    if ($koneksi->query($query) === TRUE) {
        header("Location: rekap.php");
    } else {
        echo "Error: " . $query . "<br>" . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Rekap Keuangan</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #333;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 26px;
            background: #fff;
            padding: 25px 35px;
            border-radius: 13px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        h2 {
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }
        .form-group label {
            font-weight: bold;
        }
        .form-control {
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            transition: border-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .form-control:focus {
            border-color: #5a0da6;
            box-shadow: 0 0 8px rgba(90, 13, 166, 0.2);
        }
        .btn-primary {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-primary:hover {
            background: #5a0da6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center"><b>Edit Data Laporan Keuangan</b></h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="tanggal">Tanggal :</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $data['tanggal']; ?>" required>
            </div>
            <div class="form-group">
                <label for="total_checkin_harian">Total Checkin Harian :</label>
                <input type="number" class="form-control" id="total_checkin_harian" name="total_checkin_harian" value="<?php echo $data['total_checkin_harian']; ?>" required>
            </div>
            <div class="form-group">
                <label for="paket_member">Total Daftar Member :</label>
                <input type="number" class="form-control" id="paket_member" name="paket_member" value="<?php echo $data['paket_member']; ?>" required>
            </div>
            <div class="form-group">
                <label for="etalase_penjualan">Etalase Penjualan Produk :</label>
                <input type="number" class="form-control" id="etalase_penjualan" name="etalase_penjualan" value="<?php echo $data['etalase_penjualan']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Data</button>
        </form>
    </div>
</body>
</html>
