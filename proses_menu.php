<?php 

include "koneksi.php";

$code = $_GET['kode'];
$id = $_GET['id'];

if (isset($code)) {
	
	if ($code == 1) {
		
		$sql = "DELETE FROM tb_menu WHERE id = '$id'";
		$query = mysqli_query($conn,$sql);

		if ($query) { ?>
			<script type="text/javascript">
				alert('Delete Sukses !');
				window.location.href = 'home.php?link=2';
			</script>

		<?php }else{ ?>

			<script type="text/javascript">
				alert('Delete Gagal !');
				window.location.href = 'home.php?link=2';
			</script>

		<?php }

	}elseif ($code == 2) {
		$id 		= $_POST['id'];
		$nama_menu 	= $_POST['nama_menu'];
		$jenis		= $_POST['jenis'];
		$harga		= str_replace(".", "", $_POST['harga']);
		$keterangan	= $_POST['keterangan'];
		$stock		= $_POST['stock'];
  

	
			$sql = "UPDATE tb_menu SET nama_menu = '$nama_menu', keterangan = '$keterangan', harga = '$harga', jenis = '$jenis', stock = '$stock' WHERE id = '$id'";
			$query = mysqli_query($conn,$sql);
			if ($query) {
			 ?>

			<script type="text/javascript">
				alert('Update Sukses !');
				window.location.href = 'home.php?link=2';
			</script>
			<?php }else{ ?>
			<script type="text/javascript">
				alert('Update Gagal !');
				window.location.href = 'home.php?link=2';
			</script>
			<?php }
		
	}else{

		$nama_menu 	= $_POST['nama_menu'];
		$jenis		= $_POST['jenis'];
		$harga		= $_POST['harga'];
		$keterangan	= $_POST['keterangan'];
		$stock		= $_POST['stock'];

		$sql = "INSERT INTO tb_menu VALUES('','$nama_menu','$keterangan','$harga','$jenis','$stock','')";
		$query = mysqli_query($conn,$sql);

		if($query){ ?>

			<script type="text/javascript">
				alert('Insert Sukses !');
				window.location.href = 'home.php?link=2';
			</script>

		<?php }else{ ?>
			<script type="text/javascript">
				alert('Insert Gagal!');
				window.location.href = 'home.php?link=2';
			</script>
		<?php }

	}

}else{

	echo "wrong away";
}

 ?>