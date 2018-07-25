<h1>Form Penambahan Obat</h1>
<hr>

<div class="row">
	<div class="col-md-12">
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
	        <button type="submit" class="btn btn-primary">Tambah</button>
		</form>
	</div>
</div>

<script type="text/javascript">
	 $(function(){

        $('.exp').datetimepicker({

            format: 'DD-MM-YYYY'
        })
 });
</script>
