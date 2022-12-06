<?php require_once "viewmaster/header.php"; ?>
<?php require_once "tamu/view/menu.php"; ?>
<script type="text/javascript">
	function pilih() {
		var type = document.opsi.tipe.value;
		var teks = document.getElementById('selek').options[document.getElementById('selek').selectedIndex].text;
		document.opsi.harga.value = type;
		document.opsi.tipex.value = teks;
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
		<div class="mx-auto max-w-2xl px-4 lg:max-w-7xl lg:px-8">
			<h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
				Hotel Alida
			</h2>
			<br>
			<form method="post" action="tamu/pemesanan.php" name="opsi" class="pt-2">
				<table class="border-separate border-spacing-2 border border-slate-400">
					<tr >
						<td>Check-In</td>
						<td>Check-Out</td>
						<td>Type</td>
						<td>Harga/Malam</td>
						<td></td>
					</tr>
					<tr >
						<td class="space-x-2">
							<input type="date" name="cekin" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</td>
						<td>
							<input type="date" name="cekout" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</td>
						<td>
							<select name="tipe" id="selek" required="required" onchange="pilih()" class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
								<option selected="selected" disabled="disabled">-Pilih-</option>
								<option value="Rp 410.000">Superior</option>
								<option value="Rp 450.000">Deluxe</option>
								<option value="Rp 700.000">Junior Suite</option>
								<option value="Rp 1.200.000">Executive</option>
							</select>
						</td>
						<td>
							<input type="hidden" name="tipex" style="width: 100px;" onchange="pilih()">
							<input type="text" name="harga" onchange="pilih()" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
						</td>
						<td>
							<button type="submit" name="ok" class="group relative flex w-full justify-center rounded-md border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
								Pesan
							</button>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<?php require_once "viewmaster/footer.php"; ?>