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
					Profil
				</h2>
			</div>
			<div class="border-t">
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
				  </div>
				  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
					<dt class="text-sm font-medium text-gray-500">Username</dt>
					<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"><?php echo $username ?></dd>
				  </div>
				  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
					<dt class="text-sm font-medium text-gray-500">Email</dt>
					<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"><?php echo $email ?></dd>
				  </div>
				  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
					<dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
					<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"><?php echo $nama ?></dd>
				  </div>
				  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
					<dt class="text-sm font-medium text-gray-500">Alamat</dt>
					<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"><?php echo $alamat ?></dd>
				  </div>
				  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
					<dt class="text-sm font-medium text-gray-500">Telepon</dt>
					<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0"><?php echo $telepon ?></dd>
				  </div>
				</dl>
			</div>
			<a href="profiledit.php" type="button" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
				Edit Profil
			</a>
			<a href="profileditpassword.php" type="button" class="group relative flex w-full justify-center rounded-md border border-transparent bg-yellow-600 py-2 px-4 text-sm font-medium text-white hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
				Ubah Password
			</a>
		</div>
	</div>
</div>
<?php require_once "../viewmaster/footer.php"; ?>