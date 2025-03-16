<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <!-- Link to Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
           font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 62vh;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 25px 35px;
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
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #6a11cb;
            border-color: #6a11cb;
            border-radius: 12px;
            padding: 9px;
            width: 100%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .invalid-feedback {
            display: none;
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><b>Tambah Data Penjualan Produk</b></h2>
        <form id="form" action="proses_tambahetalase.php" method="POST">
            <div class="form-group">
                <label for="nama_barang">Nama Produk :</label>
                <input type="text" id="nama_barang" name="nama_barang" class="form-control" required>
                <div id="nama_error" class="invalid-feedback">Nama produk hanya boleh huruf saja.</div>
            </div>
            <div class="form-group">
                <label for="jumlah">Jumlah :</label>
                <input type="number" id="jumlah" name="jumlah" class="form-control" required>
                <div id="jumlah_error" class="invalid-feedback">Jumlah hanya boleh angka saja.</div>
            </div>
            <div class="form-group">
                <label for="harga">Harga :</label>
                <input type="number" id="harga" name="harga" class="form-control" required>
                <div id="harga_error" class="invalid-feedback">Harga hanya boleh angka saja.</div>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal :</label>
                <input type="date" id="tanggal" name="tanggal" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </form>
    </div>
    <!-- Link to Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.getElementById('form').addEventListener('submit', function(event) {
            let isValid = true;

            // Validasi nama barang
            const namaBarang = document.getElementById('nama_barang');
            const namaError = document.getElementById('nama_error');
            const namaRegex = /^[a-zA-Z\s]+$/;
            if (!namaRegex.test(namaBarang.value)) {
                namaError.style.display = 'block';
                namaBarang.classList.add('is-invalid');
                isValid = false;
            } else {
                namaError.style.display = 'none';
                namaBarang.classList.remove('is-invalid');
            }

            // Validasi jumlah
            const jumlah = document.getElementById('jumlah');
            const jumlahError = document.getElementById('jumlah_error');
            if (isNaN(jumlah.value) || jumlah.value === '') {
                jumlahError.style.display = 'block';
                jumlah.classList.add('is-invalid');
                isValid = false;
            } else {
                jumlahError.style.display = 'none';
                jumlah.classList.remove('is-invalid');
            }

            // Validasi harga
            const harga = document.getElementById('harga');
            const hargaError = document.getElementById('harga_error');
            if (isNaN(harga.value) || harga.value === '') {
                hargaError.style.display = 'block';
                harga.classList.add('is-invalid');
                isValid = false;
            } else {
                hargaError.style.display = 'none';
                harga.classList.remove('is-invalid');
            }

            if (!isValid) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>