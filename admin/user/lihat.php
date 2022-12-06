<?php
    require_once "../../viewmaster/header.php";
    require_once "../view/menu.php";
    require_once "../view/ceklog.php";
    require_once "../../datamaster/koneksiDB.php";
	if(isset($_GET['cari'])){
		$cari =$_GET['cari'];
		$sql = $pdo->query( "SELECT * FROM tamu where 
							   idtamu like '%".$cari."%' 
							OR username like '%".$cari."%' 
							OR email like '%".$cari."%' 
							OR nama like '%".$cari."%' 
							OR alamat like '%".$cari."%' 
							OR telepon like '%".$cari."%'
						  ");
	}else{
		$sql = $pdo->query ("select * from tamu order by idtamu asc");
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
					<th class="py-3 px-6">ID User</th>
					<th class="py-3 px-6">Username</th>
					<th class="py-3 px-6">Email</th>
					<th class="py-3 px-6">Nama Lengkap</th>
					<th class="py-3 px-6">Alamat</th>
					<th class="py-3 px-6">Telepon</th>
					<th class="py-3 px-6">Hapus</th>	
				</tr>
			</thead>
			<tbody class="bg-white border-b white:bg-gray-800 white:border-gray-700">
				<?php $no =  ''; foreach($sql as $data){ $no++; ?>
				<tr class="border-b">
					<td class="text-center py-2 px-3"><?php echo $no ?></td>
					<td class="py-2 px-3"><?php echo $data['idtamu'] ?></td>
					<td class="py-2 px-3"><?php echo $data['username'] ?></td>
					<td class="py-2 px-3"><?php echo $data['email'] ?></td>
					<td class="py-2 px-3"><?php echo $data['nama'] ?></td>
					<td class="py-2 px-3"><?php echo $data['alamat'] ?></td>
					<td class="py-2 px-3"><?php echo $data['telepon'] ?></td>
					<td class="py-2 px-3">
						<a href="delete.php?id=<?php echo $data['idtamu'];?>" onclick="return confirm('Anda akan menghapus?')"><button class="mt-1 group relative flex w-full justify-center rounded-md border border-transparent bg-sky-600 py-2 px-4 text-sm font-medium text-white hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">delete</button></a> 
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>
<?php require_once "../../viewmaster/footer.php"; ?>