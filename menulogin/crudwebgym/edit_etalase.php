<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #333;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 73vh;
        }
        .container {
            max-width: 600px;
            width: 100%;
            margin: 45px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }
        input[type="text"], input[type="number"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        input[type="text"]:focus, input[type="number"]:focus, input[type="date"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><b>Edit Data Penjualan Produk</b></h2>
        <?php
        // Sisipkan koneksi ke database
        include 'koneksi_etalase.php';

        // Ambil ID barang yang akan diedit dari URL
        $id = $_GET['id'];

        // Query untuk mengambil data barang berdasarkan ID
        $query = "SELECT * FROM etalase_penjualan WHERE id=$id";
        $result = mysqli_query($koneksi, $query);
        $row = mysqli_fetch_assoc($result);

        // Periksa apakah data barang ditemukan
        if ($row) {
        ?>
        <form action="proses_editetalase.php" method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="nama_barang"><b>Nama Produk :</b></label>
            <input type="text" id="nama_barang" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" required>
            <div id="nama_error" class="error"></div>
            
            <label for="jumlah"><b>Jumlah :</b></label>
            <input type="number" id="jumlah" name="jumlah" value="<?php echo $row['jumlah']; ?>" required>
            <div id="jumlah_error" class="error"></div>
            
            <label for="harga"><b>Harga :</b></label>
            <input type="text" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>
            <div id="harga_error" class="error"></div>
            
            <label for="tanggal"><b>Tanggal :</b></label>
            <input type="date" id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
            
            <button type="submit">Update Data</button>
        </form>
        <?php
        } else {
            echo "<p>Data tidak ditemukan.</p>";
        }
        ?>
    </div>
    <script>
        function validateForm() {
            let isValid = true;
            
            // Validasi Nama Barang
            const namaBarang = document.getElementById('nama_barang').value;
            const namaError = document.getElementById('nama_error');
            if (!/^[a-zA-Z\s]+$/.test(namaBarang)) {
                namaError.textContent = 'Nama produk hanya boleh berisi huruf.';
                isValid = false;
            } else {
                namaError.textContent = '';
            }

            // Validasi Jumlah
            const jumlah = document.getElementById('jumlah').value;
            const jumlahError = document.getElementById('jumlah_error');
            if (!/^\d+$/.test(jumlah)) {
                jumlahError.textContent = 'Jumlah hanya boleh berisi angka.';
                isValid = false;
            } else {
                jumlahError.textContent = '';
            }

            // Validasi Harga
            const harga = document.getElementById('harga').value;
            const hargaError = document.getElementById('harga_error');
            if (!/^\d+(\.\d{1,2})?$/.test(harga)) {
                hargaError.textContent = 'Harga hanya boleh berisi angka dengan maksimal dua desimal.';
                isValid = false;
            } else {
                hargaError.textContent = '';
            }

            return isValid;
        }
    </script>
</body>
</html>
