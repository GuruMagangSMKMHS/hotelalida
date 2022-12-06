<?php
    require_once "../../datamaster/koneksiDB.php";
    $idtamu = $_GET['id'];
    $sqltamu = $pdo->query("DELETE FROM tamu WHERE idtamu=$idtamu");
    header("Location:lihat.php");
?>