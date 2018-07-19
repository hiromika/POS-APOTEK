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
        ?>
     <tr>
       <td colspan="3" class="text-center">  <h4 class="text-center">Rekap pada tanggal <?php echo date('d-M-Y',strtotime($awal)).' s/d '. date('d-M-Y',strtotime($akhir)); ?></h4></td>
       
     </tr>
   </table>
   </div>  
 </div>

  <h3 align="center"></h3>
  <table class="table" id="tb_">
          <caption>Daftar Permintaan</caption>
      <thead>
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Supplier</th>
        <th>Nama obat</th>
        <th>Jumlah</th>
      </tr>
      </thead>
      <tbody>
      <?php
      $jumlah = 0;
      $no = 1;
      if (isset($tgl)) {
        $sql = "SELECT a.*, b.nama_supp, c.nama_obat, z.tgl FROM tb_permintaan_list a 
        LEFT JOIN tb_permintaan z ON a.id_per = z.id_per 
        LEFT JOIN tb_supplier b ON z.id_supp = b.id_supplier 
        LEFT JOIN tb_obat c ON a.id_obat = c.id
        WHERE z.tgl BETWEEN '$awal' AND '$akhir'";
      }else{
        $sql = "SELECT a.*, b.nama_supp, c.nama_obat, z.tgl FROM tb_permintaan_list a 
        LEFT JOIN tb_permintaan z ON a.id_per = z.id_per 
        LEFT JOIN tb_supplier b ON z.id_supp = b.id_supplier 
        LEFT JOIN tb_obat c ON a.id_obat = c.id";
      }

      $exe = mysqli_query($conn,$sql);
      while ($value =  mysqli_fetch_array($exe)) { ?>

      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo date('d-m-Y', strtotime($value['tgl'])); ?></td>
        <td><?php echo $value['nama_supp'] ?></td>
        <td><?php echo $value['nama_obat'] ?></td>
        <td><?php echo $value['jumlah'] ?></td>
      </tr>

      <?php $jumlah = $jumlah + $value['jumlah'];  } ?>
      <tr>
        <td colspan="4" class="text-center">Jumlah Total</td>
        <td><?php echo $jumlah; ?></td>
      </tr>
      </tbody>
    </table>

</div>
<script type="text/javascript" src="assets/js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
</body>
</html>