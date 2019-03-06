<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Update pegawai
if ($module=='pegawai' AND $act=='update'){
    mysql_query("UPDATE pegawai SET nip  = '$_POST[nip]',
								 nama = '$_POST[nama]',
								 id_pangkat = '$_POST[id_pangkat]',
								 id_jabatan = '$_POST[id_jabatan]',
								 unitkerja = '$_POST[unitkerja]',
								 foto = '$_POST[foto]'
								 WHERE  id_pegawai     = '$_POST[id]'");
	
  header('location:../../media.php?module='.$module);
}
elseif ($module=='pegawai' AND $act=='hapus') {
	mysql_query("DELETE FROM pegawai WHERE id_pegawai='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}
elseif ($module=='pegawai' AND $act=='input'){
	  mysql_query("INSERT INTO pegawai(nip,nama,id_pangkat,id_jabatan,unitkerja,username,password,foto) 
	  VALUES('$_POST[nip]','$_POST[nama]','$_POST[id_pangkat]','$_POST[id_jabatan]','$_POST[unitkerja]',
	  '$_POST[nip]','$_POST[nip]','$_POST[foto]')");
  header('location:../../media.php?module='.$module);
}

?>

