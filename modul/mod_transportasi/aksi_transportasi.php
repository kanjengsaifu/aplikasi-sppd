<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Update transportasi
if ($module=='transportasi' AND $act=='update'){
    mysql_query("UPDATE transportasi SET transportasi  = '$_POST[transportasi]'
								 WHERE  id_transportasi     = '$_POST[id]'");
	
  header('location:../../media.php?module='.$module);
}
elseif ($module=='transportasi' AND $act=='hapus') {
	mysql_query("DELETE FROM transportasi WHERE id_transportasi='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
elseif ($module=='transportasi' AND $act=='input'){
	  mysql_query("INSERT INTO transportasi(transportasi) 
	  VALUES('$_POST[transportasi]')");
  header('location:../../media.php?module='.$module);
}

?>

