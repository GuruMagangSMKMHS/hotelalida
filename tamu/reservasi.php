<?php
	require_once "../viewmaster/header.php";
	require_once "view/menu.php";
    require_once "view/ceklog.php";
    require_once "../datamaster/koneksiDB.php";
?>
<div style="
	width: 100%;
	display: flex;
	justify-content: center;
	min-height: 100%;
	padding-right : 20px !impertant;
	background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
	background-image: url(http://localhost/hotelalida/gambar/background-2.jpg);
	background-repeat: no-repeat;
	">
	<div class="mt-6 mb-3" style="
		background: rgba(255,255,255, 0.88);
		border-radius: 10px;
		padding-bottom: 20px;
		width: 1000px;
		height: 100%;
	">
		<div class="text-center mx-auto max-w-5xl px-4 lg:px-8">
			<h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">
				Data Reservasi
			</h2>
			<br>
			<p style="list-style: none; padding: 10px; background: #B40301; font-family: Cataneo BT; font-weight: bold; font-size: 18px; color: #FFF;">
				Rekening Hotel Batam
			</p>
			<table width="100%" style="background: rgba(255,255,255, 0.75);">
				<tr style="text-align: center; border: 2px solid #B40301;  margin:20px;">
					<td><img width="80px" src="../gambar/mandiri.png" align="right"></td>
					<td style="color: #B40301; border-right: 2px solid #B40301;">2656-56-845895-6558</td>
					<td><img width="80px" src="../gambar/bca.jpg" align="right"></td>
					<td style="color: #B40301;";>1167-11-178411-145</td>
				</tr>
				<tr style="text-align: center; border: 2px solid #B40301">
					<td><img width="80px" src="../gambar/bni.png" align="right"></td>
					<td style="color: #B40301; border-right: 2px solid #B40301">2267-22-297822-942</td>
					<td><img width="80px" src="../gambar/bri.png" align="right"></td>
					<td style="color: #B40301;">6733-33-735033-356</td>
				</tr>
			</table>
			<br><br>
			<div class="grid grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3">
				<?php
					$username = $_SESSION['ceklog'];
					$sql = $pdo->query("SELECT * FROM tamu WHERE username='$username'");
					$data = $sql->fetch();
					$idtamu = $data['idtamu'];
					$sqlx = $pdo->query("SELECT * FROM pemesanan WHERE idtamu=$idtamu ORDER BY idpesan DESC");
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
				<table width="100%" class="text-left" style="background: rgba(255,255,255, 0.75);">
					<tr align="center">
						<td colspan="2">Kode Transaksi: <?php echo $idpesan ?></td>
					</tr>
					<tr align="center">
						
						<td colspan="2" >
						<?php
							$sqly = $pdo->query("SELECT * FROM kamar WHERE idkamar=$idkamar");
							while($datay = $sqly->fetch()){
								$gambary = $datay['gambar'];
						?>
							<img src="../gambar/<?php echo $gambary?>" width='200px' height='120px' style="border:2px solid #B40301;">
						<?php
							}
						?>
						</td>
					</tr>
					<tr>
						<td align="right" style="padding-right: 10px;">Tanggal Pemesanan</td>
						<td>: <?php echo $tglpesann ?></td>
					</tr>
					<tr>
						<td align="right" style="padding-right: 10px;">Tipe Kamar</td>
						<td>: <?php echo $tipe ?></td>
					</tr>
					<tr>
						<td align="right" style="padding-right: 10px;">Harga / Hari</td>
						<td>: Rp. <?php echo $hargaa ?></td>
					</tr>
					<tr>
						<td align="right" style="padding-right: 10px;">Jumlah Kamar</td>
						<td>: <?php echo $jumlah ?></td>
					</tr>
					<tr>
						<td align="right" style="padding-right: 10px;">Nama Lengkap</td>
						<td>: <?php echo $namax ?></td>
					</tr>
					<tr>
						<td align="right" style="padding-right: 10px;">Alamat</td>
						<td>: <?php echo $alamat ?></td>
					</tr>
					<tr>
						<td align="right" style="padding-right: 10px;">No. Telepon</td>
						<td>: <?php echo $telepon ?></td>
					</tr>
					<tr>
						<td align="right" style="padding-right: 10px;">Tanggal Check-In</td>
						<td>: <?php echo $tglmasukk ?></td>
					</tr>
					<tr>
						<td align="right" style="padding-right: 10px;">Tanggal Check-Out</td>
						<td>: <?php echo $tglkeluarr ?></td>
					</tr>
					<tr>
						<td align="right" style="padding-right: 10px;">Lama Menginap</td>
						<td>: <?php echo $lamahari ?> Hari</td>
					</tr>
					<tr style="background: #B40301;" align="center">
						<td style="color: white">Total Bayar</td>
						<td style="color: white">Rp. <?php echo $angka ?></td>
					</tr>
					<tr>
						<?php
							if ($status == "Berhasil") {
								echo '<td colspan="2" align="center" style="background: green;color: white;">Status Transaksi : ';
							}else if ($status == "Pending...") {
								echo '<td colspan="2" align="center" style="background: blue;color: white;">Status Transaksi : ';
							}else {
								echo '<td colspan="2" align="center" style="background: black;color: white;">Status Transaksi : ';
							}
							date_default_timezone_set("Asia/Makassar");
							$tglsekarang = date('Y-m-d H:i:s');
							if ($tglsekarang > $batasbayar) {
								echo " Dibatalkan";
								$updatestatus = $pdo->query("UPDATE pemesanan SET status='Dibatalkan' WHERE idpesan=$idpesan");	
							}else {
								echo $status ;
								if ($status == "Pending...") {
									$sqly = $pdo->query("SELECT idpesan FROM pembayaran WHERE idpesan='$idpesan'");
									$datay = $sqly->fetch();
									$idbayar = null;
									if(!empty($datay['idpesan'])){
										$idbayar = $datay['idpesan'];
									}
									if ($idbayar == $idpesan) {
										echo "<br><p style='background: yellow; color: black'>Menunggu Verifikasi Pembayaran</p>";
									}else {
										echo "<br>Menunggu Proses Pembayaran<br>
										<p style='background:#B40301;'>Segera Lakukan Pembayaran Sebelum :</p>
										<p style='background:#B40301;'>Tanggal : $batasbayarr <br>Jam : $batasjam</p>
										Jika Tidak Transaksi Anda Dibatalkan<br>";
							?>
							<a href="bayar.php?id=<?php echo $idpesan ?>" ><button id="bbayar" style="width:150px;background:yellow;color:black;font-weight:bold;padding:4px;border:2px solid white; margin-bottom: 3px;">Konfirmasi Pembayaran</button></a>
							<?php }}} ?>
						</td>
					</tr>
					<tr align="center">
						<td colspan="2">
							<a href="cetakreservasi.php?transaksi=<?php echo $idpesan ?>" target="_blank" type="button" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
								Cetak Reservasi
							</a>
						</td>
					</tr>
				</table>
			<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php require_once "../viewmaster/footer.php"; ?>