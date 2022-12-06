<?php
    require_once "../../viewmaster/header.php";
    require_once "../view/menu.php";
    require_once "../view/ceklog.php";
    require_once "../../datamaster/koneksiDB.php";
	if(isset($_GET['cari'])){
		$cari =$_GET['cari'];
		$sql = $pdo->query("SELECT * FROM pemesanan
							WHERE status='Berhasil'
							AND (idpesan like '%".$cari."%' 
							OR tglpesan like '%".$cari."%' 
							OR tipe like '%".$cari."%' 
							OR harga like '%".$cari."%' 
							OR jumlah like '%".$cari."%' 
							OR nama like '%".$cari."%' 
							OR telepon like '%".$cari."%' 
							OR lamahari like '%".$cari."%' 
							OR tglmasuk like '%".$cari."%' 
							OR tglkeluar like '%".$cari."%' 
							OR totalbayar like '%".$cari."%')
							ORDER BY idpesan DESC;
						  ");
	}else{
		$sql = $pdo->query("SELECT * FROM pemesanan WHERE status='Berhasil' ORDER BY idpesan DESC");
	}
?>
<div class="mx-auto max-w-2xl px-4 lg:max-w-7xl lg:px-8">
	<div>
		<h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
			Transaksi Pemesanan Sukses
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
					<th class="py-3 px-6">ID</th>
					<th class="py-3 px-6">Tanggal</th>
					<th class="py-3 px-6">Tipe</th>
					<th class="py-3 px-6">Harga</th>
					<th class="py-3 px-6">Jumlah</th>
					<th class="py-3 px-6">Nama</th>
					<th class="py-3 px-6">Telepon</th>
					<th class="py-3 px-6">Check In</th>
					<th class="py-3 px-6">Check Out</th>
					<th class="py-3 px-6">Lama</th>
					<th class="py-3 px-6">Total</th>
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
					<td class="py-2 px-3"><?php echo $data['nama'] ?></td>
					<td class="py-2 px-3"><?php echo $data['telepon'] ?></td>
					<td class="py-2 px-3"><?php echo date('d/m/Y', strtotime($data['tglmasuk'])) ?></td>
					<td class="py-2 px-3"><?php echo date('d/m/Y', strtotime($data['tglkeluar'])) ?></td>
					<td class="text-center py-2 px-3"><?php echo $data['lamahari'] ?> hari</td>
					<td class="text-right py-2 px-3"><?php echo number_format($data['totalbayar'],0,",",".") ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php require_once "../../viewmaster/footer.php"; ?>