<?php
require('fpdf/fpdf.php');
include 'koneksi_rekap.php';

class PDF extends FPDF
{
    function Header()
    {
        // Set font
        $this->SetFont('Arial', 'B', 15);
        // Title
        $this->SetFillColor(230, 230, 230);
        $this->Cell(0, 10, 'Laporan Rekap Data Keuangan Gym Mustika Fitness Centre', 0, 1, 'C', true);
        // Line break
        $this->Ln(10);
    }

    function Footer()
    {
        // Go to 1.5 cm from bottom
        $this->SetY(-15);
        // Select Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Halaman ' . $this->PageNo(), 0, 0, 'C');
    }

    function LoadData()
    {
        global $koneksi;
        $search_date = isset($_GET['search_date']) ? $_GET['search_date'] : '';
        $query = "SELECT * FROM rekap_keuangan";
        if ($search_date) {
            $query .= " WHERE tanggal = '$search_date'";
        }
        $query .= " ORDER BY tanggal DESC";
        return $koneksi->query($query);
    }

    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(0, 102, 204);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 51, 102);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(10, 30, 40, 40, 40, 40);
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 10, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        $no = 1;
        while ($row = $data->fetch_assoc()) {
            $this->Cell($w[0], 8, $no++, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 8, $row['tanggal'], 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 8, 'Rp. ' . number_format($row['total_checkin_harian']), 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 8, 'Rp. ' . number_format($row['paket_member']), 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 8, 'Rp. ' . number_format($row['etalase_penjualan']), 'LR', 0, 'C', $fill);
            $this->Cell($w[5], 8, 'Rp. ' . number_format($row['total_semua']), 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
$header = array('No', 'Tanggal', 'Checkin Harian', 'Daftar Member', 'Etalase Penjualan', 'Total Semua');
$data = $pdf->LoadData();
$pdf->FancyTable($header, $data);
$pdf->Output();
?>
