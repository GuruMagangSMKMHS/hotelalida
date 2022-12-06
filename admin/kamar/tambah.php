<?php
    require_once "../../viewmaster/header.php";
    require_once "../view/menu.php";
    require_once "../view/ceklog.php";
    require_once "../../datamaster/koneksiDB.php";
	
	if(isset($_POST['tambah'])) {
		$id = $_POST['id'];
		$tipe = $_POST['tipe'];
		$jumlah = $_POST['jumlah'];
		$harga = $_POST['harga'];
		
		$ekstensi_diperbolehkan = array('webp', 'jpg','png','jpeg', 'jfif');
		$gambar = $_FILES['gambar']['name'];
		$x = explode('.', $gambar);
		$ekstensi = strtolower(end($x));
		$ukuran  = $_FILES['gambar']['size'];
		$file_tmp =$_FILES['gambar']['tmp_name'];
		
		if((in_array($ekstensi,$ekstensi_diperbolehkan)=== true) AND $ukuran< 10044070) {	
			$sqlsimpan = $pdo->query("INSERT INTO kamar VALUES('$id', '$tipe', '$jumlah', '$harga', '$gambar')");
			$sqlsimpan2 = $pdo->query("INSERT INTO stokkamar VALUES('$id', '$tipe', '$jumlah')");

			move_uploaded_file($file_tmp,"../../gambar/".$gambar);
			echo"<script>alert('Data Kamar Tersimpan');document,location.href='lihat.php';</script>";
		}else{
			echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN!';
		}
	
	}
?>
<div class="item-center mx-auto max-w-2xl px-4 lg:max-w-7xl lg:px-8">
	<div>
		<h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
			Tambah Data Kamar
		</h2>
	</div>
	<div class="border-t border-gray-200">
		<form action="" method="post" enctype="multipart/form-data">
			<dl>
			  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">ID Kamar</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
					<input type="text" name="id" placeholder="Masukan ID Kamar" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
				</dd>
			  </div>
			  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">Tipe</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
					<select name="tipe" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						<option selected="selected" disabled="disabled">-- Pilih Tipe --</option>
						<option>Standard</option>
						<option>Superior</option>
						<option>Deluxe</option>
						<option>Junior Suite</option>
						<option>Suite</option>
						<option>Executive</option>
						<option>Presidential/Penthouse</option>
					</select>
				</dd>
			  </div>
			  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">Harga</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
					<input type="number" name="harga" placeholder="Masukan Harga" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
				</dd>
			  </div>
			  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">Jumlah</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
					<input type="number" name="jumlah" placeholder="Masukan Jumlah" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
				</dd>
			  </div>
			  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">Foto / Gambar</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
					<input type="file" accept="image/*" name="gambar" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
				</dd>
			  </div>
			</dl>
			<button type="submit" name="tambah" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
				Simpan
			</button>
			<br>
			<a href="lihat.php" type="button" class="group relative flex w-full justify-center rounded-md border border-transparent bg-black py-2 px-4 text-sm font-medium text-white hover:bg-black focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
				Kembali
			</a>
		</form>
	</div>
</div>
<?php require_once "../../viewmaster/footer.php"; ?>