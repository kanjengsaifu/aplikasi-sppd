<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET['module'];
$act=$_GET['act'];

if ($module=='spt' AND $act=='hapus') {
	mysql_query("DELETE FROM spt WHERE id_spt='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
elseif ($module=='spt' AND $act=='input'){
	  $value = (count($_POST['id_pegawai']) > 0) ? implode('-', $_POST['id_pegawai']) : ""; 
	  mysql_query("INSERT INTO spt(id_pegawai,no_spt,pejabat_perintah,tugas,pembebanan_anggaran,dasar_hukum,tempat) 
	  VALUES('$value','$_POST[no_spt]','$_POST[pejabat_perintah]','$_POST[tugas]','$_POST[pembebanan_anggaran]','$_POST[dasar_hukum]','$_POST[tempat]')");
  header('location:../../media.php?module='.$module);
}
elseif ($module=='spt' AND $act=='update'){
	  $value = (count($_POST['id_pegawai']) > 0) ? implode('-', $_POST['id_pegawai']) : ""; 
    mysql_query("UPDATE spt SET id_pegawai  = '$value',
								no_spt = '$_POST[no_spt]',
								pejabat_perintah = '$_POST[pejabat_perintah]',
								 tugas = '$_POST[tugas]',
								 dasar_hukum = '$_POST[dasar_hukum]',
								 tempat = '$_POST[tempat]',
								 pembebanan_anggaran = '$_POST[pembebanan_anggaran]'
								 WHERE  id_spt    = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}

?>

