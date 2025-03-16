<?php 
include 'koneksi_checkin.php'; 

// Konfigurasi pagination
$limit = 8; // Jumlah data per halaman
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Pencarian berdasarkan tanggal
$search_date = isset($_GET['search_date']) ? $_GET['search_date'] : '';

// Menghitung total data dengan pencarian
$total_sql = "SELECT COUNT(*) FROM checkin";
if (!empty($search_date)) {
    $total_sql .= " WHERE tanggal = '$search_date'";
}
$total_result = $conn->query($total_sql);
$total_data = $total_result->fetch_row()[0];
$total_pages = ceil($total_data / $limit);

// Mengambil data dengan pagination dan pencarian
$sql = "SELECT * FROM checkin";
if (!empty($search_date)) {
    $sql .= " WHERE tanggal = '$search_date'";
}
$sql .= " LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

// Menghitung total biaya check-in berdasarkan tanggal yang dipilih
$total_cost_sql = "SELECT SUM(biaya_checkin) FROM checkin";
if (!empty($search_date)) {
    $total_cost_sql .= " WHERE tanggal = '$search_date'";
}
$total_cost_result = $conn->query($total_cost_sql);
$total_cost = $total_cost_result->fetch_row()[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-in Harian</title>
    <!-- Menambahkan Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #333;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 25px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            max-width: 1080px;
            width: 100%;
        }
        h1 {
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }
        .btn-custom {
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        .btn-primary {
            background: #6a11cb;
            border: none;
        }
        .btn-secondary {
            background: #2575fc;
            border: none;
        }
        .d-flex {
            justify-content: space-between;
            align-items: center;
        }
        .form-inline {
            display: flex;
            align-items: center;
        }
        .form-inline .form-control {
            margin-right: 10px;
        }
        .total-cost {
            font-size: 1.2em;
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4"><b>Check-in Harian Pelanggan</b></h1>
        <p><center>&middot;</center></p>
        <div class="d-flex mb-3">
            <a href="tambah_checkin.php" class="btn btn-primary btn-custom">Tambah Data</a>
            <form class="form-inline" method="GET" action="">
                <input type="date" name="search_date" class="form-control" placeholder="Cari Tanggal" value="<?php echo $search_date; ?>">
                <button type="submit" class="btn btn-info btn-custom">Cari</button>
            </form>
            <a href="index.php" class="btn btn-secondary btn-custom">Kembali ke Beranda</a>
        </div>
        
        <!-- Menampilkan total biaya check-in -->
        <?php if (!empty($search_date)): ?>
            <div class="total-cost">
         Total Biaya Check-In untuk <?php echo htmlspecialchars($search_date); ?>: Rp. <?php echo number_format($total_cost, 0, ',', '.'); ?>
            </div>
        <?php endif; ?>

        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th><center>ID</center></th>
                    <th><center>Nama Pelanggan</center></th>
                    <th><center>Biaya CheckIn</center></th>
                    <th><center>Tanggal CheckIn</center></th>
                    <th><center>Aksi</center></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>".$row["id"]."</td>
                            <td>".$row["nama"]."</td>
                            <td>Rp.".$row['biaya_checkin']."</td>
                            <td>".$row["tanggal"]."</td>
                            <td class='text-center'>
                                <a href='edit_checkin.php?id=".$row["id"]."' class='btn btn-warning btn-sm btn-custom'>Edit</a>
                                <a href='hapus_checkin.php?id=".$row["id"]."' class='btn btn-danger btn-sm btn-custom delete-btn'>Hapus</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php if($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page-1; ?>">Sebelumnya</a></li>
                <?php endif; ?>
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if($i == $page) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <?php if($page < $total_pages): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page+1; ?>">Selanjutnya</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <!-- Menambahkan Bootstrap JS dan dependensi -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            
            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const userConfirmed = confirm('Apakah Anda yakin ingin menghapus data ini?');
                    if (userConfirmed) {
                        window.location.href = this.href;
                    }
                });
            });
        });
    </script>
</body>
</html>
