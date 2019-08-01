<h1>Rekap Permintaan barang</h1>

<div class="row">
	<div class="col-md-6">
		<form action="home.php?link=rekap_permintaan" method="POST" accept-charset="utf-8" class="form-horizontal">
	      <div class="form-group">
	      <label class="control-label col-sm-2" for="bulan"> Tanggal:</label>
	      <div class="col-sm-8">
	            <input class="form-control" type="text" id="date" name="tgl"  placeholder="Masukan range tanggal" required="">    
	      </div>
	      <div class="col-sm-2">
	      	<button type="submit" class="btn btn-info ">Search</button>
	      </div>
	      </div> 
	    </form>
	</div>
</div>
<?php 
	if (isset($_POST['tgl'])) {
		$ex = explode('-', $_POST['tgl']);
		$awal = str_replace('/', '-', $ex[0]);
		$akhir = str_replace('/', '-', $ex[1]);
		$tgl = array(
			'awal' 	=> date('Y-m-d', strtotime($awal)),
			'akhir'	=> date('Y-m-d', strtotime($akhir)),
		);
	}
 ?>
<div class="row">
	<div class="col-md-12">
		<table class="table" id="tb_">
	      	<caption>Daftar Permintaan</caption>
			<thead>
			<tr>
			  <th>No</th>
			  <th>Tanggal</th>
			  <th>Supplier</th>
			  <th>Nama barang</th>
			  <th>Jumlah</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$jumlah = 0;
			$no = 1;
			if (isset($tgl)) {
				$sql = "SELECT a.*, b.nama_supp, c.nama_barang, z.tgl FROM tb_permintaan_list a 
				LEFT JOIN tb_permintaan z ON a.id_per = z.id_per 
				LEFT JOIN tb_supplier b ON z.id_supp = b.id_supplier 
				LEFT JOIN tb_barang c ON a.id_barang = c.id
				WHERE z.tgl BETWEEN '$tgl[awal]' AND '$tgl[akhir]'";
			}else{
				$sql = "SELECT a.*, b.nama_supp, c.nama_barang, z.tgl FROM tb_permintaan_list a 
				LEFT JOIN tb_permintaan z ON a.id_per = z.id_per 
				LEFT JOIN tb_supplier b ON z.id_supp = b.id_supplier 
				LEFT JOIN tb_barang c ON a.id_barang = c.id";
			}

			$exe = mysqli_query($conn,$sql);
			while ($value =  mysqli_fetch_array($exe)) { ?>

			<tr>
			  <td><?php echo $no++; ?></td>
			  <td><?php echo date('d-m-Y', strtotime($value['tgl'])); ?></td>
			  <td><?php echo $value['nama_supp'] ?></td>
			  <td><?php echo $value['nama_barang'] ?></td>
			  <td><?php echo $value['jumlah'] ?></td>
			</tr>

			<?php $jumlah = $jumlah + $value['jumlah'];  } ?>
			<!-- <tr>
			  <td colspan="4" class="text-center">Jumlah Total</td>
			  <td><?php echo $jumlah; ?></td>
			</tr> -->
			</tbody>
		</table>
		<div class="row">
			<div class="col-md-12">
			<?php if (isset($tgl)){ ?>
			<a href="print_rekap_permintaan.php?awal=<?php echo $tgl['awal'] ?>&akhir=<?php echo $tgl['akhir'] ?>" target="_blank" class="btn btn-success" title="print">Print Rekap</a>
			<?php } ?>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
$(function(){
    $('#tb_').DataTable();
	$('#date').daterangepicker({
		locale: {
            format: 'DD/MM/YYYY'
        }
	});
})
</script>