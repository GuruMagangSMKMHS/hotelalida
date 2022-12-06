<?php
    require_once "../../viewmaster/header.php";
    require_once "../view/menu.php";
    require_once "../view/ceklog.php";
    require_once "../../datamaster/koneksiDB.php";
	
	//variabel ambil dari table database
	$ambil = $_GET['id'];
	$sql = $pdo->query("SELECT * FROM kamar WHERE idkamar='$ambil'");
	$data = $sql->fetch();
	$id = $data['idkamar'];
	$tipe = $data['tipe'];
	$jumlah = $data['jumlah'];
	$harga = $data['harga'];
	$gambar = $data['gambar'];
	
	if(isset($_POST['ubah'])) {
		$id = $_POST['id'];
		$tipe = $_POST['edittipe'];
		$jumlah = $_POST['editjumlah'];
		$harga = $_POST['editharga'];
		$hapusgambar = $_POST['gambar'];
		if(empty($_FILES['editgambar']['name'])) {
			$update = $pdo->query("UPDATE kamar SET idkamar='$id', tipe='$tipe', jumlah='$jumlah', harga='$harga' WHERE idkamar='$id'");
			$update2 = $pdo->query("UPDATE stokkamar SET idkamar='$id', tipe='$tipe' WHERE idkamar='$id'");
			echo "<script>alert ('Data telah diupdate');document.location.href='lihat.php';</script>";
		}else if (!empty($gambar)) {
			$ekstensi_diperbolehkan = array('webp', 'jpg','png','jpeg', 'jfif');
			$gambar = $_FILES['editgambar']['name'];
			$x = explode('.', $gambar);
			$ekstensi = strtolower(end($x));
			$file_tmp =$_FILES['editgambar']['tmp_name'];
			if(in_array($ekstensi,$ekstensi_diperbolehkan)=== true) {	
				$update = $pdo->query("UPDATE kamar SET idkamar='$id', tipe='$tipe', jumlah='$jumlah', harga='$harga', gambar='$gambar' WHERE idkamar='$id'");
				$update2 = $pdo->query("UPDATE stokkamar SET idkamar='$id', tipe='$tipe' WHERE idkamar='$id'");
				unlink("../../gambar/".$hapusgambar);
				move_uploaded_file($file_tmp,"../../gambar/".$gambar);
				echo "<script>alert ('Data telah diupdate');document.location.href='lihat.php';</script>";
			}else{
				echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN!';
			}
		}
	}
?>
<div class="item-center mx-auto max-w-2xl px-4 lg:max-w-7xl lg:px-8">
	<div>
		<h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
			Ubah Data Kamar <?php echo $id ?>
		</h2>
	</div>
	<div class="border-t border-gray-200">
		<form action="" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<input type="hidden" name="gambar" value="<?php echo $gambar?>">
			<dl>
			  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">ID Kamar</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
					<input type="text" name="id" value="<?php echo $id ?>" disabled class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
				</dd>
			  </div>
			  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">Tipe</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
					<select name="edittipe" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						<option selected="selected"><?php echo $tipe ?></option>
						<option disabled="disabled">-- Pilih Tipe --</option>
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
				<dt class="text-sm font-medium text-gray-500">Jumlah</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
					<input type="number" name="editjumlah" value="<?php echo $jumlah ?>" placeholder="Masukan Jumlah" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
				</dd>
			  </div>
			  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">Harga</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
					<input type="number" name="editharga" value="<?php echo $harga ?>" placeholder="Masukan Harga" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
				</dd>
			  </div>
			  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
				<dt class="text-sm font-medium text-gray-500">Foto / Gambar</dt>
				<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
					<img src="../../gambar/<?php echo $gambar?>" width='250'>
					<input type="file" accept="image/*" name="gambar" class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
				</dd>
			  </div>
			</dl>
			<button type="submit" name="ubah" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
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