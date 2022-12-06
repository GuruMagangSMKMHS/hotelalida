<?php if(!isset($_SESSION['ceklog'])) { ?>
<script>
    swal({
        title: 'Oops...?',
        title: 'Silahkan Login Terlebih Dahulu!',
        showConfirmButton: false,
        backdrop: 'rgba(123,0,0,0.5)',
    });
    window.setTimeout(function(){
        window.location.replace('/hotelalida/admin');
    } ,1500);
</script>
<?php } ?>