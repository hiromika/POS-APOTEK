<?php 
include "koneksi.php";
$kode = $_GET['kode'];
	if ($kode == '1'){
		$username = $_POST['username'];
		$pass = md5($_POST['password']);
		$lv = $_POST['level'];

		$sql = mysqli_query($conn,"INSERT INTO tb_user VALUES('','$username','$pass','$lv')");

		if ($sql) { ?>
			<script type="text/javascript">
				alert('Tambah Data Sukses !');
				window.location.href = 'home.php?link=men_user';
			</script>
		<?php }else{ ?>
			<script type="text/javascript">
				alert('Tambah Data Gagal !');
				window.location.href = 'home.php?link=men_user';
			</script>
		<?php 	

		}
	}elseif($kode == '2'){
		$id = $_POST['id'];
		$username = $_POST['username'];
		$pass = md5($_POST['password']);
		$lv = $_POST['level'];
		if (isset($pass)) {
			$sql= mysqli_query($conn,"UPDATE tb_user SET username = '$username', password = '$pass' , level = '$lv' WHERE id = $id");

		}else{
			$sql = mysqli_query($conn,"UPDATE tb_user SET username = '$username', level = '$lv' WHERE id = $id");
		}

		if ($sql) { ?>
			<script type="text/javascript">
				alert('Edit Data Sukses !');
				window.location.href = 'home.php?link=men_user';
			</script>
		<?php }else{ ?>
			<script type="text/javascript">
				alert('Edit Data Gagal !');
				window.location.href = 'home.php?link=men_user';
			</script>
		<?php 	
		}
	}elseif($kode == '3'){
		$id = $_GET['id'];
		$sql = mysqli_query($conn,"DELETE FROM tb_user WHERE id = '$id'");

		 if ($sql) { ?>
		 	<script type="text/javascript">
		 		alert('Delete Sukses !');
		 		window.location.href = 'home.php?link=men_user';
		 	</script>
		 <?php }else{?>

		 	<script type="text/javascript">
		 		alert('Delete Gagal !');
		 		window.location.href = 'home.php?link=men_user';
		 	</script>
		 <?php 
		 }
	}else{
		echo "Not Found !";
	}

 ?> 
