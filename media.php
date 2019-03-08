<?php
session_start();
// Apabila user belum login
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  header('location:index.php?log=1');;  
}
// Apabila user sudah login dengan benar, maka terbentuklah session
else{
include "config/koneksi.php";
include "config/library.php";
include "config/fungsi_indotgl.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi SPPD</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="theme/bootstrap/css/bootstrap.min.css">
	<!-- Detepicker -->
    <link rel="stylesheet" href="theme/plugins/datepicker/datepicker3.css">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="theme/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="theme/dist/css/skins/_all-skins.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="theme/plugins/datatables/dataTables.bootstrap.css">
    <!-sppd-->
  <link href="css/style_properti.css" rel="stylesheet" type="text/css" />
  <link rel="shortcut icon" href="../favicon.png"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
<!--
.style1 {color: #FFFFFF}
-->
    </style>

<link href="css/pikaday.css" rel="stylesheet" type="text/css" />
<script src="js/moment.js"></script>
<script src="js/moment-id.js"></script>
<script src="js/pikaday.js"></script>

</head>
  <!-- ADD THE CLASS layout-boxed TO GET A BOXED LAYOUT -->
<body class="hold-transition skin-purple-light sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
<header class="main-header">
        <p>
          <!-- Logo --><!-- Header Navbar: style can be found in header.less -->
        <img src="logodp3ap2kb.jpg" width="1350" height="83"></p>
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

          
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo "$_SESSION[namauser]"; ?></span>                </a>
                <ul class="dropdown-menu">
                  <!-- Menu Body -->
                  <li class="user-body">
                    <?php
                      echo "
                        <p align=right>Login : $hari_ini, ";
                        echo tgl_indo(date("Y m d")); 
                        echo " | "; 
                        echo date("H:i:s");
                        echo " WIB</p>";
                    ?>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat" onClick="return confirm('Anda Yakin Ingin Keluar')">Sign out</a>                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>              </li>
            </ul>
          </div>
        </nav>
</header>

      <p>
        <!-- =============================================== -->
        
        <!-- Left side column. contains the sidebar -->
        <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
</p>
      <p>&nbsp;</p>
      <p> 
        <!-- sidebar menu: : style can be found in sidebar.less -->
            <?php
       if ($_SESSION['level']=="operator"){
      ?>
</p>
      <ul class="sidebar-menu">
<li>
              <a href="?module=home">
                <i class="fa fa-dashboard"></i> <span>Home</span> 
              </a>
  </li>
              <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Menu Pegawai</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=pegawai"><i class="fa fa-circle-o"></i>Data Pegawai</a></li>
                <li><a href="?module=pangkat"><i class="fa fa-circle-o"></i>Pangkat</a></li>
                <li><a href="?module=jabatan"><i class="fa fa-circle-o"></i>Jabatan</a></li>
                <li><a href="?module=tujuan"><i class="fa fa-circle-o"></i>Tujuan</a></li>
                <li><a href="?module=transportasi"><i class="fa fa-circle-o"></i>Transportasi</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Biaya Perjalanan Dinas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=biaya"><i class="fa fa-circle-o"></i>Biaya Perjalanan Dinas</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>NPPD</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=nppt"><i class="fa fa-circle-o"></i>NPPD</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>SPT</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=spt"><i class="fa fa-circle-o"></i>SPT</a></li>
              </ul>
            </li><li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>SPPD</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=sppd"><i class="fa fa-circle-o"></i>SPPD</a></li>
              </ul>
            </li><li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Kwitansi</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=kwitansi"><i class="fa fa-circle-o"></i>Kwitansi</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Laporan Perjalanan Dinas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=lpd"><i class="fa fa-circle-o"></i>Lapoeran Perjalanan Dinas</a></li>
              </ul>
            </li>
         
            <!--<li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Menu Laporan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=kwitansi"><i class="fa fa-circle-o"></i> Laporan Kwitansi</a></li>
                <li><a href="?module=lpd"><i class="fa fa-circle-o"></i> Laporan Perjalanan Dinas</a></li>
              </ul>---->
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Pengaturan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=ttdkwitansi"><i class="fa fa-circle-o"></i>TTD Kwitansi</a></li>
                <li><a href="?module=password"><i class="fa fa-circle-o"></i>Email & Password</a></li>
              </ul>
            </li>
            <li><a href="logout.php" onClick="return confirm('Anda Yakin Ingin Keluar')"><i class="fa fa-book"></i> <span>Logout</span></a></li>
</ul>
          <?php }elseif($_SESSION['level']=="kabag") { ?>
          
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <ul class="sidebar-menu">
            <li>
              <a href="?module=home">
                <i class="fa fa-dashboard"></i> <span>Home</span> 
              </a>
              </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>NPPD</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=nppt"><i class="fa fa-circle-o"></i> NPPD</a></li>
                
                <!--<li><a href="?module=kwitansi"><i class="fa fa-circle-o"></i> Kwintasi</a></li>--->
                <!--<li><a href="?module=lpd"><i class="fa fa-circle-o"></i> Laporan Perjalanan Dinas</a></li>---->
               <!-- <li><a href="?module=tbk"><i class="fa fa-circle-o"></i> TBK</a></li> Sengaja di non aktifkan modul TBK-->
                <!--<li><a href="?module=password"><i class="fa fa-circle-o"></i> Password</a></li>--->
                <!--<li><a href="logout.php" onClick="return confirm('Anda Yakin Ingin Keluar')"><i class="fa fa-circle-o"></i> Logout</a></li>-->
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Kwitansi</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=kwitansi"><i class="fa fa-circle-o"></i>Kwitansi</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Laporan Perjalanan Dinas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=lpd"><i class="fa fa-circle-o"></i>Lapoeran Perjalanan Dinas</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Pengaturan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=password"><i class="fa fa-circle-o"></i>Email & Password</a></li>
              </ul>
            </li>
            <li><a href="logout.php" onClick="return confirm('Anda Yakin Ingin Keluar')"><i class="fa fa-book"></i> <span>Logout</span></a></li>
          </ul>
          <?php }else{ ?>
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <ul class="sidebar-menu">
            <li>
              <a href="?module=home">
                <i class="fa fa-dashboard"></i> <span>Home</span> 
              </a>
              </li>
            <!--<li class="treeview active">
              <a href="#">
                <i class="fa fa-pie-chart"></i>
                <span>Menu SPPD</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=spt"><i class="fa fa-circle-o"></i> SPT</a></li>
                <li><a href="?module=lpd"><i class="fa fa-circle-o"></i> Laporan Perjalanan Dinas</a></li>
                <!---- <li><a href="?module=password"><i class="fa fa-circle-o"></i> Password</a></li> ------>
                <!--<li><a href="logout.php" onClick="return confirm('Anda Yakin Ingin Keluar')"><i class="fa fa-circle-o"></i> Logout</a></li>
              </ul>---->
              <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Input Laporan</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=spt"><i class="fa fa-circle-o"></i>SPT</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-share"></i> <span>Laporan Perjalanan Dinas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?module=lpd"><i class="fa fa-circle-o"></i>Laporan Perjalanan Dinas</a></li>
              </ul>
            </li>
               <li><a href="logout.php" onClick="return confirm('Anda Yakin Ingin Keluar')"><i class="fa fa-book"></i> <span>Logout</span></a></li>
            </ul>
            <?php } ?>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="background-image: url(kantor1.jpg)">
        <!-- Main content -->
        <section class="content style1";>
          <p><?php include "content.php"; ?>
          </p>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs"></div>
        <strong>Copyright &copy; 2018 Satria Budi Permata</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">

          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
        <!-- ./wrapper -->

        <!-- jQuery 2.1.4 -->
        <script src="theme/plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.5 -->
        <script src="theme/bootstrap/js/bootstrap.min.js"></script>
        <!-- SlimScroll -->
        <script src="theme/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	    <!-- Detepicker -->
        <script src="theme/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- FastClick -->
        <script src="theme/plugins/fastclick/fastclick.min.js"></script>
        <!-- AdminLTE App -->
        <script src="theme/dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="theme/dist/js/demo.js"></script>
        \
        <!-- DataTables -->
        <script src="theme/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="theme/plugins/datatables/dataTables.bootstrap.min.js"></script>
        <!-- page script -->
</div>
<script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
        </script>
</body>
</html>
<?php } ?>