<?php
include "koneksi.php";
session_start();
if (isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html lang="">
<head>
  <title>APOTEK NUSA INDAH</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/simple-sidebar.css">
  <!-- <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap.css"> -->
  <link rel="stylesheet" type="text/css" href="assets/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="assets/css/daterangepicker.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">

  <script type="text/javascript" src="assets/js/jquery-2.2.3.min.js"></script>
  <script type="text/javascript" src="assets/js/moment.js"></script>
  <script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
  <script type="text/javascript" src="assets/js/daterangepicker.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>

  <style type="text/css" media="screen">
    .modal-backdrop {
    z-index: -1 !important;
    }
  </style>
</head>
<body>   
    <div id="wrapper" class="toggled">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="home.php?link=0">
                        Dashboard
                    </a>
                </li>
                <?php if ($_SESSION['level'] == 1) { ?>
                  <li>
                      <a href="home.php?link=master_supp">Master Supplier</a>
                  </li>
                  <li>
                      <a href="home.php?link=master_obat">Master Obat</a>
                  </li>
                  <li>
                      <a href="home.php?link=jenis_obat">Master Jenis Obat</a>
                  </li> 
                  <li>
                      <a href="home.php?link=permintaan&id_per=0">Form Permintaan Obat</a>
                  </li>
                  <li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false">Laporan</a>
                    <ul class="nav collapse" id="submenu1" role="menu" aria-labelledby="btn-1">
                      <li><a href="home.php?link=rekap_permintaan" >Laporan Permintaan Obat</a></li>
                    </ul>
                  </li>
                  <li>
                      <a href="logout.php">Logout</a>
                  </li>
                <?php 
                }else if ($_SESSION['level'] == 2) { ?>
                   <li>
                      <a href="home.php?link=transaksi&idt=0">Penjualan</a>
                  </li>
                     <li>
                      <a href="home.php?link=rekap">Laporan Penjualan Obat</a>
                  </li>
                    <li>
                      <a href="logout.php">Logout</a>
                  </li>
                <?php 
                }else{ ?>
                  <li>
                      <a href="home.php?link=transaksi&idt=0">Penjualan</a>
                  </li>
                  <li>
                      <a href="home.php?link=master_supp">Master Supplier</a>
                  </li>
                  <li>
                      <a href="home.php?link=master_obat">Master Obat</a>
                  </li>
                  <li>
                      <a href="home.php?link=jenis_obat">Master Jenis Obat</a>
                  </li>
                  <li>
                      <a href="home.php?link=men_user">Manajemen pengguna</a>
                  </li>
                  <li>
                      <a href="home.php?link=permintaan&id_per=0">Form Permintaan Obat</a>
                  </li> 
                  <li>
                      <a href="home.php?link=tambah_obat">Form Penambahan Obat</a>
                  </li> 
                  <li><a href="#" id="btn-1" data-toggle="collapse" data-target="#submenu1" aria-expanded="false">Laporan</a>
                    <ul class="nav collapse" id="submenu1" role="menu" aria-labelledby="btn-1">
                      <li><a href="home.php?link=rekap" >Laporan Penjualan Obat</a></li>
                      <li><a href="home.php?link=rekap_permintaan" >Laporan Permintaan Obat</a></li>
                    </ul>
                  </li>
                  <li>
                      <a href="logout.php">Logout</a>
                  </li>

                <?php
                } ?>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper" style="padding-top: 0px !important;">
            <!-- header -->
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-1">
                <h2>
                  <a href="#menu-toggle" class="btn btn-primary btn-sm" id="menu-toggle">Menu</a> 
                </h2>
                </div> 
                <div class="col-md-11">
                  <h2>Apotek Nusa Indah <p class="pull-right" style="font-size: 16px !important;"><?php echo $_SESSION['username']; ?></p><h2><hr style="margin: 0px !important;">
                  <h5>Jln Dipati Ukur No 76 Kota Bandung</h5>
                </div>
              </div>
            </div>
            <!-- end header -->
            <!-- content -->
            <div class="row">
            <div class="col-md-12">
              
              <?php 
              $link = $_GET['link'];
              switch ($link) {
                case 'master_obat':
                  include "master_obat.php";
                  break; 
                case 'transaksi':
                  include "transaksi.php";
                  break;
                case 'rekap':
                  include "rekap.php";
                  break;
                case 'jenis_obat':
                  include "jenis_obat.php";
                  break;  
                case 'master_supp':
                  include "master_supp.php";
                  break; 
                case 'master_obat_view':
                  include "master_obat_detail.php";
                  break;
                case 'men_user':
                  include "master_user.php";
                  break; 
                case 'permintaan':
                  include "permintaan.php";
                  break;
                case 'tambah_obat':
                  include "tambah_obat.php";
                  break; 
                case 'rekap_permintaan':
                  include "rekap_permintaan.php";
                  break;
                default:
                  include "dashboard.php";
                  break;
              }

               ?>
            </div>
            </div>
            <!-- end content -->
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="assets/js/jquery-2.2.3.min.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="assets/js/dataTables.bootstrap.js"></script>
  <script type="text/javascript" src="assets/js/daterangepicker.js"></script>
  <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript" src="assets/js/moment.js"></script>


<script>
$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});
</script>
<footer>
  
</footer>
</body>
</html>
<?php 
}else{
  header('location: index.php');
}
?>

