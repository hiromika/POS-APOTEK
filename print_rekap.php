<!DOCTYPE html>
<html>
<head>
<?php 
include "koneksi.php";
 ?>
<title>Print</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/simple-sidebar.css">
  <!-- <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap.css"> -->
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">

  <script type="text/javascript" src="assets/js/jquery-2.2.3.min.js"></script>
  <script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
<style type="text/css">
		#ttd tbody tr td{
		border: none;
		}
		@media print{
			@page{margin: 0;}
			body{margin: 2cm;}
		}
</style>
</head>
<body onload="window.print(); history.back() " style="font-satuan: 20px;">
<div class="container">

<div class="row">
   <div class="col-md-12">
   <table class="table">
     <tr>
       <td style="width: 20% !important;">
        <img style="width: 100%; height: 30%;" src="assets/img/logo.jpg"> 
       </td>
       <td>
        <h3 class="text-center">Apotek Nusa Indah<br>
           <h5 class="text-center">Jln Dipati Ukur No 76 Kota Bandung</h5></h3> 
       </td>
       <td>
       </td>
     </tr>
        <?php 
        $awal   = $_GET['awal'];
        $akhir  = $_GET['akhir'];

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
            WHERE a.tgl_transaksi BETWEEN '$awal' AND '$akhir'
            ORDER BY a.id ASC";
        
        ?>
     <tr>
       <td colspan="3" class="text-center">  <h4 class="text-center">Rekap pada tanggal <?php echo date('d-M-Y',strtotime($awal)).' s/d '. date('d-M-Y',strtotime($akhir)); ?></h4></td>
       
     </tr>
   </table>
   </div>  
 </div>

  <h3 align="center"></h3>

    <table id="tb_tran" class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Tgl Transaksi</th>
            <th style="width: 10px;">Total Jenis obat</th>
            <th style="width: 10px;">Total obat </th>
            <th align="center" style="width: 40%;">List obat </th>
            <th>Total harga</th>
            <th>Laba Keuntungan</th>
          </tr>
        </thead>
        <tbody>
        
        <?php
          $no=1;
          $query = mysqli_query($conn,$sql);
          $totlaba = 0;
          $totpen = 0;
          while ($tran = mysqli_fetch_array($query)) { 
        ?>
          <tr>
            <td><?php echo $no++; ?></td>
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

                <tr class="text-center">
                  <td><?php echo $nm[$i]; ?></td>
                  <td><?php echo $sz[$i]; ?></td>
                  <td>Rp.<?php echo number_format($hr[$i] ,0,',','.'); ?></td>
                  <td><?php echo $jm[$i]; ?></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            </td>
            <td>Rp. <?php echo number_format($tran['total_harga'] ,0,',','.'); ?></td>
            <td>Rp. <?php echo number_format($tran['laba'] ,0,',','.'); ?></td>
          </tr>
        <?php 
          $totlaba = $totlaba + $tran['total_harga'];
          $totpen =  $totpen + $tran['laba'];
          }
        ?>
          <tr>
              <td colspan="5">Total : </td>
              <td>Rp.<?php echo number_format($totlaba ,0,',','.');  ?></td>
              <td>Rp.<?php echo number_format($totpen ,0,',','.');  ?></td>
          </tr>
        </tbody>
  </table>
</div>
<script type="text/javascript" src="assets/js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
</body>
</html>