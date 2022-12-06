<?php
    require_once "../../viewmaster/header.php";
    require_once "../view/menu.php";
    require_once "../view/ceklog.php";
    require_once "../../datamaster/koneksiDB.php";
	if(isset($_GET['cari'])){
		$cari =$_GET['cari'];
		$sql = $pdo->query( "SELECT * FROM kamar where 
							   idkamar like '%".$cari."%' 
							OR tipe like '%".$cari."%' 
							OR jumlah like '%".$cari."%' 
							OR harga like '%".$cari."%'
						  ");
	}else{
		$sql = $pdo->query ("select * from kamar order by idkamar asc");
	}
?>
<div class="mx-auto max-w-2xl px-4 lg:max-w-7xl lg:px-8">
	<div>
		<h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
			Data Kamar Hotel
		</h2>
	</div>
    <div style="width:30%" class="mt-8">
		<a href="laporan.php" target="_blank" type="button" class="mt-1 group relative flex w-full justify-center rounded-md border border-transparent bg-sky-600 py-2 px-4 text-sm font-medium text-white hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
			Cetak Laporan
		</a>
		<a href="tambah.php" type="button" class="mt-1 group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
			Tambah Data Kamar
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
					<th class="py-3 px-6">No</th>
					<th class="py-3 px-6">ID Kamar</th>
					<th class="py-3 px-6">Tipe kamar</th>
					<th class="py-3 px-6">Jumlah</th>
					<th class="py-3 px-6">Harga</th>
					<th class="py-3 px-6">Lihat Foto</th>
					<th class="py-3 px-6">Edit</th>
					<th class="py-3 px-6">Hapus</th>
				</tr>
			</thead>
			<tbody class="bg-white border-b white:bg-gray-800 white:border-gray-700">
				<?php $no =  ''; foreach($sql as $data){ $no++; ?>
				<tr class="border-b">
					<td class="text-center py-2 px-3"><?php echo $no ?></td>
					<td class="py-2 px-3"><?php echo $data['idkamar'] ?></td>
					<td class="py-2 px-3"><?php echo $data['tipe'] ?></td>
					<td class="py-2 px-3"><?php echo $data['jumlah'] ?></td>
					<td class="py-2 px-3"><?php echo $data['harga'] ?></td>
					<td class="py-2 px-3"><a href="../../gambar/<?php echo $data['gambar'];?>" target="_blank"><button class="mt-1 group relative flex w-full justify-center rounded-md border border-transparent bg-sky-600 py-2 px-4 text-sm font-medium text-white hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">lihat file</button></a></td>
					<td class="py-2 px-3">
						<a href="edit.php?id=<?php echo $data['idkamar'];?>" ><button class="mt-1 group relative flex w-full justify-center rounded-md border border-transparent bg-sky-600 py-2 px-4 text-sm font-medium text-white hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">edit</button></a>
					</td>
					<td class="py-2 px-3">
						<a href="delete.php?id=<?php echo $data['idkamar'];?>" onclick="return confirm('Anda akan menghapus?')"><button class="mt-1 group relative flex w-full justify-center rounded-md border border-transparent bg-sky-600 py-2 px-4 text-sm font-medium text-white hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">delete</button></a> 
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php require_once "../../viewmaster/footer.php"; ?>