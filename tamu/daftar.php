<?php 
	require_once "../viewmaster/header.php";
	require_once "view/menu.php";
    include "../datamaster/koneksiDB.php";
    if(isset($_POST['daftar'])) {
		$user = $_POST['user'];
		$email = $_POST['email'];
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$telepon = $_POST['telepon'];
		$pass = md5($_POST['pass']);

		$sqlsimpan = $pdo->query("INSERT INTO tamu VALUES('', '$user', '$email', '$nama', '$alamat', '$telepon', '$pass', '')");

		echo "<script>swal({
				type: 'success',
				title: 'Registrasi Sukses!',
				showConfirmButton: false,
				backdrop: 'rgba(0,0,123,0.5)',
			});
			window.setTimeout(function(){
				window.location.replace('login.php');
			} ,1500);</script>";
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
					Daftar
				</h2>
				<p class="mt-6 text-lg leading-8 text-gray-600 sm:text-center">
					Isi Sesuai Kartu Identitas Anda
					<br>(KTP/SIM/Passport)
				</p>    
			</div>
			<form class="mt-8 space-y-6" action="" method="POST">
				<div class="-space-y-px rounded-md shadow-sm">
					<div class="-space-y-px">
						<input type="text" placeholder="Masukan Username" name="user" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
					</div>
				</div>
				<div class="-space-y-px rounded-md shadow-sm">
					<div class="-space-y-px">
						<input type="email" placeholder="Masukan Email" name="email" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
					</div>
				</div>
				<div class="-space-y-px rounded-md shadow-sm">
					<div class="-space-y-px">
						<input type="text" placeholder="Masukan Nama Lengkap" name="nama" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
					</div>
				</div>
				<div class="-space-y-px rounded-md shadow-sm">
					<div class="-space-y-px">
						<input type="text" placeholder="Masukan Alamat" name="alamat" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
					</div>
				</div>
				<div class="-space-y-px rounded-md shadow-sm">
					<div class="-space-y-px">
						<input type="nmber" placeholder="Masukan Nomor Telepon" name="telepon" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
					</div>
				</div>
				<div class="-space-y-px rounded-md shadow-sm">
					<div>
						<input type="password" placeholder="Masukan Password" name="pass" required class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
					</div>
				</div>
				<button type="submit" name="daftar" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
					Daftar
				</button>
			</form>
		</div>
	</div>
</div>
<?php require_once "../viewmaster/footer.php"; ?>