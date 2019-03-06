<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Update tujuan
if ($module=='tujuan' AND $act=='update'){
    mysql_query("UPDATE tujuan SET tujuan  = '$_POST[tujuan]'
								 WHERE  id_tujuan     = '$_POST[id]'");
	
  header('location:../../media.php?module='.$module);
}
elseif ($module=='tujuan' AND $act=='hapus') {
	mysql_query("DELETE FROM tujuan WHERE id_tujuan='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
elseif ($module=='tujuan' AND $act=='input'){
	  mysql_query("INSERT INTO tujuan(tujuan) 
	  VALUES('$_POST[tujuan]')");
  header('location:../../media.php?module='.$module);
}

?>

