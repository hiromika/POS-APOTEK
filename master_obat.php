<h1>Master Data Obat</h1>
<button type="button" style="margin-bottom: 10px;" class="btn btn-info pull-right" data-toggle="modal" id="btntambah">Tambah obat</button>
<br>
	<table class="table table-responsive table-hover" id="tb_master">
		<thead>
			<tr>
				<th>No</th>
				<th style="display: none;">id</th>
				<th>Kode obat</th>
				<th style="display: none;">ids</th>
				<th>Supplier</th>
				<th>Nama obat</th>
				<th style="display: none;">idj</th>
				<th>satuan</th>
				<th>Jenis</th>
				<th>Keterangan</th>
				<th class="bg-info">Harga Modal</th>
				<th class="bg-success">Harga Jual</th>
				<th>Stock</th>
				<th>Last Update</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$no = 1;
			$sql = "SELECT *, a.id as idm, b.id as idj, c.id_supplier as id_supp FROM tb_obat a LEFT JOIN tb_jenis b ON a.jenis = b.id LEFT JOIN tb_supplier c ON a.id_supp = c.id_supplier";
			$query  = mysqli_query($conn,$sql);
			while ($data = mysqli_fetch_array($query)) { ?>
			<tr>
				<td><?php echo $no; ?></td>
				<td style="display: none;"><?php echo $data['idm']; ?></td>
				<td><?php echo $data['kode_obat'] ?></td>
				<td style="display: none;"><?php echo $data['id_supp'] ?></td>
				<td><?php echo $data['nama_supp'] ?></td>
				<td><?php echo $data['nama_obat'] ?></td>
				<td style="display: none;"><?php echo $data['jenis'] ?></td>
				<td><?php echo $data['satuan'] ?></td>
				<td><?php echo $data['nama_jenis'] ?></td>
				<td><?php echo $data['keterangan'] ?></td>
				<td class="bg-info"><?php echo number_format($data['harga_modal'],0,',','.'); ?></td>
				<td class="bg-success"><?php echo number_format($data['harga_jual'],0,',','.'); ?></td>
				<td class="<?php echo ($data['stock'] <= 5)?'bg-danger':'' ?>"><?php echo $data['stock'] ?></td>
				<td><?php echo date('d-M-Y H:i A', strtotime($data['last_update'])); ?></td>
				<td>
				<a href="" class="btn btn-success btn-xs btnedit" data-toggle="modal" title="">Edit</a>&nbsp
				<a href="home.php?link=master_obat_view&id=<?php echo $data['idm'];?>&ido=" class="btn btn-info btn-xs" title="">View</a>
				<a href="proses_master.php?kode=1&id=<?php echo $data['idm'];?>&ido=" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda Yakin.. ?');" title="">Delete</a>
				</td>
			</tr>

		<?php 
		$no++;
			}
		 ?>
		</tbody>
	</table>
<div class="row">
	<div class="col-md-12">
		<a href="print_master.php" class="btn btn-info" title="print">Print</a>
	</div>
</div>

<!-- proses_master.php?kode=2&id=<?php echo $data['idm'];?> -->

<!-- Modal -->
<div id="tambah" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Obat</h4>
      </div>
      <div class="modal-body">
       
	     <form action="proses_master.php?kode=3&id=&ido=" method="POST" class="form" accept-charset="utf-8">
			
			<div class="form-group">
				<label> Kode obat :</label>
				<input type="text" class="form-control" name="kode_obat" value="" placeholder="Kode obat">
			</div>
			<div class="form-group">
				<label> Supplier :</label>
				<select name="supp" class="form-control">
					<option selected="" disabled >~ Pilih Supplier ~</option>}
					<?php 
						$que = mysqli_query($conn,"SELECT * FROM tb_supplier");
						while ($jenis = mysqli_fetch_array($que)) { ?>
							<option value="<?php echo $jenis['id_supplier'] ?>"><?php echo $jenis['nama_supp']; ?></option>
							
					<?php	}
					?>
				</select>
			</div>
			<div class="form-group">
				<label> Nama obat :</label>
				<input type="text" class="form-control" name="nama_obat" value="" placeholder="Nama obat">
			</div>
			<div class="form-group">
				<label> satuan :</label>
				<select name="satuan" class="form-control">
					<option selected="" disabled >~ Pilih Satuan ~</option>
					<option value="Strip" > Strip </option>
					<option value="Botol" > Botol </option>
					<option value="Butir" > Butir </option>
				</select>
			</div>
			<div class="form-group">
				<label> Jenis menu :</label>
				<select name="jenis" class="form-control">
					<option selected="" disabled >~ Pilih Jenis ~</option>}
					<?php 
						$que = mysqli_query($conn,"SELECT * FROM tb_jenis");
						while ($jenis = mysqli_fetch_array($que)) { ?>
							<option value="<?php echo $jenis['id'] ?>"><?php echo $jenis['nama_jenis']; ?></option>
							
					<?php	}
					?>
				</select>
			</div>
			<div class="form-group">
				<label> Tgl Expired:</label>
				<input type="text" class="form-control exp" name="tgl_exp" value="" placeholder="Tgl Expired">
			</div>
			<div class="form-group">
				<label> Stock :</label>
				<input type="number" class="form-control" name="stock" value="" placeholder="Stock">
			</div>
			<div class="form-group">
				<label> Harga Modal/Item:</label>
				<input type="number" class="form-control" name="harga_modal" value="" placeholder="Harga Modal/Item">
			</div>
			<div class="form-group">
				<label> Harga Jual/Item:</label>
				<input type="number" class="form-control" name="harga_jual" value="" placeholder="Harga Jual/Item">
			</div>
			<div class="form-group">
				<label> Keterangan : </label>
				<textarea name="keterangan" class="form-control" placeholder="Kategori"></textarea>
			</div>


	   </div>
	  <div class="modal-footer">
	        <button type="submit" class="btn btn-primary">Tambah</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</form>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="edit" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Obat</h4>
      </div>
      <div class="modal-body">
       
	     <form action="proses_master.php?kode=2&id=&ido=" method="POST" class="form" accept-charset="utf-8">
	     	<div class="row">
	     		<div class="col-md-6">
	     			<h4>Edit Data Obat</h4>
			     	<input style="display: none;" type="text" name="id" id="id" value="">
					<div class="form-group">
						<label> Kode obat :</label>
						<input type="text" class="form-control" name="kode_obat" id="kode_obat" value="" placeholder="Kode obat">
					</div>
					<div class="form-group">
						<label> Supplier :</label>
						<select name="supp" id="supp" class="form-control">
							<option  disabled >~ Pilih Supplier ~</option>}
							<?php 
								$que = mysqli_query($conn,"SELECT * FROM tb_supplier");
								while ($jenis = mysqli_fetch_array($que)) { ?>
									<option value="<?php echo $jenis['id_supplier'] ?>"><?php echo $jenis['nama_supp']; ?></option>
									
							<?php	}
							?>
						</select>
					</div>
					<div class="form-group">
						<label> Nama Menu :</label>
						<input type="text" class="form-control" id="nama_obat" name="nama_obat" value="">
					</div>
					<div class="form-group">
						<label> satuan </label>
						<select name="satuan" id="satuan_obat" class="form-control">
							<option selected="" disabled >~ Pilih Satuan ~</option>
							<option value="Strip" > Strip </option>
							<option value="Botol" > Botol </option>
							<option value="Butir" > Butir </option>
						</select>
					</div>
					<div class="form-group">
						<label> Jenis Menu :</label>
						<select name="jenis" id="jenis" class="form-control">
							<option selected="" disabled >~ Pilih Jenis ~</option>}
							<?php 
								$que = mysqli_query($conn,"SELECT * FROM tb_jenis");
								while ($jenis = mysqli_fetch_array($que)) { ?>
									<option value="<?php echo $jenis['id'] ?>"><?php echo $jenis['nama_jenis']; ?></option>
									
							<?php	}
							?>
						</select>
					</div>
					<div class="form-group">
						<label> Harga Modal:</label>
						<input type="number" class="form-control" name="harga_modal" id="harga_modal" value="">
					</div>
					<div class="form-group">
						<label> Harga Jual:</label>
						<input type="number" class="form-control" name="harga_jual" id="harga_jual" value="">
					</div>
					<div class="form-group">
						<label> Keterangan : </label>
						<textarea name="keterangan" id="keterangan" class="form-control"></textarea>
					</div>
	     		</div>
	     		<div class="col-md-6">
	     			<h4>Tambah Stock Obat</h4>
					<div class="form-group">
						<label> Tgl Expired:</label>
						<input type="text" class="form-control exp2" name="tgl_exp" id="tgl_exp" value="">
					</div>
					<div class="form-group">
						<label> Stock :</label>
						<input type="number" class="form-control" id="stock" name="stock" value="">
					</div>
	     		</div>
	     	</div>

	   </div>
	  <div class="modal-footer">
	        <button type="submit" class="btn btn-primary">Edit</button>
	        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
		</form>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">
$('#btntambah').click(function(){
	$('#tambah').modal({
		    show : true,
        	backdrop : 'static',
        	keyboard : false,
        
	})
})
 $(function(){
        $('#tb_master').DataTable();

        $('.exp,.exp2').datetimepicker({

            format: 'DD-MM-YYYY'
        })
 });



$(".btnedit").click(function(){
  $('#edit').modal({
  	       	show : true,
        	backdrop : 'static',
        	keyboard : false,
  });
  $("#id").val($(this).closest('tr').children()[1].textContent);
  $("#kode_obat").val($(this).closest('tr').children()[2].textContent);
  $("#nama_obat").val($(this).closest('tr').children()[5].textContent);
  $("#satuan_obat").val($(this).closest('tr').children()[7].textContent);
  $("#harga_modal").val($(this).closest('tr').children()[10].textContent);
  $("#harga_jual").val($(this).closest('tr').children()[11].textContent);
  $("#jenis").val($(this).closest('tr').children()[6].textContent);
  $("#keterangan").val($(this).closest('tr').children()[9].textContent);
  $("#supp").val($(this).closest('tr').children()[3].textContent);
});
</script>
