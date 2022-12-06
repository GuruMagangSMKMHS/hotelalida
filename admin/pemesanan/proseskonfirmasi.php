<?php
	require_once "../../datamaster/koneksiDB.php";
	$idpesan = $_GET['id'];
	$sqlupdate = $pdo->query("UPDATE pemesanan SET status='Berhasil' WHERE idpesan=$idpesan");
	echo"<script>alert('Transaksi Dikonfirmasi!');document.location.href='pemesanankonfirmasi.php';</script>";
?>
