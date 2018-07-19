<h1>
	Rekap Transaksi
</h1><br>

<div class="row">
	<div class="col-md-12">
	<div class="row">
		<div class="col-md-6">
			<form action="home.php?link=rekap" method="POST" accept-charset="utf-8" class="form-horizontal">
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
	<table id="tb_tran" class="table table-hover">
				<thead>
					<tr class="bg-success">
						<th>No</th>
						<th>Id Trans</th>
						<th>Tgl Transaksi</th>
						<th style="width: 10px;">Total Jenis obat</th>
						<th style="width: 10px;">Total obat </th>
						<th style="width: 40%;">List obat </th>	
						<th>Total harga</th>
						<th>Laba Keuntungan</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				if (isset($tgl)) {
					$sql = " SELECT a.*,
								b.nm_obat, 
								b.hr_obat,
								b.satuan, 
								b.jm_obat,
								b.laba, 
								b.jum_obat
						FROM tb_transaksi a 
						LEFT JOIN (
							SELECT 
								z.id_trans, 
								SUM(z.jumlah) as jum_obat ,
							 	SUM(z.laba) as laba,
								GROUP_CONCAT(x.nama_obat) as nm_obat ,
								GROUP_CONCAT(x.harga_jual) as hr_obat ,
								GROUP_CONCAT(x.satuan) as satuan ,
								GROUP_CONCAT(z.jumlah) as jm_obat 
								FROM tb_transaksi_list z 
								LEFT JOIN  tb_obat x ON z.id_menu = x.id 
								GROUP BY z.id_trans
						) as b ON b.id_trans = a.id
						WHERE a.tgl_transaksi BETWEEN '$tgl[awal]' AND '$tgl[akhir]'
						ORDER BY a.id DESC";
				}else{

					 $sql =" SELECT 	a.*,
								b.nm_obat, 
								b.hr_obat,
								b.satuan, 
								b.jm_obat,
								b.laba, 
								b.jum_obat
						FROM tb_transaksi a 
						LEFT JOIN (
							SELECT 
								z.id_trans, 
								SUM(z.jumlah) as jum_obat ,
							 	SUM(z.laba) as laba,
								GROUP_CONCAT(x.nama_obat) as nm_obat ,
								GROUP_CONCAT(x.harga_jual) as hr_obat ,
								GROUP_CONCAT(x.satuan) as satuan ,
								GROUP_CONCAT(z.jumlah) as jm_obat 
								FROM tb_transaksi_list z 
								LEFT JOIN  tb_obat x ON z.id_menu = x.id 
								GROUP BY z.id_trans
						) as b ON b.id_trans = a.id
						ORDER BY a.id DESC";
				}
					if (isset($tgl)) {
				?>
					<h4 class="text-center">Rekap pada tanggal <?php echo $awal.' s/d '.$akhir; ?></h4>
				<?php
					}
					$no=1;
					$query = mysqli_query($conn,$sql);

					while ($tran = mysqli_fetch_array($query)) { 
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo 'TR-'.$tran['id']; ?></td>
						<td><?php echo date('d-M-Y H:i A', strtotime($tran['tgl_transaksi'])); ?></td>
						<td><?php echo $tran['jumlah_menu']; ?></td>
						<td><?php echo $tran['jum_obat']; ?></td>
						<td><table style="width: 100%;">
							<thead>
								<tr>
									<th width="40%">Nama</th>
									<th>satuan</th>
									<th>Harga</th>
									<th>Jumlah</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$nm = split(',', $tran['nm_obat']);
								$sz = split(',', $tran['satuan']);
								$hr = split(',', $tran['hr_obat']);
								$jm = split(',', $tran['jm_obat']);
							 for ($i=0; $i < count($jm) ; $i++) { 						
							 ?>

								<tr>
									<td><?php echo $nm[$i]; ?></td>
									<td><?php echo $sz[$i]; ?></td>
									<td>Rp.<?php echo number_format($hr[$i] ,0,',','.'); ?></td>
									<td><?php echo $jm[$i]; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						</td>
						<td>
							<table style="width: 100%;">
								<tr>
									<th>Belanja</th>
									<th>:</th>
									<td>Rp. <?php echo number_format($tran['total_harga'] ,0,',','.'); ?></td>
								</tr>
								<tr>
									<th>Bayar</th>
									<th>:</th>
									<td>Rp. <?php echo number_format($tran['bayar'] ,0,',','.'); ?></td>
								</tr>
								<tr>
									<th>Kembali</th>
									<th>:</th>
									<td>Rp. <?php echo number_format($tran['kembali'] ,0,',','.'); ?></td>
								</tr>
							</table>
						</td>
						<td>Rp. <?php echo number_format($tran['laba'] ,0,',','.'); ?></td>
					</tr>
				<?php 		
					}
				?>

				</tbody>
	</table>
			<div class="row">
				<div class="col-md-12">
				<?php if (isset($tgl)){ ?>
					<a href="print_rekap.php?awal=<?php echo $tgl['awal'] ?>&akhir=<?php echo $tgl['akhir'] ?>" target="_blank" class="btn btn-success" title="print">Print Rekap</a>
				<?php } ?>
				</div>
			</div>
	</div> <!-- col -->
</div>

<script type="text/javascript">
$(function(){
        $('#tb_tran').DataTable();
    });

$(function(){
	$('#date').daterangepicker({
		locale: {
            format: 'DD/MM/YYYY'
        }
	});
})
</script>