<?php
    require_once "../../viewmaster/header.php";
    require_once "../view/menu.php";
    require_once "../view/ceklog.php";
    require_once "../../datamaster/koneksiDB.php";
	if(isset($_GET['cari'])){
		$cari =$_GET['cari'];
		$sql = $pdo->query( "SELECT * FROM pembayaran where 
							   idpesan like '%".$cari."%' 
							OR nama like '%".$cari."%' 
							OR jumlah like '%".$cari."%' 
							OR bank like '%".$cari."%' 
							OR norek like '%".$cari."%' 
							OR namarek like '%".$cari."%' 
							OR gambar like '%".$cari."%'
						  ");
	}else{
		$sql = $pdo->query ("select * from pembayaran order by idpesan asc");
	}
?>
<div class="mx-auto max-w-2xl px-4 lg:max-w-7xl lg:px-8">
	<div>
		<h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
			Data Pembayaran
		</h2>
	</div>
    <div style="width:30%" class="mt-8">
		<a href="laporan.php" target="_blank" type="button" class="mt-1 group relative flex w-full justify-center rounded-md border border-transparent bg-sky-600 py-2 px-4 text-sm font-medium text-white hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
			Cetak Laporan
		</a>
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
					<th class="py-3 px-6">Nama Tamu</th>
					<th class="py-3 px-6">Jumlah</th>
					<th class="py-3 px-6">Bank</th>
					<th class="py-3 px-6">No Rekening</th>
					<th class="py-3 px-6">Nama Pemilik Rekening</th>
					<th class="py-3 px-6">Bukti Pembayaran</th>
				</tr>
			</thead>
			<tbody class="bg-white border-b white:bg-gray-800 white:border-gray-700">
				<?php foreach($sql as $data){ ?>
				<tr class="border-b">
					<td class="py-2 px-3"><?php echo $data['idpesan'] ?></td>
					<td class="py-2 px-3"><?php echo $data['nama'] ?></td>
					<td class="py-2 px-3"><?php echo $data['jumlah'] ?></td>
					<td class="py-2 px-3"><?php echo $data['bank'] ?></td>
					<td class="py-2 px-3"><?php echo $data['norek'] ?></td>
					<td class="py-2 px-3"><?php echo $data['namarek'] ?></td>
					<td class="py-2 px-3">
						<a href="../../gambar/<?php echo $data['gambar'];?>" target="_blank"><button class="mt-1 group relative flex w-full justify-center rounded-md border border-transparent bg-sky-600 py-2 px-4 text-sm font-medium text-white hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">lihat file</button></a> 
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php require_once "../../viewmaster/footer.php"; ?>