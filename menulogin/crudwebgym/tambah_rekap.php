<?php
include 'koneksi_rekap.php';

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal = $_POST['tanggal'];
    $total_checkin_harian = $_POST['total_checkin_harian'];
    $paket_member = $_POST['paket_member'];
    $etalase_penjualan = $_POST['etalase_penjualan'];

    // Validasi input untuk memastikan hanya angka yang diizinkan
    if (!is_numeric($total_checkin_harian) || !is_numeric($paket_member) || !is_numeric($etalase_penjualan)) {
        $error_message = "Mohon masukkan angka yang valid";
    } else {
        $total_semua = $total_checkin_harian + $paket_member + $etalase_penjualan;

        $query = "INSERT INTO rekap_keuangan (tanggal, total_checkin_harian, paket_member, etalase_penjualan, total_semua)
                  VALUES ('$tanggal', '$total_checkin_harian', '$paket_member', '$etalase_penjualan', '$total_semua')";
        
        if ($koneksi->query($query) === TRUE) {
            // Hapus data dari localStorage saat form berhasil disubmit
            echo "<script>localStorage.removeItem('form_data');</script>";
            header("Location: rekap.php");
        } else {
            $error_message = "Error: " . $query . "<br>" . $koneksi->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Rekap Keuangan Harian</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 65vh;
            color: #333;
        }
        .container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }
        .error {
            color: red;
            display: none;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            transition: all 0.3s ease-in-out;
        }
        .form-control:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 8px rgba(106, 17, 203, 0.2);
        }
        .btn-primary {
            background-color: #6a11cb;
            border-radius: 10px;
            border-color: #6a11cb;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .btn-primary:hover {
            background: #530fa3;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Load form data from localStorage
            const savedData = JSON.parse(localStorage.getItem('form_data'));
            if (savedData) {
                document.getElementById('tanggal').value = savedData.tanggal;
                document.getElementById('total_checkin_harian').value = savedData.total_checkin_harian;
                document.getElementById('paket_member').value = savedData.paket_member;
                document.getElementById('etalase_penjualan').value = savedData.etalase_penjualan;
            }
        });

        function saveFormData() {
            const formData = {
                tanggal: document.getElementById('tanggal').value,
                total_checkin_harian: document.getElementById('total_checkin_harian').value,
                paket_member: document.getElementById('paket_member').value,
                etalase_penjualan: document.getElementById('etalase_penjualan').value
            };
            localStorage.setItem('form_data', JSON.stringify(formData));
        }

        function validateForm() {
            var isValid = true;
            var elements = ["total_checkin_harian", "paket_member", "etalase_penjualan"];
            elements.forEach(function(id) {
                var element = document.getElementById(id);
                var errorElement = document.getElementById(id + "_error");
                if (isNaN(element.value) || element.value.trim() === "") {
                    errorElement.style.display = "block";
                    isValid = false;
                } else {
                    errorElement.style.display = "none";
                }
            });
            return isValid;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2 class="text-center"><b>Tambah Data Laporan Keuangan</b></h2>
        <?php if ($error_message != "") { ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php } ?>
        <form method="POST" action="" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="tanggal"><b>Tanggal :</b></label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" required onchange="saveFormData()">
            </div>
            <div class="form-group">
                <label for="total_checkin_harian"><b>Total Checkin Harian :</b></label>
                <input type="number" class="form-control" id="total_checkin_harian" name="total_checkin_harian" required onchange="saveFormData()">
                <small id="total_checkin_harian_error" class="error">Mohon masukkan angka yang valid</small>
            </div>
            <div class="form-group">
                <label for="paket_member"><b>Total Daftar Member :</b></label>
                <input type="number" class="form-control" id="paket_member" name="paket_member" required onchange="saveFormData()">
                <small id="paket_member_error" class="error">Mohon masukkan angka yang valid</small>
            </div>
            <div class="form-group">
                <label for="etalase_penjualan"><b>Total Etalase Penjualan Produk :</b></label>
                <input type="number" class="form-control" id="etalase_penjualan" name="etalase_penjualan" required onchange="saveFormData()">
                <small id="etalase_penjualan_error" class="error">Mohon masukkan angka yang valid</small>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </form>
    </div>
</body>
</html>