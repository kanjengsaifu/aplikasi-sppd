<style>
h2,h1,h3{ padding:0;margin:0;}
h1 {font-size:22px;font-weight:bold}
h2 {font-size:22px;font-weight:normal}
#wrapper {
	width:780px;
	margin:0 auto;
	font-size:15px;
}
#ol {margin:0}
#logo {
	width:95px;
	float:left;	
	margin-bottom:8px;
}
hr{border-bottom: 5px double #000;clear:both}
#cop {
	float:left;width:600px;text-align:center;
}
#kanan{clear:both;width:auto;float:right;margin-bottom:10px;}
#header {clear:both;text-align:center;}

#garis1{border-top:double 5px #000000;border-bottom:1px solid #000}
#garis2 {border-bottom:1px solid #000}
#garis3{border-bottom:3px solid #000}
#g4{border-right:1px solid #000}
#table {
	font-family: Verdana, Arial, Helvetica, sans-serif; 
	font-size: 10pt;
	border-width: 1px;
	border-style: solid;
	border-color: #000;
	border-collapse: collapse;
	margin: 10px 0px;
}
#table td{
	padding: 0.4em;
	border-right:1px solid #000;
}

.style1 {font-size: 16
}
.style2 {	font-size: 24px;
}
</style>
<body onLoad="window.print(0)">
<div id="wrapper">
<div id="logo"><img src="../../logo.jpg" width="95" height="62"></div>
<div id="cop">
  <h2 class="style1">PEMERINTAH KOTA PADANG</h2>
  <h1 class="style2">SEKRETARIAT DAERAH</h1>
  Jalan Bagindo Aziz Chan Nomor 1 Aia Pacah Telp. (0751) 8051022 Fax. 8051023 Padang</div>
<hr>
<div id="kanan">
<?php
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
$qry=mysql_query("SELECT * FROM sppd,nppt,pegawai,tujuan,jabatan,pangkat WHERE id_sppd='$_GET[id]' AND sppd.id_pegawai=pegawai.id_pegawai AND sppd.id_nppt=nppt.id_nppt AND nppt.id_tujuan=tujuan.id_tujuan AND jabatan.id_jabatan=pegawai.id_jabatan AND pangkat.id_pangkat=pangkat.id_pangkat");
$r=mysql_fetch_array($qry);

$query_perintah = mysql_query("SELECT detail_nppt.id_detail,detail_nppt.id_nppt,detail_nppt.id_pegawai, pegawai.nip, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan where detail_nppt.id_nppt=$r[id_nppt] AND detail_nppt.status_perintah = 'Perintah'");
$pegawai_perintah = mysql_fetch_array($query_perintah);
?>
<table width="350">
<tr><td width="100">Lembar ke </td><td>: </td></tr>
<tr><td>Kode No </td><td>: </td></tr>
<tr><td>Nomor </td><td>: &nbsp;&nbsp;&nbsp;<?php echo $r['no_sppd']; ?></td></tr>
</table>
</div>	
<div id="header">
<h2><u><strong>SURAT PERINTAH PERJALANAN DINAS</strong></u><strong><br />
(SPPD)</strong></h2></div>
<?php
$tglpergi= tgl_indo ($r['tgl_pergi']);
$tglkembali= tgl_indo ($r['tgl_kembali']);
$tgldibuat= tgl_indo ($r['tgl_dibuat']);

echo "<table id='table' width=100%>
<tr id='garis1'><td>1.</td><td width=50% id='g4'>Pejabat yang memberi perintah		</td><td>$r[pemberi_perintah] </td></tr>
 <tr id='garis3'><td>2.</td><td id='g4'> Nama / NIP Pegawai yang diperintah			</td><td>$pegawai_perintah[nama] / $pegawai_perintah[nip]</td></tr>
 <tr><td>3.</td><td id='g4'>a. Pangkat dan Golongan menurut PP No. 6 Tahun 1997	</td><td>$r[pangkat]</td></tr>
 <tr><td></td><td id='g4'>b. Jabatan								</td><td>$r[jabatan]</td></tr>
 <tr  id='garis3'><td></td><td id='g4'>c. Tingkat menurut peraturan perjalanan </td><td> </td></tr>
 <tr  id='garis2'><td>4. </td><td id='g4'>Maksud Perjalan Dinas						</td><td>$r[maksud]</td></tr>
 <tr id='garis2'><td>5. </td><td id='g4'>Alat Angkutan Yang di Pergunakan			</td><td>";
			$value =explode('-',$r['id_transportasi']);
			$nomer= 0;
			for($i=0;$i<count($value);$i++) { 
			$data=$value[$i];
			$nomer++;
			   $sql=mysql_query("SELECT * FROM transportasi WHERE id_transportasi='$data'");
			   $t=mysql_fetch_array($sql);
			   echo "$t[transportasi] ";
			   echo ",&nbsp;";
			}
 
 echo"</td></tr>
 <tr><td>6. </td><td id='g4'>a. Tempat Berangkat										</td><td>Padang</td></tr>
 <tr  id='garis2'><td></td><td id='g4'>b. Tempat Tujuan			</td><td> $r[tujuan]</td></tr>
 <tr><td>7. </td><td id='g4'>a. Lama Perjalanan Dinas								</td><td>$r[lama] hari</td></tr>
 <tr><td></td><td id='g4'>b. Tanggal Berangkat					</td><td>$tglpergi </td></tr>
 <tr id='garis2'><td></td><td id='g4'>c. Tanggal Kembali			</td><td>$tglkembali </td></tr>
  <tr id='garis2'><td>8.</td><td id='g4'>Pengikut									</td><td>";
  
  $no_pengikut = 1;
  $pengikut = mysql_query("SELECT detail_nppt.id_detail,detail_nppt.id_nppt,detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan where detail_nppt.id_nppt=$r[id_nppt] AND detail_nppt.status_perintah = 'Pengikut'");
			while($data_pengikut = mysql_fetch_array($pengikut)){
				echo "$no_pengikut Nama: $data_pengikut[nama] <br/>";
				echo "&nbsp;&nbsp;&nbsp;Jabatan: $data_pengikut[jabatan] <br/>";
				$no_pengikut++;
			}
echo"</td></tr>
 <tr><td>9. </td><td id='g4'>Pembina Angaran											</td><td> </td></tr>
 <tr><td></td><td id='g4'>a. Instansi								</td><td>$r[instansi] </td></tr>
 <tr id='garis2'><td></td><td id='g4'>b. Mata Anggaran			</td><td>$r[mata_anggaran] </td></tr>
 <tr id='garis2'><td>10.</td><td id='g4'>Keterangan Lain-Lain						</td><td>$r[keterangan]</td></tr>
 </table>";		

?>
<div style="width:300px;float:right;margin-top:15px"><span style="width:300px;float:right;">Dikeluarkan di: Padang</span><br>
<?php
echo" <tr><td>Pada Tanggal	</td><td>: $tgldibuat</td></tr>";
?>
<div style="font-weight:bold"><p align="center">SEKRETARIS DAERAH KOTA PADANG<br>
</p>
  <p>&nbsp;</p>
  <p align="center"><u>Ir.H. ASNEL, MSI</u><br>
    Pembina Utama Madya<br />
    NIP. 19590114 198509 1 001</p>
</div>
</div>

</div>

