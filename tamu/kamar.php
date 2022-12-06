<?php 
	require_once "../viewmaster/header.php";
	require_once "view/menu.php";
    include "../datamaster/koneksiDB.php";
	$sql = $pdo->query ("select * from kamar");
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
	background-image: url(http://localhost/hotelalida/gambar/background-1.jpg);
	background-repeat: no-repeat;
	">
	<div class="mt-6 mb-3" style="
		background: rgba(255,255,255, 0.88);
		border-radius: 10px;
		padding-bottom: 20px;
		width: 1000px;
		height: 100%;
	">
		<div class="text-center mx-auto max-w-5xl px-4 lg:px-8">
			<h2 class="mt-6 text-3xl font-bold tracking-tight text-gray-900">
				Kamar
			</h2>
			<div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-4 lg:grid-cols-3">
				<?php
					$s =  '';
					foreach($sql as $val){
						$s++;
				?>
				<a href="pemesanan.php?kamar=<?php echo $val['idkamar'] ?>" >
					<div class="group relative">
						<h3 class="text-gray-700">
							<?php echo $val['tipe'];?>
						</h3>
						<div class="bg-gray-200">
							<b>Rp. <?php echo number_format($val['harga'],0,",","."); ?></b>
						</div>
						<div class="min-h-80 aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:aspect-none lg:h-80">
							<img src="../gambar/<?php echo $val['gambar'];?>" alt="Front of men&#039;s Basic Tee in black." class="h-full w-full object-cover object-center lg:h-full lg:w-full">
						</div>
						<h3 class="mt-1 text-gray-700">
							Tersedia <?php echo $val['jumlah'];?> Kamar
						</h3>
					</div>
				</a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<?php require_once "../viewmaster/footer.php"; ?>