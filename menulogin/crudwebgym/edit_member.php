<?php
include 'koneksi_member.php';

$id = $_GET['id'];
$query = "SELECT * FROM paket_member WHERE id = $id";
$result = $koneksi->query($query);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Member</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }
        .container {
            max-width: 600px;
            padding: 30px 40px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #333333;
            font-weight: bold;
        }
        input[type="text"], input[type="date"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 5px;
            border: 2px solid #dddddd;
            border-radius: 5px;
            font-size: 16px;
        }
        input[readonly] {
            background-color: #e9ecef;
        }
        .error {
            color: red;
            font-size: 14px;
            display: none;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #ffffff;
            padding: 9px 15px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        .btn-back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .btn-back:hover {
            color: #0056b3;
            text-decoration: underline;
        }
    </style>
    <script>
        function validateInput(event) {
            const input = event.target;
            const errorElement = input.nextElementSibling;

            if (input.id === 'nama') {
                if (!/^[a-zA-Z\s]*$/.test(input.value)) {
                    errorElement.style.display = 'block';
                    errorElement.textContent = 'Nama hanya boleh mengandung huruf dan spasi.';
                    input.setCustomValidity('Invalid field.');
                } else {
                    errorElement.style.display = 'none';
                    input.setCustomValidity('');
                }
            }

            if (input.id === 'nomor_telepon' || input.id === 'nomor_member') {
                if (!/^\d*$/.test(input.value)) {
                    errorElement.style.display = 'block';
                    errorElement.textContent = 'Nomor hanya boleh mengandung angka.';
                    input.setCustomValidity('Invalid field.');
                } else {
                    errorElement.style.display = 'none';
                    input.setCustomValidity('');
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const namaInput = document.getElementById('nama');
            const nomorTeleponInput = document.getElementById('nomor_telepon');
            const nomorMemberInput = document.getElementById('nomor_member');

            namaInput.addEventListener('input', validateInput);
            nomorTeleponInput.addEventListener('input', validateInput);
            nomorMemberInput.addEventListener('input', validateInput);
        });
    </script>
</head>
<body>
    <div class="container">
        <h2><b>Edit Data Member Gym</b></h2>
        <form action="proses_editmember.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-group">
                <label for="nama">Nama Pelanggan :</label>
                <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
                <div class="error">Nama hanya boleh mengandung huruf dan spasi.</div>
            </div>
            <div class="form-group">
                <label for="tanggal_lahir">Tanggal Lahir :</label>
                <input type="date" id="tanggal_lahir" name="tanggal_lahir" value="<?php echo $row['tanggal_lahir']; ?>" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat :</label>
                <input type="text" id="alamat" name="alamat" value="<?php echo $row['alamat']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nomor_telepon">Nomor Telepon :</label>
                <input type="text" id="nomor_telepon" name="nomor_telepon" value="<?php echo $row['nomor_telepon']; ?>" required>
                <div class="error">Nomor hanya boleh mengandung angka.</div>
            </div>
            <div class="form-group">
                <label for="nomor_member">Nomor Member :</label>
                <input type="text" id="nomor_member" name="nomor_member" value="<?php echo $row['nomor_member']; ?>" readonly required>
                <div class="error">Nomor hanya boleh mengandung angka.</div>
            </div>
            <div class="form-group">
                <label for="biaya_administrasi">Biaya Administrasi :</label>
                <input type="number" id="biaya_administrasi" name="biaya_administrasi" value="60000" readonly>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Daftar :</label>
                <input type="date" id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
            </div>
            <button type="submit">Update Data</button>
        </form>
    </div>
</body>
</html>
