<?php 

include "koneksi.php";

$code = $_GET['kode'];
$id = $_GET['id'];

if (isset($code)) {
	
	if ($code == 1) {
		
		$sql = "DELETE FROM tb_obat WHERE id = '$id'";
		$query = mysqli_query($conn,$sql);

		$sql2 = "DELETE FROM tb_obat_stok WHERE id_obat = '$id'";
		$query2 = mysqli_query($conn,$sql2);

		if ($query) { ?>
			<script type="text/javascript">
				alert('Delete Sukses !');
				window.location.href = 'home.php?link=master_obat';
			</script>

		<?php }else{ ?>

			<script type="text/javascript">
				alert('Delete Gagal !');
				window.location.href = 'home.php?link=master_obat';
			</script>

		<?php }

	}elseif ($code == 2) {
		$id 			= $_POST['id'];
		$kode_obat 		= $_POST['kode_obat'];
		$nama_obat 		= $_POST['nama_obat'];
		$satuan_obat 	= $_POST['satuan'];
		$supp			= $_POST['supp'];
		$tgl_exp		= date('Y-m-d',strtotime($_POST['tgl_exp']));
		$modal			= str_replace(".", "",$_POST['harga_modal']);
		$jual			= str_replace(".", "",$_POST['harga_jual']);
		$jenis			= $_POST['jenis'];
		$keterangan		= $_POST['keterangan'];
		$stock			= $_POST['stock'];
  			
  			$sq = mysqli_query($conn, "SELECT stock FROM tb_obat WHERE id = '$id'");
  			$get = mysqli_fetch_assoc($sq);
  		// 	if ($st > $stock) {
  		// 		$limit = $get['stock'] - $stock;
				// $del = mysqli_query($conn,"DELETE FROM tb_obat_stok WHERE id_obat = $id ORDER BY id DESC LIMIT $limit");
				// $st = $get['stock'] - $stock;
  		// 	}else{
  				$x =1;
  				while ( $x <= $stock) {
					$sql2 = "INSERT INTO tb_obat_stok VALUES('','$id',CURRENT_TIME(),'$tgl_exp')";
					$query2 = mysqli_query($conn,$sql2);
					$x++;
				}
				// $st = $get['stock'] + $stock;
  		// 	}
	
			$sql = "UPDATE tb_obat SET kode_obat = '$kode_obat', id_supp = '$supp', nama_obat = '$nama_obat', satuan = '$satuan_obat', keterangan = '$keterangan', harga_modal = '$modal', harga_jual = '$jual', jenis = '$jenis', stock = stock + '$stock', last_update =CURRENT_TIME() WHERE id = '$id'";
			$query = mysqli_query($conn,$sql);


			if ($query) {
			 ?>

			<script type="text/javascript">
				alert('Update Sukses !');
				window.location.href = 'home.php?link=master_obat';
			</script>
			<?php }else{ ?>
			<script type="text/javascript">
				alert('Update Gagal !');
				 window.location.href = 'home.php?link=master_obat';
			</script>
			
			<?php }
	}else if ($code == 4) {

		$sql2 = "DELETE FROM tb_obat_stok WHERE id = '$id'";
		$query2 = mysqli_query($conn,$sql2);

		$sql = "UPDATE tb_obat SET stock = stock - 1 WHERE id = '$_GET[ido]'";
			$query = mysqli_query($conn,$sql);

		if ($query) { ?>
			<script type="text/javascript">
				alert('Delete Sukses !');
				window.location.href = 'home.php?link=master_obat_view&id=<?php echo $_GET['ido'];?>';
			</script>

		<?php }else{ ?>

			<script type="text/javascript">
				alert('Delete Gagal !');
				window.location.href = 'home.php?link=master_obat_view&id=<?php echo $_GET['ido'];?>';
			</script>

		<?php }

	
	}else{

		$kode_obat 		= $_POST['kode_obat'];
		$nama_obat 		= $_POST['nama_obat'];
		$satuan_obat	= $_POST['satuan'];
		$jenis			= $_POST['jenis'];
		$supp			= $_POST['supp'];
		$tgl_exp		= date('Y-m-d',strtotime($_POST['tgl_exp']));
		$modal			= $_POST['harga_modal'];
		$jual			= $_POST['harga_jual'];
		$keterangan		= $_POST['keterangan'];
		$stock			= $_POST['stock'];

		$sql = "INSERT INTO tb_obat VALUES('','$kode_obat','$supp','$nama_obat','$keterangan','$modal','$jual','$jenis','$satuan_obat','$stock',CURRENT_TIME(),'')";
		$query = mysqli_query($conn,$sql);

		$idb = mysqli_insert_id($conn);
		$x = 1; 
		while ( $x <= $stock) {
			$sql2 = "INSERT INTO tb_obat_stok VALUES('','$idb',CURRENT_TIME(),'$tgl_exp')";
			$query2 = mysqli_query($conn,$sql2);
			$x++;
		}

		if($query){ ?>
			<script type="text/javascript">
				window.location.href = 'home.php?link=master_obat';
			</script>

		<?php }else{ ?>
			<script type="text/javascript">
				alert('Insert Gagal!');
				window.location.href = 'home.php?link=master_obat';
			</script>
		<?php }

	}

}else{

	echo "wrong away";
}

 ?>