<h1>Dahboard</h1>
<!-- <?php 
	$query = mysqli_query($conn, "SELECT * FROM tb_barang WHERE stock < 10 ");
	while ($data = mysqli_fetch_array($query)) { ?>
	  <?php if ($data['stock'] > 3){ ?> 
	  	<div class="alert alert-warning alert-dismissable">
	  	  	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  	<strong>Warning!</strong> Stok <?php echo $data['nama_barang']  ?> Tersisa <?php echo $data['stock'] ?> silahkan melakukan pemesanan .!
		</div>
	  <?php }else{ ?>
		<div class="alert alert-danger alert-dismissable">
		 	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  	<strong>Danger!</strong> Stok <?php echo $data['nama_barang']  ?> Tersisa <?php echo $data['stock'] ?> silahkan melakukan pemesanan .!
		</div>
 <?php }
}
	$query2 = mysqli_query($conn, "SELECT *, count(a.id) as jumlah FROM tb_barang_stok a LEFT JOIN tb_barang b ON a.id_barang = b.id WHERE CURRENT_TIME() > a.tgl_expired GROUP BY a.id_barang");
	while ($data2 = mysqli_fetch_array($query2)) { if (empty($data2)){
		echo "";
		}  ?>
	<div class="alert alert-danger alert-dismissable">
		 	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  	<strong>Danger!</strong> barang <?php echo $data2['nama_barang']  ?> berjumlah <?php echo ($data2['jumlah']) ?> Telah Expired silahkan melakukan pemeriksaan.!
	</div>
<?php }
 ?> -->

<ul class="nav nav-tabs">
  <li class=""><a data-toggle="tab" href="#set1">Stok barang Minim </a></li>
  <!-- <li class=""><a data-toggle="tab" href="#set2">Stok barang Expired </a></li> -->
</ul>
<div class="tab-content">
    <div id="set1" class="tab-pane fade in active"><br>
      <table class="table table-responsive" id="tb1">
      	<caption>Stok Sedikit</caption>
      	<thead>
      		<tr class="warning">
            <th>Kode barang</th>
      			<th>Nama barang</th>
            <th>Satuan</th>
            <th>Jenis</th>
            <th>Keterangan</th>
      			<th>Jumlah</th>
      		</tr>
      	</thead>
      	<tbody>
      		<?php 
      		$query = mysqli_query($conn, "SELECT *, a.id as idm, b.id as idj FROM tb_barang a 
          LEFT JOIN tb_jenis b ON a.jenis = b.id 
          WHERE a.stock <= 5");
      		while ($data = mysqli_fetch_array($query)) { ?>
	      		<tr>
	      			<td><?php echo $data['kode_barang'] ?></td>
              <td><?php echo $data['nama_barang'] ?></td>
              <td><?php echo $data['satuan'] ?></td>
              <td><?php echo $data['nama_jenis'] ?></td>
              <td><?php echo $data['keterangan'] ?></td>
	      			<td><?php echo $data['stock'] ?></td>
	      		</tr>
      		<?php } ?>
      	</tbody>
      </table>
   
    </div>
    <!-- <div id="set2" class="tab-pane"> <br>
      <table class="table table-responsive" id="tb2">
      	<caption>Stok Expired</caption>
      	<thead>
      		<tr class="danger">
        			<th>Kode barang</th>
              <th>Nama barang</th>
              <th>Satuan</th>
              <th>Jenis</th>
              <th>Keterangan</th>
              <th>Tgl Expired</th>
              <th>Jumlah</th>
      		</tr>
      	</thead>
      	<tbody>
      		<?php $query2 = mysqli_query($conn, "SELECT *,count(a.id) as jumlah FROM tb_barang_stok a 
      			LEFT JOIN tb_barang b ON a.id_barang = b.id 
            LEFT JOIN tb_jenis c ON b.jenis = c.id
            WHERE CURRENT_TIME() > a.tgl_expired GROUP BY a.id_barang ");
		while ($data2 = mysqli_fetch_array($query2)) { 
			if (empty($data2)){
				echo "";
			} ?>
      		<tr>
            <td><?php echo $data2['kode_barang'] ?></td>
            <td><?php echo $data2['nama_barang'] ?></td>
            <td><?php echo $data2['satuan'] ?></td>
            <td><?php echo $data2['nama_jenis'] ?></td>
      			<td><?php echo $data2['keterangan'] ?></td>
            <td><?php echo $data2['tgl_expired'] ?></td>
      			<td><?php echo $data2['jumlah'] ?></td>
      		</tr>
      	<?php } ?>
      	</tbody>
      </table>
   
    </div> -->
</div>

<script type="text/javascript">
	 $(function(){
        $('#tb1,#tb2').DataTable();
    });
</script>