<?php
// Sisipkan koneksi ke database
include 'koneksi_etalase.php';

// Konfigurasi pagination
$limit = 8; // Jumlah data per halaman
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Menangani pencarian
$search_date = isset($_GET['search_date']) ? $_GET['search_date'] : '';

// Menghitung total data
$total_sql = "SELECT COUNT(*) FROM etalase_penjualan";
if (!empty($search_date)) {
    $total_sql .= " WHERE tanggal = '$search_date'";
}
$total_result = mysqli_query($koneksi, $total_sql);
$total_data = mysqli_fetch_row($total_result)[0];
$total_pages = ceil($total_data / $limit);

// Mengambil data dengan pagination dan pencarian
$query = "SELECT * FROM etalase_penjualan";
if (!empty($search_date)) {
    $query .= " WHERE tanggal = '$search_date'";
}
$query .= " LIMIT $limit OFFSET $offset";
$result = mysqli_query($koneksi, $query);

// Menghitung total harga berdasarkan tanggal yang dipilih
$total_price_sql = "SELECT SUM(total) FROM etalase_penjualan";
if (!empty($search_date)) {
    $total_price_sql .= " WHERE tanggal = '$search_date'";
}
$total_price_result = mysqli_query($koneksi, $total_price_sql);
$total_price = mysqli_fetch_row($total_price_result)[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Etalase Penjualan - Daftar Barang</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #333;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 25px;
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 1080px;
            width: 100%;
        }
        h1 {
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }
        .table thead th {
            background-color: #343a40;
            color: white;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }
        .btn-custom {
            padding: 5px 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .btn-primary, .btn-secondary {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .btn-primary {
            background: #6a11cb;
            border: none;
        }
        .btn-secondary {
            background: #2575fc;
            border: none;
        }
        .total-price {
            font-size: 1.2em;
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center"><b>Daftar Etalase Penjualan Produk</b></h1>
        <p><center>&middot;</center></p>
        <div class="d-flex justify-content-between mb-3">
            <a href="tambah_etalase.php" class="btn btn-primary">Tambah Data</a>
            <form class="form-inline" method="GET" action="">
                <input type="date" name="search_date" class="form-control mr-2" value="<?php echo htmlspecialchars($search_date); ?>">
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
            <a href="index.php" class="btn btn-secondary">Kembali ke Beranda</a>
        </div>
        
        <!-- Menampilkan total harga -->
        <?php if (!empty($search_date)): ?>
            <div class="total-price">
                Total Penjualan Etalase Produk untuk <?php echo htmlspecialchars($search_date); ?>: Rp. <?php echo number_format($total_price, 0, ',', '.'); ?>
            </div>
        <?php endif; ?>

        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th><center>No</center></th>
                    <th><center>Nama Barang</center></th>
                    <th><center>Jumlah</center></th>
                    <th><center>Harga</center></th>
                    <th><center>Total</center></th>
                    <th><center>Tanggal</center></th>
                    <th><center>Aksi</center></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = $offset + 1;

                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $no . "</td>";
                        echo "<td>" . htmlspecialchars($row['nama_barang']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['jumlah']) . "</td>";
                        echo "<td>Rp. " . number_format($row['harga'], 0, ',', '.') . "</td>";
                        echo "<td>Rp. " . number_format($row['total'], 0, ',', '.') . "</td>";
                        echo "<td>" . htmlspecialchars($row['tanggal']) . "</td>";
                        echo "<td class='text-center'>";
                        echo "<a href='edit_etalase.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-warning btn-sm btn-custom'>Edit</a> ";
                        echo "<a href='hapus_etalase.php?id=" . htmlspecialchars($row['id']) . "' class='btn btn-danger btn-sm btn-custom' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>";
                        echo "</td>";
                        echo "</tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php if($page > 1): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page-1; ?>&search_date=<?php echo htmlspecialchars($search_date); ?>">Sebelumnya</a></li>
                <?php endif; ?>
                <?php for($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if($i == $page) echo 'active'; ?>"><a class="page-link" href="?page=<?php echo $i; ?>&search_date=<?php echo htmlspecialchars($search_date); ?>"><?php echo $i; ?></a></li>
                <?php endfor; ?>
                <?php if($page < $total_pages): ?>
                    <li class="page-item"><a class="page-link" href="?page=<?php echo $page+1; ?>&search_date=<?php echo htmlspecialchars($search_date); ?>">Selanjutnya</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
