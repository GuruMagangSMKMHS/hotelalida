<?php 
	require_once "../viewmaster/header.php";
	require_once "view/menu.php";
    require_once "view/ceklog.php";
    require_once "../datamaster/koneksiDB.php";
	if(isset($_SESSION['ceklog'])){
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
	if(isset($_POST['ok'])) {
		$in = $_POST['cekin'];
		$out = $_POST['cekout'];
		$type = $_POST['tipex'];

		$sqlxy = $pdo->query("SELECT * FROM kamar WHERE tipe='$type'");
		$dataxy = $sqlxy->fetch();
		$idkamarxy = $dataxy['idkamar'];
		$tipexy = $dataxy['tipe'];
		$jumlahxy = $dataxy['jumlah'];
		$gambarxy = $dataxy['gambar'];
		$hargaxy = $dataxy['harga'];
		$hargafxy = number_format($hargaxy, 0, ',', '.');

		$sqlyx = $pdo->query("SELECT * FROM stokkamar WHERE tipe='$type'");
		$datayx = $sqlyx->fetch();
		$stokyx = $datayx['stok'];
	}
		
	date_default_timezone_set("Asia/Jakarta");

	$today = new DateTime();
	$tglpesan = $today->format('Y-m-d H:i:s') .PHP_EOL;
	$today->add(new DateInterval('PT5H'));
	$jamex = $today->format('Y-m-d H:i:s') .PHP_EOL;

	if(isset($_GET['kamar'])) {
		$ambilx = $_GET['kamar'];
		$sqlx = $pdo->query("SELECT * FROM kamar WHERE idkamar='$ambilx'");
		$datax = $sqlx->fetch();
		$idkamar = $datax['idkamar'];
		$tipe = $datax['tipe'];
		$jumlah = $datax['jumlah'];
		$gambar = $datax['gambar'];
		$harga = $datax['harga'];
		$hargaf = number_format($harga, 0, ',', '.');

		$sqly = $pdo->query("SELECT * FROM stokkamar WHERE idkamar='$ambilx'");
		$datay = $sqly->fetch();
		$stok = $datay['stok'];
	}
?>
<script type="text/javascript">
	function hitung(){
		var jumlahstok = parseFloat(document.cekstok.stok.value);
		var jumlahpesan = parseFloat(document.cekstok.jum.value);
		var harga = parseFloat(document.cekstok.harga.value);

		//date_default_timezone_set("Asia/Makassar");
		var tglsekarang = new Date();
		var dd = tglsekarang.getDate();
		var mm = tglsekarang.getMonth()+1;
		var yy = tglsekarang.getFullYear();
		if (dd<10) {
			dd = '0'+dd;
		}
		if (mm<10) {
			mm = '0'+mm;
		}
		tglsekarang = dd+'/'+mm+'/'+yy;

		var tglin = document.cekstok.tglcekin.value;
		var tglout = document.cekstok.tglcekout.value;

		//var tglin2 = date('Y-m-d H:i:s', tglin);

		var tglcin = tglin.split('-');
		var tglcout = tglout.split('-');
		var tglcekk = tglsekarang.split('-');

		var objektgl = new Date();

		var tglmasuk = objektgl.setFullYear(tglcin[0], tglcin[1], tglcin[2]);
		var tglkeluar = objektgl.setFullYear(tglcout[0], tglcout[1], tglcout[2]);
		var cektgl = objektgl.setFullYear(tglcekk[0], tglcekk[1], tglcekk[2]);
		
		var selisih = (tglkeluar - tglmasuk) / (60*60*24*1000);

		var cek = (tglmasuk - cektgl) / (60*60*24*1000);
		
		if(jumlahstok < jumlahpesan){
			alert("Maaf.. Stok Kamar Tidak Cukup");
			document.cekstok.jum.value="Pilih";
			document.cekstok.total.value="";
			}
		else {
			document.cekstok.lama.value = selisih;
			var hitungharga = harga*jumlahpesan*selisih;
			document.cekstok.total.value = hitungharga;
			if ((selisih || hitungharga || cek) < 0) {
				alert("Pilih Tanggal Dengan Benar!!!");
				document.cekstok.lama.value = 0;
				document.cekstok.total.value = 0;
			}
		}
	}
</script>
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
		<?php if(isset($_POST['ok'])) { ?>
		<div class="w-full max-w-md space-y-8">
			<div>
				<h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
					Pesan Kamar
				</h2>
			</div>
			<br>
			<form method="post" action="pemesananproses.php" name="cekstok" class="space-y-6">
				<dl>
					<img src="../gambar/<?php echo $gambarxy ?>" width='200px' height='150px' style="border:5px solid #B40301;">
					<div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Tipe Kamar</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="tipe" value="<?php echo $tipexy ?>" readonly class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
							<input type="hidden" name="tglpesan" readonly="true" value="<?php echo $tglpesan ?>">
							<input type="hidden" name="jamexpire" readonly="true" value="<?php echo $jamex ?>">
							<input type="hidden" name="idkamar" readonly="true" value="<?php echo $idkamarxy ?>"></td>
						</dd>
					</div>
					<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Harga / Hari</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="harga" value="<?php echo $hargaxy ?>" readonly class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
							<input type="hidden" name="stok" readonly="true" value=" <?php echo $stokyx ?>">
						</dd>
					</div>
					<div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Jumlah Kamar</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<select name="jum" onchange="hitung()" required="required" class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
								<option>Pilih</option>
								<script>
									for(var i=1;i<=50;i++){
										document.write("<option>"+i+"</option>");
									}
								</script>
							</select>
						</dd>
					</div>
					<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="nama" placeholder="Masukan Nama Lengkap" value="<?php echo $nama ?>" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
							<input type="hidden" name="idtamu" readonly="true" value="<?php echo $id ?>">
						</dd>
					</div>
					<div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Alamat</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="alamat" placeholder="Masukan Alamat" value="<?php echo $alamat ?>" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					</div>
					<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">No. Telepon</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="telepon" placeholder="Masukan Nomor Telepon" value="<?php echo $telepon ?>" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					</div>
					<div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Tanggal Check-In</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="date" name="tglcekin" min="<?php echo date('d-m-Y') ?>" onchange="hitung()" value="<?php echo $in ?>" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					</div>
					<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Tanggal Check-Out</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="date" name="tglcekout" onchange="hitung()" value="<?php echo $out ?>" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					</div>
					<div class="relative mt-1 rounded-md shadow-sm">
					<div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Lama Menginap</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="lama" onchange="hitung()" readonly class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
							<div class="absolute inset-y-0 right-0 flex items-center">
								  Malam
							</div>
						</dd>
					</div>
					</div>
					<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Total Biaya</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="total" onchange="hitung()" readonly class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					</div>
				</dl>
				<button type="submit" name="pemesanan" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
					Pesan Kamar
				</button>
			</form>
		</div>
		<?php }if(isset($_GET['kamar'])){ ?>
		<div class="w-full max-w-md space-y-8">
			<form method="post" action="pemesananproses.php" name="cekstok" class="space-y-6">
				<div>
					<h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
						Pesan Kamar
					</h2>
				</div>
				<br>
				<dl>
					<img src="../gambar/<?php echo $gambar?>" width='200px' height='150px' style="border:5px solid #B40301;">
					<div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Tipe Kamar</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="tipe" value="<?php echo $tipe ?>" readonly class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
							<input type="hidden" name="tglpesan" readonly="true" value="<?php echo $tglpesan ?>">
							<input type="hidden" name="jamexpire" readonly="true" value="<?php echo $jamex ?>">
							<input type="hidden" name="idkamar" readonly="true" value="<?php echo $idkamar ?>"></td>
						</dd>
					</div>
					<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Harga / Hari</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="harga" value="<?php echo $harga ?>" readonly class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
							<input type="hidden" name="stok" readonly="true" value=" <?php echo $stok?>">
						</dd>
					</div>
					<div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Jumlah Kamar</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<select name="jum" onchange="hitung()" required="required" class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
								<option>Pilih</option>
								<script>
									for(var i=1;i<=50;i++){
										document.write("<option>"+i+"</option>");
									}
								</script>
							</select>
						</dd>
					</div>
					<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Nama Lengkap</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="nama" placeholder="Masukan Nama Lengkap" value="<?php echo $nama ?>" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
							<input type="hidden" name="idtamu" readonly="true" value="<?php echo $id ?>">
						</dd>
					</div>
					<div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Alamat</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="alamat" placeholder="Masukan Alamat" value="<?php echo $alamat ?>" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					</div>
					<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">No. Telepon</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="telepon" placeholder="Masukan Nomor Telepon" value="<?php echo $telepon ?>" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					</div>
					<div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Tanggal Check-In</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="date" name="tglcekin" min="<?php echo date('d-m-Y') ?>" onchange="hitung()" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					</div>
					<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Tanggal Check-Out</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="date" name="tglcekout" onchange="hitung()" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					</div>
					<div class="relative mt-1 rounded-md shadow-sm">
					<div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Lama Menginap</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="lama" onchange="hitung()" readonly class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
							<div class="absolute inset-y-0 right-0 flex items-center">
								  Malam
							</div>
						</dd>
					</div>
					</div>
					<div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
						<dt class="text-sm font-medium text-gray-500">Total Biaya</dt>
						<dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
							<input type="text" name="total" onchange="hitung()" readonly class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</dd>
					</div>
				</dl>
				<button type="submit" name="pemesanan" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
					Pesan Kamar
				</button>
			</form>
		</div>
		<?php } ?>
	</div>
</div>
<?php require_once "../viewmaster/footer.php"; } ?>