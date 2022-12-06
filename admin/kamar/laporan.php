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
$pdf->Cell(275,7,'DATA KAMAR HOTEL ALIDA',0,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->Cell(275,7,'Data Kamar',0,1,'C');

$pdf->Line(300,23,-300,23);
$pdf->Line(300,23.5,-300,23.5);
// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial', 'B',10);
$pdf->Cell(35,6, 'Id',1,0);
$pdf->Cell(25,6, 'Tipe',1,0);
$pdf->Cell(25,6, 'Jumlah',1,0);
$pdf->Cell(25,6, 'Harga (Rp)',1,0);
$pdf->Cell(100,6, 'Nama Gambar',1,1);

$pdf->SetFont('Arial', '',10);
include '../../datamaster/koneksiDB.php';
$bayar = $pdo ->query("SELECT * FROM kamar ORDER by idkamar asc");
while ($row = $bayar->fetch()){
    $pdf->Cell(35,6,$row['idkamar'],1,0);
    $pdf->Cell(25,6,$row['tipe'],1,0);
    $pdf->Cell(25,6,$row['jumlah'],1,0);
    $pdf->Cell(25,6,$row['harga'],1,0);
    $pdf->Cell(100,6,$row['gambar'],1,1);
}

$pdf->Output();
?>