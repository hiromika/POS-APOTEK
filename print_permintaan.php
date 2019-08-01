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
<body onload="window.print();  " style="font-size: 20px;">
  <?php $id_per = $_GET['id_per']; ?>
<div class="container">
 <div class="row">
   <div class="col-md-12">
   <table class="table">
     <tr>
       <td style="width: 20% !important;">
        <img style="width: 100px; height: 100px;" src="assets/img/logo.png"> 
       </td>
       <td>
        <h3 class="text-center">CV Gunung Mas Sejahtera<br>
           <h5 class="text-center">Jl. Batu Ceper Raya No. 5 D Jakarta Pusat</h5></h3> 
       </td>
       <td>
       </td>
     </tr>
     <tr>
       <td>
          
       </td>
       <td class="text-center">Daftar Permintaan Barang</td>
       <td></td>
     </tr>
   </table>
   </div>  
 </div>

  <table class="table" id="tb_">
      <caption>Daftar Permintaan</caption>
      <p>Dengan Hormat</p>
      <p>Menginat persediaan barang kami yang semakin menipis, maka kami bermaksud untuk memesan barang sebagai berikut.</p>
      <thead>
        <tr>
          <th>No</th>
          <th>Supplier</th>
          <th>Nama barang</th>
          <th>Jumlah</th>
        </tr>
      </thead>
      <tbody>
      <?php
      $jumlah = 0;
      $no = 1;
      $sql = "SELECT a.*, b.nama_supp, c.nama_barang FROM tb_permintaan_list a 
      LEFT JOIN tb_permintaan z ON a.id_per = z.id_per 
      LEFT JOIN tb_supplier b ON z.id_supp = b.id_supplier 
      LEFT JOIN tb_barang c ON a.id_barang = c.id
      WHERE a.id_per = '$id_per'";
      $exe = mysqli_query($conn,$sql);
      while ($value =  mysqli_fetch_array($exe)) { ?>
        
        <tr>
          <td><?php echo $no++; ?></td>
          <td><?php echo $value['nama_supp'] ?></td>
          <td><?php echo $value['nama_barang'] ?></td>
          <td><?php echo $value['jumlah'] ?></td>
        </tr>

      <?php $jumlah = $jumlah + $value['jumlah'];  } ?>
        <tr>
          <td colspan="3">Jumlah Total</td>
          <td><?php echo $jumlah; ?></td>
        </tr>
      </tbody>
    </table>
    <p>Barang-barang yang kami pesan diatas kami harap dapat segera dikirim selambat-lambatnya akan kami terima 4 hari setelah surat ini diterima. </p>
    <div class="pull-right">
        <p>Hormat kami :</p>
        <p>PT GUNUNG MAS SEJAHTERA</p>
        <br>
        <br>
        <br>
        <br>
        <p>Kepala Gudang</p>
    </div>
</div>
<script type="text/javascript" src="assets/js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
</body>
</html>