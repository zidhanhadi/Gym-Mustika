<?php
include 'koneksi_member.php';

// Konfigurasi pagination
$limit = 8; // Jumlah data per halaman
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Menghitung total data
$total_sql = "SELECT COUNT(*) FROM paket_member";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $total_sql .= " WHERE tanggal LIKE '%$search%'";
}
$total_result = $koneksi->query($total_sql);
$total_data = $total_result->fetch_row()[0];
$total_pages = ceil($total_data / $limit);

// Mengambil data dengan pagination
$query = "SELECT * FROM paket_member";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $query .= " WHERE tanggal LIKE '%$search%'";
}
$query .= " LIMIT $limit OFFSET $offset";
$result = $koneksi->query($query);

// Menghitung total biaya administrasi berdasarkan tanggal yang dipilih
$total_cost_sql = "SELECT SUM(biaya_administrasi) FROM paket_member";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $total_cost_sql .= " WHERE tanggal LIKE '%$search%'";
}
$total_cost_result = $koneksi->query($total_cost_sql);
$total_cost = $total_cost_result->fetch_row()[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Paket Member</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .btn-custom {
            margin-bottom: 0px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        .action-links a {
            margin-right: 10px;
            text-decoration: none;
            color: #fff;
        }
        .action-links a:hover {
            text-decoration: none;
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
        .btn-edit {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-edit:hover {
            background-color: #ffca2a;
            border-color: #ffca2a;
        }
        .btn-delete {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        .btn-delete:hover {
            background-color: #e3616d;
            border-color: #e3616d;
        }
        .search-form {
            display: flex;
            align-items: center;
        }
        .search-form input[type="date"] {
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
        <h1 class="text-center"><b>Daftar Member Gym</b></h1>
        <p><center>&middot;</center></p>
        <div class="d-flex justify-content-between mb-4">
            <a href="tambah_member.php" class="btn btn-primary btn-custom">Tambah Data</a>
            <form class="search-form" method="GET" action="">
                <input type="date" name="search" value="<?php if (isset($_GET['search'])) echo $_GET['search']; ?>" class="form-control" placeholder="Cari Tanggal">
                <button type="submit" class="btn btn-info">Cari</button>
            </form>
            <a href="index.php" class="btn btn-secondary btn-custom">Kembali ke Beranda</a>
        </div>
        
        <!-- Menampilkan total biaya administrasi -->
        <?php if (isset($_GET['search']) && !empty($_GET['search'])): ?>
            <div class="total-cost">
                Total Biaya Administrasi untuk <?php echo htmlspecialchars($_GET['search']); ?>: Rp. <?php echo number_format($total_cost, 0, ',', '.'); ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th><center>No</center></th>
                    <th><center>Nama</center></th>
                    <th><center>TTL</center></th>
                    <th><center>Alamat</center></th>
                    <th><center>No.Telepon</center></th>
                    <th><center>No.Member</center></th>
                    <th><center>Biaya Adm</center></th>
                    <th><center>Tgl.Input</center></th>
                    <th><center>Aksi</center></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = $offset + 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>";
                    echo "<td>" . $row['nama'] . "</td>";
                    echo "<td>" . $row['tanggal_lahir'] . "</td>";
                    echo "<td>" . $row['alamat'] . "</td>";
                    echo "<td>" . $row['nomor_telepon'] . "</td>";
                    echo "<td>" . $row['nomor_member'] . "</td>";
                    echo "<td>Rp." . $row['biaya_administrasi'] . "</td>";
                    echo "<td>" . $row['tanggal'] . "</td>";
                    echo "<td class='action-links'>";
                    echo "<a href='edit_member.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm btn-edit'>Edit</a>";
                    echo "<a href='hapus_member.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                    $no++;
                }
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
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
