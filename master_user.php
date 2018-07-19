<h1>Manajemen Pengguna</h1>
<button type="button" style="margin-bottom: 10px;" class="btn btn-info pull-right" data-toggle="modal" id="btntambah">Tambah user</button>
<br>
	<table class="table table-responsive" id="tb_user">
		<thead>
			<tr>
				<th>No</th>
				<th style="display: none;">id</th>
				<th>Username</th>
				<th>Level</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
		<?php 
			$no = 1;
			$sql = "SELECT * FROM tb_user";
			$query  = mysqli_query($conn,$sql);
			while ($data = mysqli_fetch_array($query)) { ?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td style="display: none;"><?php echo $data['id']; ?></td>
				<td><?php echo $data['username'] ?></td>
				<td><?php if ($data['level'] == 1) {
					echo 'Gudang';
				}elseif ($data['level'] == 2) {
					echo 'Kasir';
				}else{
					echo 'Admin';
				} ?></td>
				<td><a href="" class="btn btn-success btn-xs btnedit" data-toggle="modal" title="">Edit</a>&nbsp
				<a href="proses_user.php?kode=3&id=<?php echo $data['id'];?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda Yakin.. ?');" title="">Delete</a></td>
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
        <h4 class="modal-title">Add user Barang</h4>
      </div>
      <div class="modal-body">
       
	     <form action="proses_user.php?kode=1&id=" method="POST" class="form" accept-charset="utf-8">
			
			<div class="form-group">
				<label> Username :</label>
				<input type="text" class="form-control" name="username" value="" placeholder="Username">
			</div>
			<div class="form-group">
				<label> Password :</label>
				<input type="password" class="form-control" name="password" value="" placeholder="Password">
			</div>
			<div class="form-group">
				<label> Level :</label>
				<select name="level" class="form-control">
					<option value="0">Admin</option>
					<option value="1">Gudang</option>
					<option value="2">Kasir</option>
				</select>
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
        <h4 class="modal-title">Add user Barang</h4>
      </div>
      <div class="modal-body">
       
	     <form action="proses_user.php?kode=2&id=" method="POST" class="form" accept-charset="utf-8">
			<input style="display: none;" type="text" name="id" id="id" value="">
			<div class="form-group">
				<label> Username :</label>
				<input type="text" class="form-control" name="username" value="" id="username" placeholder="Username">
			</div>
			<div class="form-group">
				<label> Password :</label>
				<input type="password" class="form-control" name="password" value="" id="password" placeholder="Password">
			</div>
			<div class="form-group" id="level">
				<label> Level :</label>
				<select name="level" class="form-control">
					<option value="0">Admin</option>
					<option value="1">Gudang</option>
					<option value="2">Kasir</option>
				</select>
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
        $('#tb_user').DataTable();
    });

$(".btnedit").click(function(){
  $('#edit').modal({
  	       	show : true,
        	backdrop : 'static',
        	keyboard : false,
  });
  $("#id").val($(this).closest('tr').children()[1].textContent);
  $("#username").val($(this).closest('tr').children()[2].textContent);
  $("#level").val($(this).closest('tr').children()[3].textContent);
});
</script>
