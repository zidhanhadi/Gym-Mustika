<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Member</title>
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
            background-color: #fff;
            padding: 25px 40px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            max-width: 530px;
            width: 100%;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
            color: #333;
            font-weight: bold;
        }
        input[type="text"], input[type="date"], input[type="number"] {
            padding: 10px;
            margin-bottom: 18px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        input[type="text"][readonly] {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
        .error {
            color: red;
            margin-bottom: 5px;
        }
        button[type="submit"] {
            background-color: #6a11cb;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 17px;
            transition: background-color 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        button[type="submit"]:hover {
            background-color: #2575fc;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Data Member Gym</h1>
        <form id="form-member" action="proses_tambahmember.php" method="POST">
            <label for="nama">Nama Pelanggan :</label>
            <input type="text" id="nama" name="nama" required>
            <div id="namaError" class="error"></div>
            <label for="tanggal_lahir">Tanggal Lahir :</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
            <label for="alamat">Alamat :</label>
            <input type="text" id="alamat" name="alamat" required>
            <label for="nomor_telepon">Nomor Telepon :</label>
            <input type="text" id="nomor_telepon" name="nomor_telepon" required>
            <div id="teleponError" class="error"></div>
            <label for="nomor_member">Nomor Member :</label>
            <input type="text" id="nomor_member" name="nomor_member" readonly required>
            <div id="memberError" class="error"></div>
            <label for="biaya_administrasi">Biaya Administrasi :</label>
            <input type="number" id="biaya_administrasi" name="biaya_administrasi" value="60000" required>
            <div id="biayaError" class="error"></div>
            <label for="tanggal">Tanggal Daftar :</label>
            <input type="date" id="tanggal" name="tanggal" required>
            <button type="submit">Simpan Data</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Generate random 3-digit number
            const randomDigits = Math.floor(Math.random() * 900) + 100; // Generate a number between 100 and 999
            const nomorMember = '30' + randomDigits;

            // Set the generated number to the input field
            document.getElementById('nomor_member').value = nomorMember;
        });

        document.getElementById('form-member').addEventListener('submit', function(event) {
            let isValid = true;

            // Validasi nama hanya huruf
            const nama = document.getElementById('nama').value;
            if (!/^[a-zA-Z\s]+$/.test(nama)) {
                isValid = false;
                document.getElementById('namaError').textContent = 'Nama hanya boleh mengandung huruf dan spasi';
            } else {
                document.getElementById('namaError').textContent = '';
            }

            // Validasi nomor telepon hanya angka
            const nomorTelepon = document.getElementById('nomor_telepon').value;
            if (!/^\d+$/.test(nomorTelepon)) {
                isValid = false;
                document.getElementById('teleponError').textContent = 'Nomor telepon hanya boleh mengandung angka';
            } else {
                document.getElementById('teleponError').textContent = '';
            }

            // Validasi nomor member hanya angka
            const nomorMember = document.getElementById('nomor_member').value;
            if (!/^\d+$/.test(nomorMember)) {
                isValid = false;
                document.getElementById('memberError').textContent = 'Nomor member hanya boleh mengandung angka';
            } else {
                document.getElementById('memberError').textContent = '';
            }

            // Validasi biaya administrasi hanya angka
            const biayaAdministrasi = document.getElementById('biaya_administrasi').value;
            if (!/^\d+$/.test(biayaAdministrasi)) {
                isValid = false;
                document.getElementById('biayaError').textContent = 'Biaya administrasi hanya boleh mengandung angka';
            } else {
                document.getElementById('biayaError').textContent = '';
            }

            // Jika ada error, cegah submit form
            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
