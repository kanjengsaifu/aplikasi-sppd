<?php
ob_start();
error_reporting(0);
$mod = $_GET['module'];

// Bagian Home
if ($mod=='home'){
  echo "<div class=\"callout callout-info\"><h4>Selamat Datang</h4>
          <p>Hai <b>$_SESSION[namauser]</b>, selamat datang di halaman Administrator.<br> Silahkan klik menu pilihan yang berada dikiri untuk mengelola content website. </p></div>";
 if ($_SESSION['level']=="operator"){
  echo "<div align='center'>
  <table><thead>
		<th class='center' colspan=10><center>Control Panel</center></th></thead>
		<tr>
		  <td width=120 align=center><a href=media.php?module=pegawai><img src=images/user.jpg border=none><br /><b>Data Pegawai</b></a></td>
		  <td width=120 align=center><a href=media.php?module=nppt><img src=images/modul.png border=none><br /><b>NPPD</b></a></td>
		  <td width=120 align=center><a href=media.php?module=spt><img src=images/berita.png border=none><br /><b>SPT</b></a></td>
		  <td width=120 align=center><a href=media.php?module=sppd><img src=images/download.png border=none><br /><b>SPPD</b></a></td>
		  <td width=120 align=center><a href=media.php?module=kwitansi><img src=images/banner.png border=none><br /><b>Kwitansi</b></a></td>
		  <td width=120 align=center><a href=media.php?module=lpd><img src=images/agenda.png border=none><br /><b>Laporan Perjalanan Dinas</b></a></td>
		  
		  <td width=120 align=center><a href=media.php?module=password><img src=images/password.png border=none><br /><b>Ganti Password</b></a></td>
    </tr>
    </table></div>";
	echo "<br><br><br><br><br><br>
          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
 }elseif($_SESSION['level']=="kabag") {
  echo "<div align='center'>
  <table><thead>
		<th class='center' colspan=10><center>Control Panel</center></th></thead>
		<tr>
		  <td width=120 align=center><a href=media.php?module=nppt><img src=images/modul.png border=none><br /><b>Nota Permintaan Perjalanan Dinas</b></a></td>
		  <td width=120 align=center><a href=media.php?module=lpd><img src=images/berita.png border=none><br /><b>Laporan Perjalanan Dinas</b></a></td>
		  <td width=120 align=center><a href=media.php?module=kwitansi><img src=images/banner.png border=none><br /><b>Manajemen Kwitansi</b></a></td>
		  <td width=120 align=center><a href=media.php?module=password><img src=images/password.png border=none><br /><b>Ganti Password</b></a></td>
    </tr>
    </table></div>";
	echo "<br><br><br><br><br><br>
          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
 }else{
   echo "<div align='center'>
  <table><thead>
		<th class='center' colspan=10><center>Control Panel</center></th></thead>
		<tr>
		  <td width=120 align=center><a href=media.php?module=spt><img src=images/berita.png border=none><br /><b>Manajemen SPT</b></a></td>
		  <td width=120 align=center><a href=media.php?module=lpd><img src=images/download.png border=none><br /><b>Laporan Perjalanan Dinas</b></a></td>
		  <td width=120 align=center><a href=media.php?module=password><img src=images/password.png border=none><br /><b>Ganti Password</b></a></td>
		  <td width=120 align=center><a href=logout.php><img src=images/agenda.png border=none><br /><b>Keluar</b></a></td>
    </tr>
    </table></div>";
	echo "<br><br><br><br><br><br>
          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
 }
  
}
//users
elseif ($mod=='pegawai'){
    include "modul/mod_pegawai/pegawai.php";
}
elseif ($mod=='spt'){
    include "modul/mod_spt/spt.php";
}
//supplier
elseif ($mod=='nppt'){
    include "modul/mod_nppt/nppt.php";
}
elseif ($mod=='tambahnppt'){
    include "modul/mod_nppt/tambahnppt.php";
}

elseif ($mod=='sppd'){
    include "modul/mod_sppd/sppd.php";
	}
elseif ($mod=='pangkat'){
    include "modul/mod_pangkat/pangkat.php";
}
elseif ($mod=='jabatan'){
    include "modul/mod_jabatan/jabatan.php";
}
elseif ($mod=='golongan'){
    include "modul/mod_golongan/golongan.php";
}
//biaya
elseif ($mod=='biaya'){
    include "modul/mod_biaya/biaya.php";
}

elseif ($mod=='tujuan'){
    include "modul/mod_tujuan/tujuan.php";
}
elseif ($mod=='transportasi'){
    include "modul/mod_transportasi/transportasi.php";
}
elseif ($mod=='kwitansi'){
    include "modul/mod_kwitansi/kwitansi.php";
}
elseif ($mod=='ttdkwitansi'){
    include "modul/mod_ttdkwitansi/ttdkwitansi.php";
}
elseif ($mod=='lpd'){
    include "modul/mod_lpd/lpd.php";
}
elseif ($mod=='password'){
    include "modul/mod_password/password.php";
}

//input
elseif ($mod=='input_nppt'){
    include "modul/mod_input_nppt/input_nppt.php";
}

// Apabila modul tidak ditemukan
else{
  echo "<b>MODUL BELUM ADA ATAU BELUM LENGKAP</b>";
}
?>
