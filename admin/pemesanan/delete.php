<?php
    require_once "../../datamaster/koneksiDB.php";
	$idpesan = $_GET['id'];
	$sqlpemesanan = $pdo->query("DELETE FROM pemesanan WHERE idpesan=$idpesan");
	header("Location:lihat.php");
?>