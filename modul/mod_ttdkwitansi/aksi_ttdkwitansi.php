<?php
session_start();
include "../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Update pegawai
if ($module=='ttdkwitansi' AND $act=='update'){
    mysql_query("UPDATE ttdkwitansi SET kabag  = '$_POST[kabag]',
								 nip_kabag = '$_POST[nip_kabag]',
								 bendahara = '$_POST[bendahara]',
								 nip_bendahara = '$_POST[nip_bendahara]',
								 pptk = '$_POST[pptk]',
								 nip_pptk = '$_POST[nip_pptk]'
								 WHERE  id     = '$_POST[id]'");
	
  header('location:../../media.php?module='.$module);
}
?>

