<?php
	require_once "../viewmaster/header.php";
	require_once "view/menu.php";
    require_once "view/ceklog.php";
    require_once "../datamaster/koneksiDB.php";
	
	$ambil = $_SESSION['ceklog'];
	$sql = $pdo->query("SELECT * FROM tamu WHERE username='$ambil'");
	$data = $sql->fetch();
	$id = $data['idtamu'];
	$username = $data['username'];
	$email = $data['email'];
	$alamat = $data['alamat'];
	$telepon = $data['telepon'];
	$password = $data['password'];
	$nama = $data['nama'];
	$foto = $data['foto'];

	$bts = 22;
	$nmak = strlen($nama);
	if($nmak > $bts) {
		$nm = substr($nama, 0, $bts) . '...';
	}
	else {
		$nm = $nama;
	}
	if(isset($_POST['edit'])) {
		$id = $_POST['tid'];
		$fotolama = $_POST['fotolama'];
		$username = $_POST['tuser'];
		$email = $_POST['temail'];
		$nama = $_POST['tnama'];
		$alamat = $_POST['talamat'];
		$telepon = $_POST['ttelepon'];
		$foto = $_FILES['tfoto']['name'];

		if(empty($foto)) {
			$update = $pdo->query("UPDATE tamu SET username='$username', email='$email', nama='$nama', alamat='$alamat', telepon='$telepon' WHERE idtamu='$id'");
			echo "<script>swal({
					type: 'success',
					title: 'Profil Diperbaharui',
					showConfirmButton: false,
					backdrop: 'rgba(0,0,123,0.5)',
					});
					window.setTimeout(function(){
						window.location.replace('profil.php');
					} ,1500);</script>";
		}else{
			unlink("../gambar/".$fotolama);
			move_uploaded_file($_FILES['tfoto']['tmp_name'],"../gambar/".$foto);
			$update = $pdo->query("UPDATE tamu SET username='$username', email='$email', nama='$nama', alamat='$alamat', telepon='$telepon', foto='$foto' WHERE idtamu='$id'");
			echo "<script>swal({
					type: 'success',
					title: 'Profil Diperbaharui!',
					showConfirmButton: false,
					backdrop: 'rgba(0,0,123,0.5)',
					});
					window.setTimeout(function(){
						window.location.replace('profil.php');
					} ,1500);</script>";
		}

	}
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
	<div class="mt-6 mb-3" align="center" style="
		background: rgba(255,255,255, 0.88);
		border-radius: 10px;
		padding-bottom: 20px;
		width: 1000px;
		height: 100%;
	">
		<div class="w-full max-w-md space-y-8">
			<div>
				<h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
					Ubah Profil
				</h2>
			</div>
			<div class="border-t border-gray-200">
				<form method="post" action="" enctype="multipart/form-data">
					<input type="hidden" name="tid" value="<?php echo $id ?>">
					<input type="hidden" name="fotolama" value="<?php echo $foto ?>">
					<dl>
					  <div align="center" class="bg-white px-4 py-5">
							<img class="object-center" src="../gambar/<?php 
								if ($foto != '') {
									echo $foto;
								}else {
									echo 'profil.png';
								}
								?>" width="120px" height="120px"
							/>
							<input type="file" name="tfoto">
					  </div>
					  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Username</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="tuser" placeholder="Masukan Username" value="<?php echo $username ?>" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					  </div>
					  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Email</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="Email" name="temail" placeholder="Masukan Email" value="<?php echo $email ?>" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					  </div>
					  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="tnama" placeholder="Masukan Nama Lengkap" value="<?php echo $nama ?>" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					  </div>
					  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Alamat</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="talamat" placeholder="Masukan Alamat" value="<?php echo $alamat ?>" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					  </div>
					  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Telepon</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="ttelepon" placeholder="Masukan Noomor Telepon" value="<?php echo $telepon ?>" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					  </div>
					</dl>
					<button type="submit" name="edit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
						Simpan
					</button>
					<br>
					<a href="profil.php" type="button" class="group relative flex w-full justify-center rounded-md border border-transparent bg-black py-2 px-4 text-sm font-medium text-white hover:bg-black focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
						Kembali
					</a>
				</form>
			</div>
		</div>
	</div>
</div>
<?php require_once "../viewmaster/footer.php"; ?>