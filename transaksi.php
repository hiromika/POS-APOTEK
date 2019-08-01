
<h1>Transaksi</h1>

<?php 
  $que = mysqli_query($conn,"SELECT * FROM tb_jenis"); ?>

<ul class="nav nav-tabs">
<?php while ($jenis = mysqli_fetch_array($que)) { ?>
  <li class=""><a data-toggle="tab" href="#set<?php echo $jenis['id']; ?>"><?php echo $jenis['nama_jenis']; ?></a></li>
<?php 
  }
 ?>
</ul>

<div class="tab-content">
<?php 
   $idt = $_GET['idt'];
   $que = mysqli_query($conn,"SELECT * FROM tb_jenis");
  while ($jenis = mysqli_fetch_array($que)) {
?>
    <div id="set<?php echo $jenis['id']; ?>" class="tab-pane fade in active">
      <h3><?php echo $jenis['nama_jenis']; ?></h3>
      <table class="table table-responsive" id="tb_makanan" style="width: 100% !important;">
        <thead>
          <tr class="bg-info">
            <th>No</th>
            <th style="display: none;">id</th>
            <th>Kode barang</th>
            <th>Nama barang</th>
            <th>Satuan</th>
            <th style="display: none;">idj</th>
            <th>Jenis</th>
            <th>Keterangan</th>
            <th>Harga</th>
            <th>Stock</th>
            <th style="width: 10%;">Jumlah</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php 
          $no = 1;
          $sql = "SELECT *, a.id as idb, b.id as idj FROM tb_barang a 
          LEFT JOIN tb_jenis b ON a.jenis = b.id 
          WHERE a.jenis = '$jenis[id]'";
          $query  = mysqli_query($conn,$sql);
          while ($data = mysqli_fetch_array($query)) { ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td style="display: none;"><?php echo $data['idb']; ?></td>
            <td><?php echo $data['kode_barang'] ?></td>
            <td><?php echo $data['nama_barang'] ?></td>
            <td><?php echo $data['satuan'] ?></td>
            <td style="display: none;"><?php echo $data['jenis'] ?></td>
            <td><?php echo $data['nama_jenis'] ?></td>
            <td><?php echo $data['keterangan'] ?></td>
            <td>Rp.<?php echo  number_format($data['harga_jual'],0,',','.'); ?></td>
            <td><?php echo $data['stock'] ?></td>
            <td>
            <?php 
            if ($idt > 0) { ?>
            <form action="proses_trans.php?kode=1&idt=<?php echo $idt ?>" method="POST" accept-charset="utf-8" class="form">
              <?php  }else{ ?>
            <form action="proses_trans.php?kode=1&idt=0" method="POST" accept-charset="utf-8" class="form">
            <?php  }  ?>
            <input style="display: none;" type="text" name="idb" value="<?php echo $data['idb']; ?>">
            <input style="display: none;" type="text" name="harga_jual" value="<?php echo $data['harga_jual']; ?>">
            <input style="display: none;" type="text" name="harga_modal" value="<?php echo $data['harga_modal']; ?>">
            <input style="max-height: 25px !important;" required="" onkeyup="if($(this).val() > <?php echo $data['stock'] ?>){alert('Angka Yang Anda Masukan Salah..!'); $('.pilih').attr('disabled', 'disabled')}else{$('.pilih').removeAttr('disabled')}" type="number" max="<?php echo $data['stock'] ?>" name="jumlah" class="form-control jumlah" placeholder="Jumlah">
            </td>
            <td><button type="<?php echo ($data['stock']==0)?"button":'submit'; ?>"  class="pilih btn btn-warning btn-xs <?php echo ($data['stock']==0)?"disabled":''; ?>">Pilih</button></form></td>
          </tr>

        <?php 
          }
         ?>
        </tbody>
      </table>
    </div>
<?php } ?>
  </div>

  <!-- end Jenis -->
<hr>

  <h3>Transaksi</h3>

  <table class="table">
    <thead>
      <tr>
        <th>Nama barang</th>
        <th>Satuan</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Total</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    <?php
        if ($idt > 0) { 
       
        $sql2    = "SELECT *,a.id as idts FROM tb_transaksi_list a LEFT JOIN tb_barang b ON a.id_menu=b.id  WHERE a.id_trans = '$idt'";
        $query2  = mysqli_query($conn,$sql2); 

        while ($data = mysqli_fetch_array($query2)) {
    ?>
      <tr>
        <td><?php echo $data['nama_barang']; ?></td>
        <td><?php echo $data['satuan']; ?></td>
        <td>Rp.<?php echo number_format($data['harga_jual'],0,',','.'); ?></td>
        <td><?php echo $data['jumlah']; ?></td>
        <td>Rp.<?php echo number_format($data['harga_total'],0,',','.'); ?></td>
        <td><a href="proses_trans.php?kode=2&idt=<?php echo $idt ?>&idts=<?php echo $data['idts'];?>" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda Yakin.. ?');" title="">Delete</a></td>
      </tr>
    <?php } 
        $sql    = "SELECT a.*, SUM(b.jumlah) as totjum FROM tb_transaksi a LEFT JOIN tb_transaksi_list b ON a.id = b.id_trans WHERE a.id = '$idt'";
        $query  = mysqli_query($conn,$sql);
        $tot    = mysqli_fetch_assoc($query);?>
      <tr>
        <th colspan="3" class="text-center">Jumlah Total :</th>
        <th colspan="" class=""><?php echo $tot['totjum'] ?></th>
        <td colspan="2"><big><b>Rp.<?php echo number_format($tot['total_harga'],0,',','.'); ?></b></big></td>
        <input type="hidden" class="tot" name="total" value="<?php echo $tot['total_harga']; ?>" placeholder="">
      </tr>
      <tr>
        <th colspan="4" class="text-center">Nama Konsumen :</th>
        <td colspan="">
          <div class="form-group">
            <input type="text" name="konsumen" value="" id="konsumen" step="100" require="" placeholder="" class="form-control"></td>
          </div>
        <td></td>
      </tr>
      <tr>
        <th colspan="4" class="text-center">Uang Pembayaran :</th>
        <td colspan="">
          <div class="input-group">
            <span class="input-group-addon">Rp.</span>
            <input type="number" name="bayar" value="" id="bayar" step="100" require="" placeholder="" class="bayar form-control"></td>
          </div>
        <td></td>
      </tr>
      <tr>
        <th colspan="4" class="text-center">Uang Kembali :</th>
        <td colspan="" id="kembali">
          <div class="input-group">
            <span class="input-group-addon">Rp</span>
            <input type="text" disabled class="kembali form-control" name="kembali" value="" placeholder=""></td>
          </div>
        <td></td>
      </tr>
      <tr>
        <td colspan="5">
        <a href="proses_trans.php?kode=3&idt=<?php echo $idt; ?>&del=1" class="btn btn-sm btn-warning pull-right">Cencel</a>
        <a href="javascript:void(0)" style="margin-right: 10px;" class="print btn btn-sm btn-info pull-right">Print</a>
        <a href="javascript:void(0)" style="margin-right: 10px;" class="done btn btn-sm btn-success pull-right">Done</a>
        </td>
      </tr>
      <?php }else{ ?>
      <tr>
        <td colspan="5" class="text-center">No Data</td>
      </tr>
    <?php } ?>
      
    </tbody>
  </table>
<!-- home.php?link=transaksi&idt=0 -->
<!-- print_trans.php?idt=<?php echo $idt; ?> -->
<script type="text/javascript">

  $('.bayar').keyup(function(e) {
      var kembali = $('.bayar').val() - $('.tot').val();
      $('.kembali').val(kembali);
      // $('#kembali').html('Rp.'+kembali);
      // if ($('.bayar').val() < $('.tot').val()){
      //   $('.print , .done').attr('disabled', 'disabled');
      // }
      // if($('.bayar').val() >= $('.tot').val()){
      //   $('.print , .done').removeAttr('disabled');
      // }    
  });

  $('.print').on('click', function(event) {
    event.preventDefault(); 
    if($('#konsumen').val() != "" || $('#bayar').val() != ""){
      var bayar = $('.bayar').val();
      var konsumen =$('#konsumen').val();
      var kembali = $('.bayar').val() - $('.tot').val();
      $(location).attr('href', 'print_trans.php?idt=<?php echo $idt; ?>&bayar='+bayar+'&kembali='+kembali+'&konsumen='+konsumen);
    }else{
        alert('Data Belum Lengkap.!');
    }
  }); 

  $('.done').on('click', function(event) {
    event.preventDefault();
    if($('#konsumen').val() != "" || $('#bayar').val() != ""){
      if (confirm('Transaksi Selesai.. ?')){
        var konsumen =$('#konsumen').val();
        var bayar = $('.bayar').val();
        var kembali = $('.bayar').val() - $('.tot').val();
        $(location).attr('href', 'proses_trans.php?kode=4&idt=<?php echo $idt; ?>&bayar='+bayar+'&kembali='+kembali+'&konsumen='+konsumen);
      }
    }else{
        alert('Data Belum Lengkap.!');
    }
  });

  $(document).ready(function(){
    $("ul.nav-tabs a,ul.nav-pills a").click(function (e) {
      e.preventDefault();  
        $(this).tab('show');
    });
    
    activaTab('aaa');
    
    $('#tb_makanan,#tb_minuman').DataTable();
  })

  function activaTab(tab){
      $('.nav-tabs a[href="#set1"]').tab('show');
  };
  </script>