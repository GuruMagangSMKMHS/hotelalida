<?php
	require_once "viewmaster/header.php";
    include "datamaster/koneksiDB.php";
	echo "<script>swal({
	  title: 'Yakin Ingin Keluar?',
	  type: 'warning',
	  backdrop: 'rgba(0,0,123,0.5)',
	  showCancelButton: true,
	}).then((result) => {
		if (result.dismiss === swal.DismissReason.cancel) {
			window.setTimeout(function(){
				window.location.replace('/hotelalida');
			} ,100)
		}
		else if (result.value) {
			window.setTimeout(function(){
				window.location.replace('unset.php');
			} ,0)
		}
	});</script>";
?>