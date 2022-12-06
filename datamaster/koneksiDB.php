<?php
    $host       = "localhost";
    $user       = "root";
    $pass       = "";
    $database   = "hotelalida";
    $url        = "mysql:host=".$host.";dbname=".$database;
    $option     = array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES utf8',);
    //pemanggilan database berdasarkan variabel yang ditentukan
    try {
        $pdo = new PDO($url,$user, $pass,$option);
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //hapus koneksi
        $dbh = null;
    }
    catch (PDOexception $e) {
        //tampilkan pesan kesalahan jika koneksi gagal
        print "koneksi atau query: " .$e->getMessage() . "<br/>";
        die();
    }
?>
