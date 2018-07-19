<?php 
include "koneksi.php";
$kode = $_GET['kode'];
	if ($kode == '1'){
		$jenis = $_POST['nama_jenis'];

		$sql = mysqli_query($conn,"INSERT INTO tb_jenis VALUES('','$jenis')");

		if ($sql) { ?>
			<script type="text/javascript">
				alert('Tambah Data Sukses !');
				window.location.href = 'home.php?link=jenis';
			</script>
		<?php }else{ ?>
			<script type="text/javascript">
				alert('Tambah Data Gagal !');
				window.location.href = 'home.php?link=jenis';
			</script>
		<?php 	

		}
	}elseif($kode == '2'){
		$id = $_POST['id'];
		$jenis = $_POST['nama_jenis']; 
		$sql = mysqli_query($conn,"UPDATE tb_jenis SET nama_jenis = '$jenis' WHERE id = $id");

		if ($sql) { ?>
			<script type="text/javascript">
				alert('Edit Data Sukses !');
				window.location.href = 'home.php?link=jenis';
			</script>
		<?php }else{ ?>
			<script type="text/javascript">
				alert('Edit Data Gagal !');
				window.location.href = 'home.php?link=jenis';
			</script>
		<?php 	
		}
	}elseif($kode == '3'){
		$id = $_GET['id'];
		$sql = mysqli_query($conn,"DELETE FROM tb_jenis WHERE id = '$id'");

		 if ($sql) { ?>
		 	<script type="text/javascript">
		 		alert('Delete Sukses !');
		 		window.location.href = 'home.php?link=jenis';
		 	</script>
		 <?php }else{?>

		 	<script type="text/javascript">
		 		alert('Delete Gagal !');
		 		window.location.href = 'home.php?link=jenis';
		 	</script>
		 <?php 
		 }
	}else{
		echo "Not Found !";
	}

 ?> 
