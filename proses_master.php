<?php 

include "koneksi.php";

$code = $_GET['kode'];
$id = $_GET['id'];

if (isset($code)) {
	
	if ($code == 1) {
		
		$sql = "DELETE FROM tb_barang WHERE id = '$id'";
		$query = mysqli_query($conn,$sql);

		$sql2 = "DELETE FROM tb_barang_stok WHERE id_barang = '$id'";
		$query2 = mysqli_query($conn,$sql2);

		if ($query) { ?>
			<script type="text/javascript">
				alert('Delete Sukses !');
				window.location.href = 'home.php?link=master_barang';
			</script>

		<?php }else{ ?>

			<script type="text/javascript">
				alert('Delete Gagal !');
				window.location.href = 'home.php?link=master_barang';
			</script>

		<?php }

	}elseif ($code == 2) {
		$id 			= $_POST['id'];
		$kode_barang 	= $_POST['kode_barang'];
		$nama_barang 	= $_POST['nama_barang'];
		$satuan_barang 	= $_POST['satuan'];
		$supp			= $_POST['supp'];
		$tgl_exp		= date('Y-m-d',strtotime($_POST['tgl_exp']));
		$modal			= str_replace(".", "",$_POST['harga_modal']);
		$jual			= str_replace(".", "",$_POST['harga_jual']);
		$jenis			= $_POST['jenis'];
		$keterangan		= $_POST['keterangan'];
		$stock			= $_POST['stock'];
  			
  			$sq = mysqli_query($conn, "SELECT stock FROM tb_barang WHERE id = '$id'");
  			$get = mysqli_fetch_assoc($sq);
  		// 	if ($st > $stock) {
  		// 		$limit = $get['stock'] - $stock;
				// $del = mysqli_query($conn,"DELETE FROM tb_barang_stok WHERE id_barang = $id ORDER BY id DESC LIMIT $limit");
				// $st = $get['stock'] - $stock;
  		// 	}else{
  				$x =1;
  				while ( $x <= $stock) {
					$sql2 = "INSERT INTO tb_barang_stok VALUES('','$id',CURRENT_TIME(),'$tgl_exp')";
					$query2 = mysqli_query($conn,$sql2);
					$x++;
				}
				// $st = $get['stock'] + $stock;
  		// 	}
	
			$sql = "UPDATE tb_barang SET kode_barang = '$kode_barang', id_supp = '$supp', nama_barang = '$nama_barang', satuan = '$satuan_barang', keterangan = '$keterangan', harga_modal = '$modal', harga_jual = '$jual', jenis = '$jenis', stock = stock + '$stock', last_update =CURRENT_TIME() WHERE id = '$id'";
			$query = mysqli_query($conn,$sql);


			if ($query) {
			 ?>

			<script type="text/javascript">
				alert('Update Sukses !');
				window.location.href = 'home.php?link=master_barang';
			</script>
			<?php }else{ ?>
			<script type="text/javascript">
				alert('Update Gagal !');
				 window.location.href = 'home.php?link=master_barang';
			</script>
			
			<?php }
	}else if ($code == 4) {

		$sql2 = "DELETE FROM tb_barang_stok WHERE id = '$id'";
		$query2 = mysqli_query($conn,$sql2);

		$sql = "UPDATE tb_barang SET stock = stock - 1 WHERE id = '$_GET[ido]'";
			$query = mysqli_query($conn,$sql);

		if ($query) { ?>
			<script type="text/javascript">
				alert('Delete Sukses !');
				window.location.href = 'home.php?link=master_barang_view&id=<?php echo $_GET['ido'];?>';
			</script>

		<?php }else{ ?>

			<script type="text/javascript">
				alert('Delete Gagal !');
				window.location.href = 'home.php?link=master_barang_view&id=<?php echo $_GET['ido'];?>';
			</script>

		<?php }

	
	}else{

		$tmp_file = $_FILES["myFile"]["tmp_name"];
        $filename = $_FILES["myFile"]["name"];
		$success = move_uploaded_file($tmp_file , "assets/img/". $filename);

		$kode_barang 	= $_POST['kode_barang'];
		$nama_barang 	= $_POST['nama_barang'];
		$satuan_barang	= $_POST['satuan'];
		$jenis			= $_POST['jenis'];
		$supp			= $_POST['supp'];
		$tgl_exp		= date('Y-m-d',strtotime($_POST['tgl_exp']));
		$modal			= $_POST['harga_modal'];
		$jual			= $_POST['harga_jual'];
		$keterangan		= $_POST['keterangan'];
		$stock			= $_POST['stock'];

		$sq = mysqli_query($conn, "SELECT stock FROM tb_barang WHERE kode_barang = '$kode_barang'");
  		if (mysqli_num_rows($sq) > 0) { ?>
  			<script type="text/javascript">
				alert('Insert Gagal Kode barang Sudah Ada.!');
				window.location.href = 'home.php?link=master_barang';
			</script>
  		<?php }else{

			$sql = "INSERT INTO tb_barang VALUES('','$kode_barang','$supp','$nama_barang','$keterangan','$modal','$jual','$jenis','$satuan_barang','$stock',CURRENT_TIME(),'$filename')";
			$query = mysqli_query($conn,$sql);

			$idb = mysqli_insert_id($conn);
			$x = 1; 
			while ( $x <= $stock) {
				$sql2 = "INSERT INTO tb_barang_stok VALUES('','$idb',CURRENT_TIME(),'$tgl_exp')";
				$query2 = mysqli_query($conn,$sql2);
				$x++;
			}

			if($query){ ?>
				<script type="text/javascript">
					window.location.href = 'home.php?link=master_barang';
				</script>

			<?php }else{ ?>
				<script type="text/javascript">
					alert('Insert Gagal!');
					window.location.href = 'home.php?link=master_barang';
				</script>
			<?php }

  		}
	}

}else{

	echo "wrong away";
}

 ?>