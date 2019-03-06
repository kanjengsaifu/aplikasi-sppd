<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Update biaya
if ($module=='biaya' AND $act=='update'){
	 $value = (count($_POST['id_tujuan']) > 0) ?  : ""; 
    mysql_query("UPDATE biaya SET id_tujuan = '$_POST[id_tujuan]',
  								 harian = '$_POST[harian]',	
								 penginapan = '$_POST[penginapan]',
								 transportasi = '$_POST[transportasi]',
								 lumpsum  = '$_POST[lumpsum]',
								 id_jabatan = '$_POST[id_jabatan]',
								 id_pangkat = '$_POST[id_pangkat]'
								 WHERE  id_biaya     = '$_POST[id]'");
	
  header('location:../../media.php?module='.$module);
}
elseif ($module=='biaya' AND $act=='hapus') {
	mysql_query("DELETE FROM biaya WHERE id_biaya='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
elseif ($module=='biaya' AND $act=='input'){
	 $value = (count($_POST['id_tujuan']) > 0) ? : ""; 
	 mysql_query("INSERT INTO biaya(id_tujuan,harian,penginapan,transportasi,lumpsum,id_jabatan,id_pangkat) 
	  VALUES('$_POST[id_tujuan]','$_POST[harian]','$_POST[penginapan]','$_POST[transportasi]','$_POST[lumpsum]','$_POST[id_jabatan]','$_POST[id_pangkat]')");
 header('location:../../media.php?module='.$module);
}

?>

