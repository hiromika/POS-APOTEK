<?php 
include "koneksi.php";
$kode = $_GET['kode'];
	if ($kode == '1'){
		$nama_supp = $_POST['nama_supplier'];
		$alamat_supp = $_POST['alamat_supplier'];
		$tlp_supp = $_POST['tlp_supplier'];

		$sql = mysqli_query($conn,"INSERT INTO tb_supplier VALUES('','$nama_supp','$alamat_supp','$tlp_supp')");

		if ($sql) { ?>
			<script type="text/javascript">
				alert('Tambah Data Sukses !');
				window.location.href = 'home.php?link=master_supp';
			</script>
		<?php }else{ ?>
			<script type="text/javascript">
				alert('Tambah Data Gagal !');
				window.location.href = 'home.php?link=master_supp';
			</script>
		<?php 	

		}
	}elseif($kode == '2'){
		$id = $_POST['id'];
		$nama_supp = $_POST['nama_supplier'];
		$alamat_supp = $_POST['alamat_supplier'];
		$tlp_supp = $_POST['tlp_supplier'];
		$sql = mysqli_query($conn,"UPDATE tb_supplier SET nama_supp = '$nama_supp', alamat_supp = '$alamat_supp', tlp_supp = '$tlp_supp' WHERE id_supplier = $id");

		if ($sql) { ?>
			<script type="text/javascript">
				alert('Edit Data Sukses !');
				window.location.href = 'home.php?link=master_supp';
			</script>
		<?php }else{ ?>
			<script type="text/javascript">
				alert('Edit Data Gagal !');
				window.location.href = 'home.php?link=master_supp';
			</script>
		<?php 	
		}
	}elseif($kode == '3'){
		$id = $_GET['id'];
		$sql = mysqli_query($conn,"DELETE FROM tb_supplier WHERE id_supplier = '$id'");

		 if ($sql) { ?>
		 	<script type="text/javascript">
		 		alert('Delete Sukses !');
		 		window.location.href = 'home.php?link=master_supp';
		 	</script>
		 <?php }else{?>

		 	<script type="text/javascript">
		 		alert('Delete Gagal !');
		 		window.location.href = 'home.php?link=master_supp';
		 	</script>
		 <?php 
		 }
	}else{
		echo "Not Found !";
	}

 ?> 
