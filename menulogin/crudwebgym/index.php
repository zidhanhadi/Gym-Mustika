<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Administrasi Gym</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            height: 60vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
        }
        .sidebar {
            height: 65px;
            background-color: rgba(51, 51, 51, 0.8);
            color: #fff;
            display: flex;
            justify-content: space-around;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .sidebar a {
            padding: 15px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
        }
        .sidebar a:hover {
            background-color: #1B4F72;
            transform: translateY(-2px);
        }
        .content {
            padding-top: 100px;
            width: 100%;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
        }
        .container {
            max-width: 900px;
            margin: 20px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
            text-align: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }
        h4 {
            color: #333;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        .btn:hover {
            background-color: #0062cd;
            transform: translateY(-10px);
        }
        .arrow {
            position: relative;
            display: inline-block;
            width: 15px;
            height: 15px;
            border: solid black;
            border-width: 0 3px 3px 0;
            transform: rotate(-135deg);
            animation: bounce 1.5s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0) rotate(-135deg);
            }
            40% {
                transform: translateY(-10px) rotate(-135deg);
            }
            60% {
                transform: translateY(-5px) rotate(-135deg);
            }
        }
        .neon-line {
            position: relative;
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, #fff, #f0f, #fff);
            animation: neon-blink 1s infinite alternate, neon-glow 2s infinite;
        }

        @keyframes neon-blink {
            from {
                text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #fff, 0 0 40px #f0f, 0 0 70px #f0f, 0 0 80px #f0f, 0 0 100px #f0f, 0 0 150px #f0f;
            }
            to {
                text-shadow: none;
            }
        }

        @keyframes neon-glow {
            0%, 100% {
                box-shadow: 0 0 10px #fff, 0 0 20px #f0f, 0 0 30px #fff, 0 0 40px #f0f, 0 0 70px #f0f, 0 0 80px #f0f, 0 0 100px #f0f, 0 0 150px #f0f;
            }
            50% {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="checkin.php">Check-in Harian</a>
        <a href="member.php">Daftar Member Gym</a>
        <a href="etalase.php">Etalase Penjualan Produk</a>
        <a href="rekap.php">Laporan Keuangan</a>
    </div>
    <div class="content">
        <div class="container">
        <div class="arrow"></div>
            <h1>"Selamat Datang di Halaman Data Administrasi Gym"</h1><p>
           <center> <div class="neon-line"></div></center>
            <h4>Pilih Menu Navigasi Kelola Data Di Atas Untuk Memulai.</h4>
        </div>
    </div>
</body>
</html>