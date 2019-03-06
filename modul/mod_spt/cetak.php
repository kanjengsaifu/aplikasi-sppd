<style>
h2,h1,h3{ padding:0;margin:0;}
h1 {font-size:22px;font-weight:bold}
h2 {font-size:22px;font-weight:normal}
#wrapper {
	width:780px;
	margin:0 auto;
}
#ol {margin:0}
#logo {
	width:95px;
	float:left;	
}
hr{border-bottom: 5px double #000;}
#cop {
	float:left;width:600px;text-align:center;
}

#kodepos{clear:both;text-align:right}
#header {clear:both;text-align:center}
.style1 {
	font-size: 16
}
.style2 {
	font-size: 24px;
}
</style>
<body onLoad="window.print()">
<div id="wrapper">
<div id="logo"><img src="../../logo.jpg" width="95" height="65" /></div>
<div id="cop">
  <h2 class="style1">PEMERINTAH KOTA PADANG</h2>
  <h1 class="style2">SEKRETARIAT DAERAH</h1>
  Jalan Bagindo Aziz Chan Nomor 1 Aia Pacah Telp. (0751) 8051022 Fax. 8051023 Padang<br>
</div>
<div id="kodepos"></div>
<hr />
<?php
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
$qr=mysql_query("Select * FROM spt WHERE id_spt='$_GET[id]'");
$r=mysql_fetch_array($qr);

echo "
<div id='header'>
<h2><u>SURAT PERINTAH TUGAS</u></h2>
NOMOR : &nbsp;&nbsp;&nbsp;$r[no_spt]
<div id='isi'>
<table>
<tr><td width='180' valign='top'>1. Pejabat Memerintahkan</td><td>: $r[pejabat_perintah]</td></tr><br></br>
</table>
</br><div style='float:left'>2. Pegawai Yang Memerintah	:</div>";

$value= explode("-",$r['id_pegawai']);
$no=0;
echo "<ol>";
	$qs=mysql_query("SELECT detail_nppt.id_detail,detail_nppt.id_nppt,detail_nppt.id_pegawai, pegawai.nip, pegawai.unitkerja, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan where detail_nppt.id_nppt= $r[id_nppt] ORDER BY detail_nppt.status_perintah ASC");
	while($t = mysql_fetch_array($qs)){ 
	$no++;
	
	
	echo "<table>
	<br>
			 <tr><td>&nbsp;&nbsp;&nbsp;Nama / NIP				</td><td>: $t[nama] / $t[nip]</td></tr>
			 <tr><td>&nbsp; &nbsp;Jabatan					</td><td>: $t[jabatan]</td></tr>
		     <tr><td>&nbsp; &nbsp;Pangkat					</td><td>: $t[pangkat]</td></tr></table>";
			 		
}
echo "</ol>";
echo "<table>
<tr><td width='180' valign='top'>3. Diperintahkan Untuk</td><td>: $r[tugas]</td></tr>
<tr><td width='180' valign='top'>4. Dasar Surat Perintah</td><td>: $r[dasar_hukum]</td></tr>
<tr><td width='180' valign='top'>5. Tempat/Lokasi</td><td>: $r[tempat]</td></tr><br></br>
<tr><td width='180' valign='top'>6. Pembebanan Anggaran</td><td>: $r[pembebanan_anggaran]</td></tr>

</td></tr>
</table>

<div style='float:left'></div><br>";


echo "</ol>";



?>


</div>
<div style="width:300px;float:right;margin-top:10px;">
<p>&nbsp;</p>
<p>Dikeluarkan di: Padang<br>
  <?php
  $qry=mysql_query("SELECT * FROM spt,nppt,pegawai,tujuan,jabatan,pangkat WHERE id_spt='$_GET[id]' AND spt.id_pegawai=pegawai.id_pegawai AND spt.id_nppt=nppt.id_nppt AND nppt.id_tujuan=tujuan.id_tujuan AND jabatan.id_jabatan=pegawai.id_jabatan AND pangkat.id_pangkat=pangkat.id_pangkat");
$r=mysql_fetch_array($qry);
$tgldibuat= tgl_indo ($r['tgl_dibuat']);
echo" <tr><td>Pada Tanggal	</td><td>: $tgldibuat</td></tr>";
?>
</p>
<div style="text-align:center;font-weight:bold">SEKRETARIS DAERAH KOTA PADANG<br>

<p>&nbsp;</p>
<p><u>Ir.H. ASNEL, MSI</u><br>
Pembina Utama Madya<br />
NIP. 19590114 198509 1 001</p>
</div>
</div>

</div>
