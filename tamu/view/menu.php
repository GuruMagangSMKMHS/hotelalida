<div class="relative bg-white" style="position:fixed;top:0;left:0;width:100%;z-index:999;">
	<div class="mx-auto max-w-7xl px-4 sm:px-6">
		<div class="flex items-center justify-between border-b-2 border-gray-100 py-6 md:justify-start md:space-x-10">
			<div class="flex justify-start lg:w-0 lg:flex-1">
				<a href="/hotelalida">
					<img class="h-8 w-auto sm:h-10" src="/hotelalida/gambar/logo.svg" alt="">
				</a>
				<a href="/hotelalida" class="items-center md:flex">
					&nbsp; Hotel Alida
				</a>
			</div>
			<nav class="hidden space-x-10 md:flex">
				<a href="/hotelalida/tamu/kamar.php" class="text-base font-medium text-gray-500 hover:text-gray-900">Kamar</a>
				<a href="/hotelalida/tamu/fasilitas.php" class="text-base font-medium text-gray-500 hover:text-gray-900">Fasilitas</a>
				<?php if(!isset($_SESSION['ceklog'])) { ?>
				<a href="/hotelalida/tamu/daftar.php" class="text-base font-medium text-gray-500 hover:text-gray-900">Daftar</a>
				<?php }else{ ?>
				<a href="/hotelalida/tamu/reservasi.php" class="text-base font-medium text-gray-500 hover:text-gray-900">Reservasi</a>
				<?php } ?>
			</nav>
			<div class="hidden items-center justify-end md:flex md:flex-1 lg:w-0">
				<?php if(!isset($_SESSION['ceklog'])) { ?>
				<a href="/hotelalida/tamu/login.php" class="ml-8 inline-flex items-center justify-center whitespace-nowrap rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Login</a>
				<?php 
					}else{
						$host       = "localhost";
						$user       = "root";
						$pass       = "";
						$database   = "hotelalida";
						$url        = "mysql:host=".$host.";dbname=".$database;
						$option     = array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8',);
						$pdo = new PDO($url,$user, $pass,$option);
						$ambil = $_SESSION['ceklog'];
						$sql = $pdo->query("SELECT nama, foto FROM tamu WHERE username='$ambil'");
						$data = $sql->fetch();
						$nama = $data['nama'];
						$foto = $data['foto'];
				?>
				<a href="/hotelalida/tamu/profil.php" class="flex -space-x-2 overflow-hidden">
					<img class="inline-block h-10 w-10 rounded-full ring-2 ring-white" alt="" src="/hotelalida/gambar/<?php 
						if ($foto != '') {
							echo $foto;
						}else {
							echo 'profil.png';
						}
						?>"
					/>
					&nbsp;&nbsp;&nbsp;
					<span class="items-center md:flex"><?= $nama ?></span>
				</a>
				<a href="/hotelalida/logout.php" class="ml-8 inline-flex items-center justify-center whitespace-nowrap rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Keluar</a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<div style="padding-bottom: 90px;"></div>