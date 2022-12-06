<?php 
	require_once "../viewmaster/header.php";
	require_once "view/menu.php";
    include "../datamaster/koneksiDB.php";
    if(isset($_POST['login'])){
        $user   = $_POST['username'];
        $pass   = MD5($_POST['password']);
        $sql    = $pdo->query("SELECT * FROM tamu WHERE username='$user' AND password='$pass'");
        $cari   = $sql->rowCount();
        $akses  = $sql->fetch();
        if($cari){
            $_SESSION['ceklog'] = $akses['username'];
            echo "<script>swal({
            type: 'success',
            title: 'login Sukses!',
            showConfirmButton: false,
            backdrop: 'rgba(0,0,123,0.5)',
            });
            window.setTimeout(function(){
                window.location.replace('../index.php');
            } ,1500); </script>";
        }else{
            echo "<script>swal({
            type: 'error',
            title: 'login Gagal! silahkan Username dan Password dengan Benar',
            showConfirmButton: false,
            backdrop: 'rgba(0,0,123,0.5)',
            });
            window.setTimeout(function(){
                window.location.replace('login.php');
            } ,1500); </script>";
        }
    }
?>
<div style="
	width: 100%;
	display: flex;
	justify-content: center;
	min-height: 100%;
	padding-right : 20px !impertant;
	background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
	background-image: url(http://localhost/hotelalida/gambar/background-1.jpg);
	background-repeat: no-repeat;
	">
	<div class="mt-6 mb-3" align="center" style="
		background: rgba(255,255,255, 0.88);
		border-radius: 10px;
		padding-bottom: 20px;
		width: 1000px;
		height: 100%;
	">
		<div class="w-full max-w-md space-y-8">
			<div>
				<h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
					Login
				</h2>
			</div>
			<form class="mt-8 space-y-6" action="" method="POST">
				<div class="-space-y-px rounded-md shadow-sm">
					<div class="-space-y-px">
						<input type="text" placeholder="Masukan Username" name="username" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
					</div>
				</div>
				<div class="-space-y-px rounded-md shadow-sm">
					<div>
						<input type="password" placeholder="Masukan Password" name="password" required class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
					</div>
				</div>
				<button type="submit" name="login" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
					<span class="absolute inset-y-0 left-0 flex items-center pl-3">
						<svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
						</svg>
					</span>
					Login
				</button>
			</form>
		</div>
	</div>
</div>
<?php require_once "../viewmaster/footer.php"; ?>