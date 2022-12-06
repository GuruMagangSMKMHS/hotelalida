<?php
    require_once "../../viewmaster/header.php";
    require_once "../view/menu.php";
    require_once "../view/ceklog.php";
    require_once "../../datamaster/koneksiDB.php";
	if(isset($_GET['cari'])){
		$cari =$_GET['cari'];
		$sql = $pdo->query( "SELECT * FROM pembayaran
							RIGHT JOIN pemesanan ON pembayaran.idpesan = pemesanan.idpesan
							WHERE pemesanan.status='Pending...'
							AND (pembayaran.idpesan like '%".$cari."%' 
							OR pemesanan.tglpesan like '%".$cari."%' 
							OR pemesanan.tipe like '%".$cari."%' 
							OR pemesanan.harga like '%".$cari."%' 
							OR pemesanan.jumlah like '%".$cari."%' 
							OR pemesanan.nama like '%".$cari."%' 
							OR pemesanan.telepon like '%".$cari."%' 
							OR pemesanan.lamahari like '%".$cari."%' 
							OR pemesanan.totalbayar like '%".$cari."%')
							ORDER BY pembayaran.idpesan DESC;
						  ");
	}else{
		$sql = $pdo->query("
			SELECT * FROM pembayaran
			RIGHT JOIN pemesanan ON pembayaran.idpesan = pemesanan.idpesan
			WHERE pemesanan.status='Pending...'
			ORDER BY pembayaran.idpesan DESC;
		");
	}
?>
<div class="mx-auto max-w-2xl px-4 lg:max-w-7xl lg:px-8">
	<div>
		<h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
			Konfirmasi Pesanan
		</h2>
	</div>
    <div style="width:30%" class="mt-8">
		<form action="" method="GET" class="mt-5">
			<input type="search" placeholder="Pencarian" name="cari" class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
		</form>
	</div>
    <div class="overflow-x-auto relative">
		<?php
		if(isset($_GET['cari'])){
			$cari =$_GET['cari'];
			echo "Hasil pencarian: ",$cari;
		}
		?>
		<table class="w-full text-sm text-left text-gray-500 mt-2">
			<thead class="text-center text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
				<tr>
					<th class="py-3 px-6">Kode</th>
					<th class="py-3 px-6">Tanggal</th>
					<th class="py-3 px-6">Tipe</th>
					<th class="py-3 px-6">Harga</th>
					<th class="py-3 px-6">Jumlah</th>
					<th class="py-3 px-6">Tamu</th>
					<th class="py-3 px-6">Check In / Out</th>
					<th class="py-3 px-6">Total</th>
					<th class="py-3 px-6">Bukti Bayar</th>
					<th class="py-3 px-6">Status</th>
				</tr>
			</thead>
			<tbody class="bg-white border-b white:bg-gray-800 white:border-gray-700">
				<?php while ($data = $sql->fetch()) { ?>
				<tr class="border-b">
					<td class="text-center py-2 px-3"><?php echo $data['idpesan'] ?></td>
					<td class="py-2 px-3"><?php echo date('d/m/Y', strtotime($data['tglpesan'])) ?></td>
					<td class="py-2 px-3"><?php echo $data['tipe'] ?></td>
					<td class="text-right py-2 px-3"><?php echo number_format($data['harga'],0,",",".") ?></td>
					<td class="text-center py-2 px-3"><?php echo $data['jumlah'] ?></td>
					<td class="py-2 px-3">
						<?php echo $data['nama'] ?>
						<br>
						<?php echo $data['telepon'] ?>
					</td>
					<td class="py-2 px-3">
						<?php echo date('d/m/Y', strtotime($data['tglmasuk'])) ?>
						<br>
						<?php echo date('d/m/Y', strtotime($data['tglkeluar'])) ?>
						<br>
						Lama <?php echo $data['lamahari'] ?> hari
					</td>
					<td class="text-right py-2 px-3"><?php echo number_format($data['totalbayar'],0,",",".") ?></td>
					<td class="text-right py-2 px-3">
						<a href="../../gambar/<?php echo $data['gambar'] ?>" target="_blank"><img src="../../gambar/<?php echo $data['gambar'] ?>" width="100px" height="50px"/></a>
					</td>
					<td class="text-right py-2 px-3">
						<a href="proseskonfirmasi.php?id=<?php echo $data['idpesan'] ?>"><button style="width:70px;background:#B40301;color:white;font-weight:normal;padding:2px;border:1px solid red; margin-bottom: 3px;">Konfirmasi</button></a><br>
						<a href="prosesbatal.php?id=<?php echo $data['idpesan'] ?>"><button style="width:70px;background:black;color:white;font-weight:normal;padding:2px;border:1px solid red;">Batalkan</button></a>
					</td>
					<td class="text-right py-2 px-3">
					
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php require_once "../../viewmaster/footer.php"; ?>