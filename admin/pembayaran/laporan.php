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
$pdf->Cell(275,7,'DATA PEMBAYARAN HOTEL ALIDA',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(275,7,'Data Pembayaran',0,1,'C');

$pdf->Line(300,23,-300,23);
$pdf->Line(300,23.5,-300,23.5);
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial', 'B',10);
$pdf->Cell(20,6, 'Kode',1,0);
$pdf->Cell(40,6, 'Nama',1,0);
$pdf->Cell(40,6, 'Jumlah',1,0);
$pdf->Cell(40,6, 'Bank',1,0);
$pdf->Cell(40,6, 'No Rekening',1,0);
$pdf->Cell(40,6, 'Nama Pemilik Rekening',1,1);

$pdf->SetFont('Arial', '',10);
include '../../datamaster/koneksiDB.php';
$bayar = $pdo ->query("SELECT * FROM pembayaran ORDER by idpesan asc");
while ($row = $bayar->fetch()){
    $pdf->Cell(20,6,$row['idpesan'],1,0);
    $pdf->Cell(40,6,$row['nama'],1,0);
    $pdf->Cell(40,6,$row['jumlah'],1,0);
    $pdf->Cell(40,6,$row['bank'],1,0);
    $pdf->Cell(40,6,$row['norek'],1,0);
    $pdf->Cell(40,6,$row['namarek'],1,1);
}

$pdf->Output();
?>