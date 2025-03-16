<?php
include 'koneksi_rekap.php';

// Konfigurasi pagination
$limit = 8; // Jumlah data per halaman
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Menangani pencarian
$search_date = isset($_GET['search_date']) ? $_GET['search_date'] : '';

// Menghitung total data dengan filter pencarian
$total_sql = "SELECT COUNT(*) FROM rekap_keuangan";
if ($search_date) {
    $total_sql .= " WHERE tanggal = '$search_date'";
}
$total_result = $koneksi->query($total_sql);
$total_data = $total_result->fetch_row()[0];
$total_pages = ceil($total_data / $limit);

// Mengambil data dengan pagination dan filter pencarian
$query = "SELECT * FROM rekap_keuangan";
if ($search_date) {
    $query .= " WHERE tanggal = '$search_date'";
}
$query .= " ORDER BY tanggal DESC LIMIT $limit OFFSET $offset";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Keuangan Gym</title>
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
        .btn-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .search-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .search-container input {
            margin-right: 10px;
        }
        .modal-confirm {        
            color: #636363;
            width: 400px;
        }
        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
        }
        .modal-confirm .modal-header {
            border-bottom: none;   
            position: relative;
        }
        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }
        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -5px;
        }
        .modal-confirm .modal-body {
            text-align: center;
            font-size: 14px;
        }
        .modal-confirm .modal-footer {
            color: #fff;
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            padding: 10px 15px;
        }
        .modal-confirm .modal-footer a {
            color: #fff;
        }       
        .modal-confirm .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f15e5e;
        }
        .modal-confirm .icon-box i {
            color: #f15e5e;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }
        .modal-confirm .btn-danger {
            background: #f15e5e;
            border: none;
            line-height: normal;
            text-transform: uppercase;
            padding: 6px 20px;
            border-radius: 5px;
            margin-top: 10px;
        }
        .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
            background: #ee3535;
            outline: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center"><b>Laporan Data Keuangan Gym</b></h1>
        <p><center>&middot;</center></p>
        <div class="btn-container">
            <a href="tambah_rekap.php" class="btn btn-primary">Tambah Data</a>
            <div class="search-container">
                <form class="form-inline" method="GET" action="">
                    <input type="date" name="search_date" class="form-control" placeholder="Cari Tanggal" value="<?php echo $search_date; ?>">
                    <button type="submit" class="btn btn-secondary">Cari</button>
                </form>
                <a href="generate_pdf.php?search_date=<?php echo $search_date; ?>" class="btn btn-secondary ml-2">Download Laporan PDF</a>
            </div>
            <a href="index.php" class="btn btn-secondary">Kembali ke Beranda</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th><center>No</center></th>
                    <th><center>Tanggal</center></th>
                    <th><center>Checkin Harian</center></th>
                    <th><center>Daftar Member</center></th>
                    <th><center>Etalase Penjualan</center></th>
                    <th><center>Total Semua</center></th>
                    <th><center>Aksi</center></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = $offset + 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>";
                    echo "<td>" . $row['tanggal'] . "</td>";
                    echo "<td>Rp. " . $row['total_checkin_harian'] . "</td>";
                    echo "<td>Rp. " . $row['paket_member'] . "</td>";
                    echo "<td>Rp. " . $row['etalase_penjualan'] . "</td>";
                    echo "<td>Rp. " . $row['total_semua'] . "</td>";
                    echo "<td>
                            <a href='edit_rekap.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                            <button class='btn btn-danger btn-sm' onclick='confirmDelete(" . $row['id'] . ")'>Hapus</button>
                          </td>";
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

    <!-- Modal HTML -->
    <div id="deleteModal" class="modal fade">
        <div class="modal-dialog modal-confirm">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="material-icons">&#xE5CD;</i>
                    </div>              
                    <h4 class="modal-title">Apakah Anda yakin?</h4>    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda benar ingin menghapus data ini? Proses ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
                    <a href="#" id="confirmDeleteBtn" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function confirmDelete(id) {
            $('#confirmDeleteBtn').attr('href', 'hapus_rekap.php?id=' + id);
            $('#deleteModal').modal('show');
        }
    </script>
</body>
</html>
