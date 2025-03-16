<?php include 'koneksi_checkin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Check-in Harian</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 58vh;
        }
        .container {
            max-width: 500px;
            width: 100%;
            padding: 20px 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
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
            text-align: left;
        }
        input[type="text"], input[type="date"], input[type="number"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
            transition: border-color 0.3s;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        input[type="text"]:focus, input[type="date"]:focus, input[type="number"]:focus {
            border-color: #007bff;
            outline: none;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            font-size: 17px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .error {
            color: red;
            margin-top: -15px;
            margin-bottom: 15px;
            font-size: 14px;
            text-align: left;
        }
    </style>
    <script>
        function validateName(input) {
            const namePattern = /^[a-zA-Z\s]*$/;
            const errorElement = document.getElementById('nameError');
            if (!namePattern.test(input.value)) {
                errorElement.textContent = 'Nama hanya boleh berisi huruf dan spasi.';
                input.style.borderColor = 'red';
                return false;
            } else {
                errorElement.textContent = '';
                input.style.borderColor = '';
                return true;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Tambah Data Check-in Harian</h2>
        <form method="post" action="proses_tambahcheckin.php" onsubmit="return validateForm()">
            <label for="nama"><b>Nama Pelanggan :</b></label>
            <input type="text" id="nama" name="nama" required oninput="validateName(this)">
            <div id="nameError" class="error"></div>

            <label for="biaya_checkin"><b>Biaya CheckIn :</b></label>
            <input type="number" id="biaya_checkin" name="biaya_checkin" value="5000" required>
            <div id="biayaError" class="error"></div>

            <label for="tanggal"><b>Tanggal :</b></label>
            <input type="date" id="tanggal" name="tanggal" required>
            <input type="submit" value="Simpan Data">
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>