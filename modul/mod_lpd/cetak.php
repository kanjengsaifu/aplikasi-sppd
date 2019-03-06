<style type="text/css">

#wraper {width:700px;margin:0 auto;line-height:25px;}
h2 {text-align:center;text-decoration:underline;margin-top:40px;}
</style>
<body onLoad="window.print(0)">
<div id="wraper">
<?php
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
      $t = mysql_fetch_array(mysql_query("SELECT * FROM lpd,pegawai,spt,jabatan,pangkat WHERE lpd.id_pegawai=pegawai.id_pegawai 
	  AND lpd.id_spt=spt.id_spt AND lpd.id_lpd='$_GET[id]' AND pegawai.id_jabatan=jabatan.id_jabatan AND pegawai.id_pangkat=pangkat.id_pangkat"));
	  $tanggalnya = tgl_indo($t['tanggal']);
	  $c = mysql_fetch_array(mysql_query("SELECT * FROM spt,nppt,tujuan WHERE spt.id_nppt=nppt.id_nppt AND spt.id_spt='$t[id_spt]' AND tujuan.id_tujuan=nppt.id_tujuan"));
  $tgl_pergi = tgl_indo($c['tgl_pergi']);
  $tgl_kembali = tgl_indo($c['tgl_kembali']);
   $tgl_dibuat = tgl_indo($c['tgl_dibuat']);
	 
echo "<h2>LAPORAN PERJALANAN DINAS </h2>";

echo "Pada hari ini $t[hari] tanggal $tgl_kembali , Saya yang bertanda tangan dibawah ini : <br /><br />

	 <table>
	 <tr><td>Nama 				</td><td> : $t[nama]</td></tr>
	 <tr><td>NIP				</td><td> : $t[nip] </td></tr>
	 <tr><td>Pangkat  			</td><td> : $t[pangkat] </td></tr>
	 <tr><td>Jabatan			</td><td> : $t[jabatan] </td></tr>
	 <tr><td>Unit Kerja			</td><td> : $t[unitkerja] </td></tr>
	 </table>";
  
echo "<br />Telah melaksanakan Perjalanan Dinas dalam rangka $c[tugas] , berdasarkan
		  Surat Perintah Tugas Nomor : $c[no_spt] , dari tanggal $tgl_pergi s/d $tgl_kembali di $c[tujuan]";

echo "<br /><br />$t[hasil]<br />";	
echo "Demikianlah Laporan Hasil Perjalanan Dinas ini dibuat untuk dipergunakan seperlunya.<br /><br />";
echo "<div style='text-align:center;width:300px;float:right;'>
	  Padang , $tgl_kembali<br>Yang Membuat Laporan";
echo "<br /><br /><br />";
echo "<b><u>
	  <div style='text-transform:uppercase;margin:0;padding:0'>$t[nama]</div></u></b>
	  NIP:$t[nip]
	  </div>";
	 
?>
</div>
