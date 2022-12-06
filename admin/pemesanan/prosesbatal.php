<?php
	require_once "../../datamaster/koneksiDB.php";
	$idpesan = $_GET['id'];
	$sqlupdate = $pdo->query("UPDATE pemesanan SET status='Dibatalkan' WHERE idpesan=$idpesan");
	echo"<script>alert('Transaksi Dibatalkan!');document.location.href='pemesanankonfirmasi.php';</script>";
?>
