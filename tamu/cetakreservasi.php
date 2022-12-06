<?php
	require_once "../viewmaster/header.php";
    require_once "view/ceklog.php";
    require_once "../datamaster/koneksiDB.php";
	$username = $_SESSION['ceklog'];
	$sql = $pdo->query("SELECT * FROM tamu WHERE username='$username'");
	$data = $sql->fetch();
	$idtamu = $data['idtamu'];
	$idpesan = $_GET['transaksi'];
	$sqlx = $pdo->query("SELECT * FROM pemesanan WHERE idtamu=$idtamu AND idpesan=$idpesan ORDER BY idpesan DESC");
	while($datax = $sqlx->fetch()){
		$idpesan = $datax['idpesan'];
		$tglpesan = $datax['tglpesan'];
		$batasbayar = $datax['batasbayar'];
		$idkamar = $datax['idkamar'];
		$tipe = $datax['tipe'];
		$harga = $datax['harga'];
		$jumlah = $datax['jumlah'];
		$idtamu = $datax['idtamu'];
		$namax = $datax['nama'];
		$alamat = $datax['alamat'];
		$telepon = $datax['telepon'];
		$tglmasuk = $datax['tglmasuk'];
		$tglkeluar = $datax['tglkeluar'];
		$lamahari = $datax['lamahari'];
		$totalbayar = $datax['totalbayar'];
		$status = $datax['status'];

		$tglpesann = date('d/m/Y', strtotime($tglpesan));
		$tglmasukk = date('d/m/Y', strtotime($tglmasuk));
		$tglkeluarr = date('d/m/Y', strtotime($tglkeluar));
		$batasbayarr = date('d/m/Y', strtotime($batasbayar));
		$batasjam = date('H:i:s', strtotime($batasbayar));

		$hargaa = number_format($harga,0,",",".");
		$angka = number_format($totalbayar,0,",",".");
?>
<div style="padding: 20px;">
	<table width="40%" style="background: rgba(255,255,255, 0.75); outline: 2px solid #CCC;">
		<tr align="center" style="background: rgba(427,247,247, 1);">
			<td colspan="3">Kode Transaksi : <?php echo $idpesan ?></td>
		</tr>
		<tr align="center">
			<td width="50%" align="left ">Tanggal Pemesanan</td>
			<td width="1%">:</td>
			<td width="50%" align="left"><?php echo $tglpesann ?></td>
		</tr>
		<tr align="center">
			<td width="50%" align="left ">Tipe Kamar</td>
			<td width="1%">:</td>
			<td width="50%" align="left"><?php echo $tipe ?></td>
		</tr>
		<tr align="center">
			<td width="50%" align="left ">Harga / Hari</td>
			<td width="1%">:</td>
			<td width="50%" align="left"><?php echo $hargaa ?></td>
		</tr>
		<tr align="center">
			<td width="50%" align="left ">Jumlah Kamar</td>
			<td width="1%">:</td>
			<td width="50%" align="left"><?php echo $jumlah ?></td>
		</tr>
		<tr align="center">
			<td width="50%" align="left ">Nama Lengkap</td>
			<td width="1%">:</td>
			<td width="50%" align="left"><?php echo $namax ?></td>
		</tr>
		<tr align="center">
			<td width="50%" align="left ">Alamat</td>
			<td width="1%">:</td>
			<td width="50%" align="left"><?php echo $alamat ?></td>
		</tr>
		<tr align="center">
			<td width="50%" align="left ">No. Telepon</td>
			<td width="1%">:</td>
			<td width="50%" align="left"><?php echo $telepon ?></td>
		</tr>
		<tr align="center">
			<td width="50%" align="left ">Tanggal Check-In</td>
			<td width="1%">:</td>
			<td width="50%" align="left"><?php echo $tglmasukk ?></td>
		</tr>
		<tr align="center">
			<td width="50%" align="left ">Tanggal Check-Out</td>
			<td width="1%">:</td>
			<td width="50%" align="left"><?php echo $tglkeluarr ?></td>
		</tr>
		<tr align="center">
			<td width="50%" align="left ">Total Bayar</td>
			<td width="1%">:</td>
			<td width="50%" align="left"><?php echo $angka ?></td>
		</tr>
		<tr align="center">
			<td width="50%" align="left ">Status Transaksi</td>
			<td width="1%">:</td>
			<td width="50%" align="left"><?php echo $status ?></td>
		</tr>
	</table>
</div> 
<script type="text/javascript">window.onafterprint = window.close;window.print();</script>
<?php } ?>