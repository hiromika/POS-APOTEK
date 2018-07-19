<?php $id_per = $_GET['id_per']; ?>
<h1>Form Permintaan Obat</h1>
<div class="col-md-6">
	<form action="proses_permintaan.php" method="POST" accept-charset="utf-8">
		<input type="hidden" name="id_per" value="<?php echo $id_per; ?>" placeholder="">
		<div class="form-group">
			<label for="">Tanggal</label>
			<input type="text" class="form-control" id="tgl" name="tgl" value="<?php echo date('d-m-Y') ?>" placeholder="">
		</div>
		<div class="form-group">
			<label for="">Supplier</label>
			<select name="sup" class="form-control">
				<option value="">~ Pilih supplier ~</option>
				<?php $qsup = "SELECT * FROM tb_supplier";
				$exs = mysqli_query($conn, $qsup);
				while ($supp = mysqli_fetch_array($exs)) { ?>
					<option value="<?php echo $supp['id_supplier'] ?>"><?php echo $supp['nama_supp'] ?></option>
				<?php }
				 ?>
			</select>
		</div>
		<div class="form-group">
			<label for="">Obat</label>
			<select name="obat" class="form-control">
				<option value="">~ Pilih Obat ~</option>
				<?php $qob = "SELECT * FROM tb_obat";
				$exo = mysqli_query($conn, $qob);
				while ($ob = mysqli_fetch_array($exo)) { ?>
					<option value="<?php echo $ob['id'] ?>"><?php echo $ob['nama_obat'] ?></option>
				<?php }
				 ?>
			</select>
		</div>
		<div class="form-group">
			<label for="">Jumlah</label>
			<input type="number" class="form-control" name="jml" value="" placeholder="">
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-md btn-success pull-right">Tambah</button>
		</div>

	</form>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table" id="tb_">
			<caption>Daftar Permintaan</caption>
			<thead>
				<tr>
					<th>No</th>
					<th>Supplier</th>
					<th>Nama obat</th>
					<th>Jumlah</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
			<?php
			$no = 1;
			$sql = "SELECT a.*, b.nama_supp, c.nama_obat FROM tb_permintaan_list a 
			LEFT JOIN tb_permintaan z ON a.id_per = z.id_per 
			LEFT JOIN tb_supplier b ON z.id_supp = b.id_supplier 
			LEFT JOIN tb_obat c ON a.id_obat = c.id
			WHERE a.id_per = '$id_per'";
			$exe = mysqli_query($conn,$sql);
			while ($value =  mysqli_fetch_array($exe)) { ?>
			 	
				<tr>
					<td><?php echo $no++; ?></td>
					<td><?php echo $value['nama_supp'] ?></td>
					<td><?php echo $value['nama_obat'] ?></td>
					<td><?php echo $value['jumlah'] ?></td>
					<td><a href="" title="" class="btn btn-sm btn-danger">Delete</a></td>
				</tr>

			<?php } ?>

			</tbody>
		</table>
	</div>
</div>

<hr>
<?php if ($id_per != 0): ?>
	<a href="print_permintaan.php?id_per=<?php echo $id_per; ?>" title="print" class="btn btn-info">Print</a>
	<a href="home.php?link=permintaan&id_per=0" title="print" class="btn btn-warning" onclick="return confirm('Yakin menyelesaikan.. ?')">Selesai</a>	
<?php endif ?>

<script type="text/javascript">
$(document).ready(function() {
	 $('#tb_').DataTable();
	 $('#tgl').datetimepicker({
            format: 'DD-MM-YYYY',
        })
});
	
</script>