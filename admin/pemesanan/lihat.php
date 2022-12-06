<?php
    require_once "../../viewmaster/header.php";
    require_once "../view/menu.php";
    require_once "../view/ceklog.php";
    require_once "../../datamaster/koneksiDB.php";
?>
<form action="" method="get">
    <label>cari :</label>
    <input type="text" name="cari">
    <input type="submit" value="cari">
</form>
<a href="laporan.php" target="_blank"><button id="laporan">Cetak Laporan</button></a>
<br><br>
<?php
    if(isset($_GET['cari'])){
        $cari =$_GET['cari'];
        echo "<b>Hasil pencarian :",$cari."</b>";
    }
?>
<table width="100%" border=1>
    <?php
        if(isset($_GET['cari'])){
            $cari =$_GET['cari'];
                $sql = $pdo->query( "SELECT * FROM pemesanan where 
									   idpesan like '%".$cari."%' 
									OR tglpesan like '%".$cari."%' 
									OR batasbayar like '%".$cari."%' 
									OR idkamar like '%".$cari."%' 
									OR harga like '%".$cari."%' 
									OR jumlah like '%".$cari."%' 
									OR idtamu like '%".$cari."%' 
									OR nama like '%".$cari."%' 
									OR alamat like '%".$cari."%' 
									OR telepon like '%".$cari."%' 
									OR tglmasuk like '%".$cari."%' 
									OR tglkeluar like '%".$cari."%' 
									OR lamahari like '%".$cari."%' 
									OR totalbayar like '%".$cari."%' 
									OR status like '%".$cari."%'
								  ");
		}else{
            $sql = $pdo->query ("select * from pemesanan order by idpesan asc");
        }
    ?>
    <thead>
        <tr>
            <th>No </th>
            <th>Tgl Pesan</th>
            <th>Batas Bayar</th>
            <th>Kamar</th>
            <th>Tamu</th>
            <th>Tgl Masuk</th>
            <th>Tgl Keluar</th>
            <th>Lama Hari</th>
            <th>Total Bayar</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $s =  '';
            foreach($sql as $val){
                $s++;
        ?>
        <tr>
            <td><?php echo $s;?></td>
            <td><?php echo $val['tglpesan'];?></td>
            <td><?php echo $val['batasbayar'];?></td>
            <td>
				ID : <?php echo $val['idkamar'];?>
				<br>
				Harga : <?php echo $val['harga'];?>
				<br>
				Jumlah : <?php echo $val['jumlah'];?>
			</td>
            <td>
				ID : <?php echo $val['idtamu'];?>
				<br>
				Nama : <?php echo $val['nama'];?>
				<br>
				Alamat : <?php echo $val['alamat'];?>
				<br>
				Telpon : <?php echo $val['telepon'];?>
			</td>
            <td><?php echo $val['tglmasuk'];?></td>
            <td><?php echo $val['tglkeluar'];?></td>
            <td><?php echo $val['lamahari'];?></td>
            <td><?php echo $val['totalbayar'];?></td>
            <td><?php echo $val['status'];?></td>
			<td align="center">
				<a href="delete.php?id=<?php echo $val['idpesan'];?>" onclick="return confirm('Anda akan menghapus?')"><button>delete</button></a> 
			</td>
        </tr>
        <?php } ?>
    </tbody>
</table>
<?php require_once "../../viewmaster/footer.php"; ?>