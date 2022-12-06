<?php
    require_once "../../datamaster/koneksiDB.php";
    $idkamar = $_GET['id'];
    $sqlkamar = $pdo->query("DELETE FROM kamar WHERE idkamar=$idkamar");
    $sqlstok = $pdo->query("DELETE FROM stokkamar WHERE idkamar=$idkamar");
    header("Location:lihat.php");
?>