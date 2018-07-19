<!DOCTYPE html>
<html>
<head>
<?php 
include "koneksi.php";
  $idt = $_GET['idt'];
  $sql3   = "UPDATE tb_transaksi SET bayar='$_GET[bayar]', kembali = '$_GET[kembali]' WHERE id = '$idt'";
  $query3 = mysqli_query($conn,$sql3);        
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
<body onload="window.print(); history.back()  " style="font-size: 20px;">
<div class="container">
  
<?php  
    $que = "SELECT * FROM tb_transaksi WHERE id = '$idt'";
    $sql = mysqli_query($conn,$que);
    $trans = mysqli_fetch_assoc($sql);
 ?>
 <div class="row">
   <div class="col-md-12">
   <table class="table">
     <tr>
       <td style="width: 30% !important;">
        <img style="width: 50%; height: 30%;" src="assets/img/logo.jpg"> 
       </td>
       <td>
        <h3 class="text-center">Apotek Nusa Indah<br>
           <h5 class="text-center">Jln Dipati Ukur No 76 Kota Bandung</h5></h3> 
       </td>
       <td>
       </td>
     </tr>
     <tr>
       <td>
          <h5>TR-<?php echo $trans['id'] ?></h5>
       </td>
       <td class="text-center">Transaksi</td>
       <td><h5 class='pull-right'><?php  echo date('d-m-Y',strtotime($trans['tgl_transaksi'])); ?></h5></td>
     </tr>
   </table>
   </div>  
 </div>


  <table class="table table-responsive table-bordered">
    <thead>
      <tr>
        <th>Nama barang</th>
        <th>Harga</th>
        <th>Satuan</th>
        <th>Jumlah</th>
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
    <?php
        if ($idt > 0) { 
       
        $sql2    = "SELECT *,a.id as idts FROM tb_transaksi_list a LEFT JOIN tb_obat b ON a.id_menu=b.id  WHERE a.id_trans = '$idt'";
        $query2  = mysqli_query($conn,$sql2); 

        while ($data = mysqli_fetch_array($query2)) {
       
    ?>
      <tr>
        <td><?php echo $data['nama_obat']; ?></td>
        <td><?php echo number_format($data['harga_jual'],0,',','.'); ?></td>
        <td><?php echo $data['satuan']; ?></td>
        <td><?php echo $data['jumlah']; ?></td>
        <td><?php echo number_format($data['harga_total'],0,',','.'); ?></td>
      </tr>
    <?php } 
        $sql    = "SELECT a.*, SUM(b.jumlah) as totjum FROM tb_transaksi a LEFT JOIN tb_transaksi_list b ON a.id = b.id_trans WHERE a.id = '$idt'";
        $query  = mysqli_query($conn,$sql);
        $tot    = mysqli_fetch_assoc($query);?>
      <tr>
        <th colspan="3" class="text-center">Jumlah Total :</th>
        <th colspan="" class=""><?php echo $tot['totjum'] ?></th>
        <td colspan=""><big><b>Rp.<?php echo number_format($tot['total_harga'],0,',','.'); ?></b></big></td>
      </tr> 
      <tr>
        <th colspan="4" class="text-center">Uang Pembayaran :</th>
        <td colspan=""><big><b>Rp.<?php echo number_format($tot['bayar'],0,',','.'); ?></b></big></td>
      </tr> 
      <tr>
        <th colspan="4" class="text-center">Uang Kembali :</th>
        <td colspan=""><big><b>Rp.<?php echo number_format($tot['kembali'],0,',','.'); ?></b></big></td>
      </tr>
      
      <?php }?>    
    </tbody>
  </table>

</div>
<script type="text/javascript" src="assets/js/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
</body>
</html>