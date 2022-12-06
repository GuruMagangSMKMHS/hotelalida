<?php
	require_once "../viewmaster/header.php";
	require_once "view/menu.php";
    require_once "view/ceklog.php";
    require_once "../datamaster/koneksiDB.php";
	$ambilx = $_GET['id'];
	$sqlx = $pdo->query("SELECT * FROM pemesanan WHERE idpesan='$ambilx'");
	$datax = $sqlx->fetch();
	$idpesan = $datax['idpesan'];
	$nama = $datax['nama'];
	$total = $datax['totalbayar'];
	
	if(isset($_POST['bayar'])){
		$idpesan = $_POST['txtid'];
		$nama = $_POST['txtnama'];
		$jumlah = $_POST['txtjumlah'];
		$bank = $_POST['txtbank'];
		$norek = $_POST['txtnorek'];
		$namarek = $_POST['txtnamarek'];
		$gambar = $_FILES['txtgambar']['name'];
		$sqlsimpan = $pdo->query("INSERT INTO pembayaran VALUES('$idpesan', '$nama', '$jumlah', '$bank', '$norek', '$namarek', '$gambar')");

		move_uploaded_file($_FILES['txtgambar']['tmp_name'],"../simpangambar/".$_FILES['txtgambar']['name']);

		echo"<script>swal({
				type: 'success',
				title: 'Konfirmasi Pembayaran Terkirim!',
				showConfirmButton: false,
				backdrop: 'rgba(0,0,123,0.5)',
				});
				window.setTimeout(function(){
					window.location.replace('reservasi.php');
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
					Konfirmasi Pembayaran
				</h2>
			</div>
			<form method="post" action="" enctype="multipart/form-data" class="space-y-6">
				<div class="border-t border-gray-200 space-y-3">
					<dl>
					  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">ID Pemesanan</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="txtid" value="<?php echo $idpesan ?>" readonly class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					  </div>
					  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="txtnama" value="<?php echo $nama ?>" readonly class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					  </div>
					  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Jumlah Bayar</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="txtjumlah" value="<?php echo $total ?>" readonly class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					  </div>
					  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Bank</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<select name="txtbank" required="required" class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
								<option hidden="hidden">-Pilih Bank-</option>
								<option>Mandiri</option>
								<option>BCA</option>
								<option>BNI</option>
								<option>BRI</option>
							</select>
						</dd>
					  </div>
					  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">No. rekening</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="number" name="txtnorek" placeholder="Masukan No. rekening" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					  </div>
					  <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Nama Pemilik Rekening</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="txtnamarek" placeholder="Masukan Nama Pemilik Rekening" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					  </div>
					  <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Upload Bukti Transfer</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="file" accept="image/*" name="txtgambar" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					  </div>
					</dl>
				</div>
				<button type="submit" name="bayar" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
					Kirim
				</button>
				<a href="reservasi.php" type="button" class="group relative flex w-full justify-center rounded-md border border-transparent bg-black py-2 px-4 text-sm font-medium text-white hover:bg-black focus:outline-none focus:ring-2 focus:ring-black focus:ring-offset-2">
					Kembali
				</a>
			</form>
		</div>
	</div>
</div>
<?php require_once "../viewmaster/footer.php"; ?>