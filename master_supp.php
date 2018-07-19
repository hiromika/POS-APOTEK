<h1>Master Supplier</h1>
<button type="button" style="margin-bottom: 10px;" class="btn btn-info pull-right" data-toggle="modal" id="btntambah">Tambah supplier</button>
<br>
	<table class="table table-responsive" id="tb_supplier">
		<thead>
			<tr>
				<th>No</th>
				<th style="display: none;">id</th>
				<th>Nama Supplier</th>
				<th>Alamat</th>
				<th>No Tlp</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$no = 1;
			$sql = "SELECT * FROM tb_supplier";
			$query  = mysqli_query($conn,$sql);
			while ($data = mysqli_fetch_array($query)) { ?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td style="display: none;"><?php echo $data['id_supplier']; ?></td>
				<td><?php echo $data['nama_supp'] ?></td>
				<td><?php echo $data['alamat_supp'] ?></td>
				<td><?php echo $data['tlp_supp'] ?></td>
				<td><a href="" class="btn btn-success btn-xs btnedit" data-toggle="modal" title="">Edit</a>&nbsp
				<a href="proses_supplier.php?kode=3&id=<?php echo $data['id_supplier'];?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda Yakin.. ?');" title="">Delete</a></td>
			</tr>
		<?php
			}
		 ?>
		</tbody>
	</table>

<!-- Modal -->
<div id="tambah" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add supplier</h4>
      </div>
      <div class="modal-body">
       
	     <form action="proses_supplier.php?kode=1&id=" method="POST" class="form" accept-charset="utf-8">
			
			<div class="form-group">
				<label> Nama supplier :</label>
				<input type="text" class="form-control" name="nama_supplier" value="" placeholder="Nama supplier">
			</div>
			<div class="form-group">
				<label> Alamat supplier :</label>
				<input type="text" class="form-control" name="alamat_supplier" value="" placeholder="Alamat supplier">
			</div>
			<div class="form-group">
				<label> Tlp supplier :</label>
				<input type="number" class="form-control" name="tlp_supplier" value="" placeholder="Tlp supplier">
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
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add supplier Barang</h4>
      </div>
      <div class="modal-body">
       
	     <form action="proses_supplier.php?kode=2&id=" method="POST" class="form" accept-charset="utf-8">
			<input style="display: none;" type="text" name="id" id="id" value="">
			<div class="form-group">
				<label> Nama supplier :</label>
				<input type="text" class="form-control" name="nama_supplier" id="nama_supp" value="" placeholder="Nama supplier">
			</div>
			<div class="form-group">
				<label> Alamat supplier :</label>
				<input type="text" class="form-control" name="alamat_supplier" id="alamat_supp" value="" placeholder="Alamat supplier">
			</div>
			<div class="form-group">
				<label> Tlp supplier :</label>
				<input type="number" class="form-control" name="tlp_supplier" id="tlp_supp" value="" placeholder="Tlp supplier">
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
        $('#tb_supplier').DataTable();
    });

$(".btnedit").click(function(){
  $('#edit').modal({
  	       	show : true,
        	backdrop : 'static',
        	keyboard : false,
  });
  $("#id").val($(this).closest('tr').children()[1].textContent);
  $("#nama_supp").val($(this).closest('tr').children()[2].textContent);
  $("#alamat_supp").val($(this).closest('tr').children()[3].textContent);
  $("#tlp_supp").val($(this).closest('tr').children()[4].textContent);
});
</script>
