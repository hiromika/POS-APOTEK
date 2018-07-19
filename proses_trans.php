<?php 
include "koneksi.php";
$idb 	= $_POST['idb'];
$jml	= $_POST['jumlah'];
$harga	= $_POST['harga_jual'];
$modal	= $_POST['harga_modal'];
$tot	= $jml * $harga;
$tot2 	= $jml * $modal;
$laba	= $tot - $tot2; 
$idt 	= $_GET['idt'];
$code 	= $_GET['kode'];


switch ($code) {
	case '1':
		// tambah
			if ($idt > 0) {
				$sql	= "INSERT INTO tb_transaksi_list (id_trans,id_menu,jumlah,harga_total,laba) VALUES('$idt','$idb','$jml','$tot','$laba')";
				$query 	= mysqli_query($conn,$sql); 

				$sql2 	= "SELECT jumlah_menu,total_harga FROM tb_transaksi WHERE id = '$idt'";
				$query2 = mysqli_query($conn,$sql2);
				$trans 	= mysqli_fetch_assoc($query2);
				$jum 	= $trans['jumlah_menu'] + 1;
				$har 	= $trans['total_harga'] + $tot;

				$sql3 	= "UPDATE tb_transaksi SET jumlah_menu ='$jum', total_harga = '$har' WHERE id = '$idt'";
				$query3	= mysqli_query($conn,$sql3);  
				
				$sql4	= "SELECT stock FROM tb_obat WHERE id = '$idb'";
				$query4 = mysqli_query($conn,$sql4);
				$st 	= mysqli_fetch_assoc($query4);

				$del = mysqli_query($conn,"DELETE FROM tb_obat_stok WHERE id_barang = $idb ORDER BY id ASC LIMIT $jml");
				
				$stock	= $st['stock'] - $jml;

				$sql5 	= "UPDATE tb_obat SET stock ='$stock' WHERE id = '$idb'";
				$query5	= mysqli_query($conn,$sql5);  

				header('Location: home.php?link=transaksi&idt='.$idt.'');

			}else{
				$sql	= "INSERT INTO tb_transaksi (jumlah_menu,total_harga) VALUES('1','$tot')";
				$query 	= mysqli_query($conn,$sql); 
				$id 	= mysqli_insert_id($conn);


				$sql2	= "INSERT INTO tb_transaksi_list (id_trans,id_menu,jumlah,harga_total,laba) VALUES('$id','$idb','$jml','$tot','$laba')";
				$query2 = mysqli_query($conn,$sql2); 

				$sql4	= "SELECT stock FROM tb_obat WHERE id = '$idb'";
				$query4 = mysqli_query($conn,$sql4);
				$st 	= mysqli_fetch_assoc($query4);

				$del = mysqli_query($conn,"DELETE FROM tb_obat_stok WHERE id_barang = $idb ORDER BY id ASC LIMIT $jml");

				$stock	= $st['stock'] - $jml;
				$sql5 	= "UPDATE tb_obat SET stock ='$stock' WHERE id = '$idb'";
				$query5	= mysqli_query($conn,$sql5);  

				header('Location: home.php?link=transaksi&idt='.$id.'');
			}
		break;
	case '2':
		// hapus
			if (isset($_GET['idts'])) {
				$idts = $_GET['idts'];
				$sql 	= "SELECT * FROM tb_transaksi_list WHERE id = '$idts'";
				$query 	= mysqli_query($conn,$sql);
				$tr 	= mysqli_fetch_assoc($query);

				$sql2 	= "SELECT jumlah_menu,total_harga FROM tb_transaksi WHERE id = '$idt'";
				$query2 = mysqli_query($conn,$sql2);
				$trans 	= mysqli_fetch_assoc($query2);
				$jum 	= $trans['jumlah_menu'] - 1;
				$har 	= $trans['total_harga'] - $tr['harga_total'];

				$sql3 	= "UPDATE tb_transaksi SET jumlah_menu ='$jum', total_harga = '$har' WHERE id = '$idt'";
				$query3	= mysqli_query($conn,$sql3);  
				
				$sql4	= "SELECT stock FROM tb_obat WHERE id = '$tr[id_menu]'";
				$query4 = mysqli_query($conn,$sql4);
				$st 	= mysqli_fetch_assoc($query4);

				$x = 1; 
				while ( $x <= $tr['jumlah']) {
					$sql2 = "INSERT INTO tb_obat_stok VALUES('','$tr[id_menu]',CURRENT_TIME())";
					$query2 = mysqli_query($conn,$sql2);
					$x++;
				}

				$stock	= $st['stock'] + $tr['jumlah'];

				$sql5 	= "UPDATE tb_obat SET stock ='$stock' WHERE id = '$tr[id_menu]'";
				$query5	= mysqli_query($conn,$sql5);  

				$sql6 	= "DELETE FROM tb_transaksi_list WHERE id = '$idts'";
				$query6	= mysqli_query($conn,$sql6);  

				header('Location: home.php?link=transaksi&idt='.$idt.'');
			}
		break;
	case '3':
		
			if ($_GET['del']=1) {

				$sq	= "SELECT * FROM tb_transaksi_list WHERE id_trans = '$idt'";
				$quer 	= mysqli_query($conn,$sq);
				while ($data = mysqli_fetch_array($quer)) {
					$idts = $data['id_menu'];
					$sql4	= "SELECT stock FROM tb_obat WHERE id = '$idts'";
					$query4 = mysqli_query($conn,$sql4);
					$st 	= mysqli_fetch_assoc($query4);
					$stock	= $st['stock'] + $data['jumlah'];

					$x = 1; 
					while ( $x <= $data['jumlah']) {
						$sql2 = "INSERT INTO tb_obat_stok VALUES('','$idts',CURRENT_TIME())";
						$query2 = mysqli_query($conn,$sql2);
						$x++;
					}


					$sql5 	= "UPDATE tb_obat SET stock ='$stock' WHERE id = '$idts'";
					$query5	= mysqli_query($conn,$sql5);  
				}
				

				$sql	= "DELETE FROM tb_transaksi WHERE id = '$idt'";
				$query	= mysqli_query($conn,$sql);  

				$sql2 	= "DELETE FROM tb_transaksi_list WHERE id_trans = '$idt'";
				$query2	= mysqli_query($conn,$sql2);  

				header('Location: home.php?link=transaksi&idt=0');
			}
		break;
	
	default:
		echo "Not Found";
		break;
}


?>