<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Update golongan
if ($module=='golongan' AND $act=='update'){
    mysql_query("UPDATE golongan SET golongan  = '$_POST[golongan]'
								 WHERE  id_golongan     = '$_POST[id]'");
	
  header('location:../../media.php?module='.$module);
}
elseif ($module=='golongan' AND $act=='hapus') {
	mysql_query("DELETE FROM golongan WHERE id_golongan='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
elseif ($module=='golongan' AND $act=='input'){
	  mysql_query("INSERT INTO golongan(golongan) 
	  VALUES('$_POST[golongan]')");
  header('location:../../media.php?module='.$module);
}

?>

