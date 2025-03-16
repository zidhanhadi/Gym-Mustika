-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Jul 2024 pada 01.38
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `datagym`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `checkin`
--

CREATE TABLE `checkin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `biaya_checkin` decimal(10,0) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `checkin`
--

INSERT INTO `checkin` (`id`, `nama`, `biaya_checkin`, `tanggal`) VALUES
(1, 'Kevin Adi', 5000, '2024-07-20'),
(2, 'Sunarto', 5000, '2024-07-20'),
(3, 'Debi', 5000, '2024-06-25'),
(4, 'Sugeng', 5000, '2024-06-25'),
(5, 'Anifatus', 5000, '2024-06-25'),
(6, 'Supri', 5000, '2024-06-25'),
(7, 'Diana', 5000, '2024-06-25'),
(8, 'Dina', 5000, '2024-06-25'),
(9, 'Ayu', 5000, '2024-06-26'),
(10, 'Narmi', 5000, '2024-06-26'),
(11, 'Bintang', 5000, '2024-06-26'),
(12, 'Rizki', 5000, '2024-06-26'),
(13, 'Putra', 5000, '2024-06-26'),
(14, 'Ibra', 5000, '2024-06-26'),
(15, 'Hansen', 5000, '2024-06-26'),
(16, 'Hadi', 5000, '2024-06-26'),
(17, 'Aulia', 5000, '2024-06-27'),
(18, 'Ulwi', 5000, '2024-06-27'),
(19, 'Rafi', 5000, '2024-06-27'),
(20, 'Nizam', 5000, '2024-06-27'),
(21, 'Bagas', 5000, '2024-06-27'),
(22, 'Noval', 5000, '2024-06-27'),
(23, 'Zulmi', 5000, '2024-06-27'),
(24, 'Yafis', 5000, '2024-06-27'),
(48, 'Wahyuni', 5000, '2024-06-28'),
(49, 'Isa', 5000, '2024-06-28'),
(50, 'Edo', 5000, '2024-06-28'),
(51, 'Dery', 5000, '2024-06-28'),
(52, 'Siti', 5000, '2024-06-28'),
(53, 'Farro', 5000, '2024-06-28'),
(54, 'Doni', 5000, '2024-06-28'),
(55, 'Raffles', 5000, '2024-06-28');

-- --------------------------------------------------------

--
-- Struktur dari tabel `etalase_penjualan`
--

CREATE TABLE `etalase_penjualan` (
  `id` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `etalase_penjualan`
--

INSERT INTO `etalase_penjualan` (`id`, `nama_barang`, `jumlah`, `harga`, `total`, `tanggal`) VALUES
(2, 'Cleo gelas', 22, 1000, 22000, '2024-07-20'),
(3, 'Wafer Nabati', 8, 5000, 40000, '2024-07-20'),
(4, 'Aqua Gelas', 15, 1000, 15000, '2024-06-25'),
(6, 'TikTak', 10, 1000, 10000, '2024-06-25'),
(8, 'Mie kremes', 25, 1000, 25000, '2024-06-25'),
(10, 'Potato Chip', 10, 500, 5000, '2024-06-26'),
(11, 'Aqua botol', 5, 4000, 20000, '2024-06-26'),
(12, 'Roti Aoka', 12, 2500, 30000, '2024-06-26'),
(13, 'Chocolatos', 9, 1000, 9000, '2024-06-26'),
(14, 'Teh botol', 5, 4000, 20000, '2024-06-26'),
(17, 'Club', 5, 5000, 25000, '2024-06-26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_member`
--

CREATE TABLE `paket_member` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `nomor_telepon` varchar(20) NOT NULL,
  `nomor_member` varchar(50) NOT NULL,
  `biaya_administrasi` decimal(10,0) NOT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `paket_member`
--

INSERT INTO `paket_member` (`id`, `nama`, `tanggal_lahir`, `alamat`, `nomor_telepon`, `nomor_member`, `biaya_administrasi`, `tanggal`) VALUES
(12, 'Syahmila', '2000-06-12', 'Ngambak, Beru', '082237430677', '30623', 60000, '2024-07-20'),
(13, 'Sriani', '1995-06-18', 'Ngambak, Beru', '082237430263', '30001', 60000, '2024-07-20'),
(15, 'Edy', '1990-07-25', 'Wlingi', '081243554678', '30477', 60000, '2024-06-30'),
(16, 'Arief', '1999-02-24', 'Beru', '085433218654', '30410', 60000, '2024-06-30'),
(17, 'Ulim', '1993-10-26', 'Talun', '082236543771', '30055', 60000, '2024-06-30'),
(18, 'Lilik', '1997-05-19', 'Wlingi', '085432226433', '30280', 60000, '2024-06-30'),
(19, 'Hari', '1985-02-13', 'Beru, Wlingi', '085455321776', '30432', 60000, '2024-06-30'),
(20, 'Nina', '1999-07-20', 'Wlingi', '082234765443', '30573', 60000, '2024-06-30'),
(21, 'Suyanto', '1988-08-26', 'Talun', '085554327124', '30004', 60000, '2024-07-01'),
(22, 'Deni', '2000-01-04', 'Jajar, Talun', '081254337665', '30350', 60000, '2024-07-01'),
(23, 'Yohana', '2001-05-29', 'Beru, Wlingi', '085433287987', '30676', 60000, '2024-07-01'),
(24, 'Dimas', '1999-01-11', 'Gandusari', '081564223897', '30688', 60000, '2024-07-01'),
(25, 'Suhantoro', '1990-06-27', 'Talun', '081232665328', '30451', 60000, '2024-07-01'),
(26, 'Muti', '1988-02-02', 'Beru, Wlingi', '082233675443', '30159', 60000, '2024-07-01'),
(27, 'Ratri Ilma', '1995-10-23', 'Talun', '081223675334', '30572', 60000, '2024-07-01'),
(28, 'Arfan Hutama', '1993-10-19', 'Jeblog, Talun', '085234221874', '30351', 60000, '2024-07-01'),
(29, 'Edi P', '1985-11-11', 'Wlingi', '0895423221', '30028', 60000, '2024-07-02'),
(30, 'Bastian', '1998-12-22', 'Jajar, Talun', '085532334887', '30272', 60000, '2024-07-02'),
(31, 'Saiful Ahmad', '2001-06-13', 'Wlingi', '082275443189', '30694', 60000, '2024-07-02'),
(32, 'Yafis', '1995-05-16', 'Babadan', '081125439765', '30645', 60000, '2024-07-02'),
(33, 'Iskandar', '2001-09-12', 'Balerejo', '082234554332', '30608', 60000, '2024-07-02'),
(35, 'Permadi', '1983-01-18', 'Tangkil, Wlingi', '082234554223', '30586', 60000, '2024-07-02'),
(36, 'Ferdi', '2024-06-27', 'Ngadirenggo', '081125432265', '30654', 60000, '2024-07-02'),
(37, 'Heru', '1993-11-24', 'Tegalasri', '085433218765', '30008', 60000, '2024-07-02'),
(38, 'Sapta Danang', '2024-06-27', 'Beru, Wlingi', '082235443765', '30399', 60000, '2024-07-03'),
(39, 'Bibit yuni', '2000-05-25', 'Talun', '082265554376', '30541', 60000, '2024-07-03'),
(41, 'Faisal', '1998-06-16', 'Jajar, Talun', '082237430211', '30554', 60000, '2024-07-03'),
(47, 'Frengki', '1991-05-14', 'Tambakan', '082564332987', '30675', 60000, '2024-07-03'),
(48, 'Bintang', '1995-10-10', 'Tangkil', '085432226433', '30685', 60000, '2024-07-04'),
(49, 'Mahesa', '1999-01-04', 'Babadan', '082234765488', '30690', 60000, '2024-07-04'),
(50, 'Angga', '1998-10-20', 'Klemunan', '082237430621', '30152', 60000, '2024-07-04'),
(51, 'Afik', '2001-05-07', 'Beru, Wlingi', '085432226409', '30024', 60000, '2024-07-04'),
(52, 'Bu santi', '1995-05-18', 'Talun', '082234765467', '30543', 60000, '2024-07-18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekap_keuangan`
--

CREATE TABLE `rekap_keuangan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `total_checkin_harian` decimal(10,0) NOT NULL,
  `paket_member` decimal(10,0) NOT NULL,
  `etalase_penjualan` decimal(10,0) NOT NULL,
  `total_semua` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rekap_keuangan`
--

INSERT INTO `rekap_keuangan` (`id`, `tanggal`, `total_checkin_harian`, `paket_member`, `etalase_penjualan`, `total_semua`) VALUES
(1, '2024-07-23', 240000, 120000, 32000, 392000),
(2, '2024-07-18', 205000, 180000, 41000, 426000),
(3, '2024-07-22', 190000, 180000, 22000, 392000),
(4, '2024-07-19', 275000, 120000, 42000, 437000),
(5, '2024-07-17', 225000, 180000, 25000, 430000),
(7, '2024-07-20', 210000, 120000, 20000, 350000),
(8, '2024-07-21', 250000, 60000, 25000, 335000),
(9, '2024-07-24', 200000, 300000, 60000, 560000),
(37, '2024-07-16', 280000, 180000, 45000, 505000),
(38, '2024-07-15', 230000, 120000, 35000, 385000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `checkin`
--
ALTER TABLE `checkin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `etalase_penjualan`
--
ALTER TABLE `etalase_penjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `paket_member`
--
ALTER TABLE `paket_member`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `rekap_keuangan`
--
ALTER TABLE `rekap_keuangan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `checkin`
--
ALTER TABLE `checkin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT untuk tabel `etalase_penjualan`
--
ALTER TABLE `etalase_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `paket_member`
--
ALTER TABLE `paket_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `rekap_keuangan`
--
ALTER TABLE `rekap_keuangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
