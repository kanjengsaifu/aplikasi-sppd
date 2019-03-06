<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Update jabatan
if ($module=='jabatan' AND $act=='update'){
    mysql_query("UPDATE jabatan SET jabatan = '$_POST[jabatan]'
								 WHERE  id_jabatan     = '$_POST[id]'");
	
  header('location:../../media.php?module='.$module);
}
elseif ($module=='jabatan' AND $act=='hapus') {
	mysql_query("DELETE FROM jabatan WHERE id_jabatan='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
elseif ($module=='jabatan' AND $act=='input'){
	  mysql_query("INSERT INTO jabatan(jabatan) 
	  VALUES('$_POST[jabatan]')");
  header('location:../../media.php?module='.$module);
}

?>

