<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

if ($module=='kwitansi' AND $act=='hapus') {
	mysql_query("DELETE FROM kwitansi WHERE id_kwitansi='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
elseif ($module=='kwitansi' AND $act=='input'){
mysql_query("INSERT INTO kwitansi(id_sppd,id_pegawai,dari,untuk,lama,harian,penginapan,transportasi,lumpsum,tujuan) 
	  VALUES('$_POST[id_sppd]','$_POST[id_pegawai]','$_POST[dari]','$_POST[untuk]','$_POST[lama]','$_POST[harian]','$_POST[penginapan]','$_POST[transportasi]','$_POST[lumpsum]','$_POST[tujuan]')");
  header('location:../../media.php?module='.$module);
}

?>

