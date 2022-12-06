<?php
// memanggil library FPDF
require('../../lib/fpdf.php');
// intance object dan memberikan  pengaturan halaman PDF
$pdf = new FPDF('l', 'mm', 'A4');
// membuat halaman baru
$pdf->Addpage();
// settings jenis font yang akan digunakan
$pdf->SetFont('Arial','B',16);
// mencetak string
$pdf->Cell(275,7,'DATA TAMU HOTEL ALIDA',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(275,7,'Data Tamu',0,1,'C');

$pdf->Line(300,23,-300,23);
$pdf->Line(300,23.5,-300,23.5);
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial', 'B',10);
$pdf->Cell(20,6, 'ID User',1,0);
$pdf->Cell(40,6, 'Username',1,0);
$pdf->Cell(40,6, 'Email',1,0);
$pdf->Cell(40,6, 'Nama Lengkap',1,0);
$pdf->Cell(40,6, 'Alamat',1,0);
$pdf->Cell(40,6, 'Telepon',1,1);

$pdf->SetFont('Arial', '',10);
include '../../datamaster/koneksiDB.php';
$bayar = $pdo ->query("SELECT * FROM tamu ORDER by idtamu asc");
while ($row = $bayar->fetch()){
    $pdf->Cell(20,6,$row['idtamu'],1,0);
    $pdf->Cell(40,6,$row['username'],1,0);
    $pdf->Cell(40,6,$row['email'],1,0);
    $pdf->Cell(40,6,$row['nama'],1,0);
    $pdf->Cell(40,6,$row['alamat'],1,0);
    $pdf->Cell(40,6,$row['telepon'],1,1);
}

$pdf->Output();
?>