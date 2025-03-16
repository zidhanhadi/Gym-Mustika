<?php
include 'koneksi_checkin.php';
$id = $_GET['id'];
$sql = "SELECT * FROM checkin WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Check-in Harian</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 59vh;
        }
        .container {
            max-width: 500px;
            width: 100%;
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 30px;
            font-weight: 600;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-weight: 500;
        }
        input[type="text"], input[type="date"], input[type="number"] {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            margin-bottom: 20px;
            border: 2px solid #ccc;
            border-radius: 10px;
            box-sizing: border-box;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        input[type="text"]:focus, input[type="date"]:focus, input[type="number"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
            outline: none;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .btn-back {
            display: block;
            margin: 20px 0 10px 0;
            text-align: center;
        }
        .btn-back a {
            text-decoration: none;
            color: #007bff;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        .btn-back a:hover {
            color: #0056b3;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: -15px;
            margin-bottom: 15px;
        }
    </style>
    <script>
        function validateInput(event) {
            const input = event.target.value;
            const regex = /^[A-Za-z\s]*$/;
            const errorMessage = document.getElementById('error-message');

            if (!regex.test(input)) {
                errorMessage.textContent = "Nama hanya boleh mengandung huruf dan spasi.";
                event.target.value = input.replace(/[^A-Za-z\s]/g, '');
            } else {
                errorMessage.textContent = "";
            }
        }

        function validateForm(event) {
            const nama = document.getElementById('nama').value;
            const regex = /^[A-Za-z\s]*$/;

            if (!regex.test(nama)) {
                event.preventDefault();
                alert("Nama hanya boleh mengandung huruf dan spasi.");
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2><b>Edit Data Check-in Harian</b></h2>
        <form method="post" action="proses_editcheckin.php" onsubmit="validateForm(event)">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label for="nama"><b>Nama Pelanggan :</b></label>
            <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required oninput="validateInput(event)">
            <div id="error-message" class="error-message"></div>
            <label for="biaya_checkin">Biaya CheckIn :</label>
            <input type="number" id="biaya_checkin" name="biaya_checkin" value="<?php echo $row['biaya_checkin']; ?>" required>
            <label for="tanggal"><b>Tanggal :</b></label>
            <input type="date" id="tanggal" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>