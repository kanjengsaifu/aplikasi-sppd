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

</style>
<div id="wrapper">
<div id="logo"><img src="../../logo.jpg" width="95" height="100" /></div>
<div id="cop">
  <strong>PEMERINTAH KOTA PADANG</strong><br />
  <strong>DINAS PEMBERDAYAAN PEREMPUAN, PERLINDUNGAN ANAK, PENGENDALIAN PENDUDUK DAN KELUARGA BERENCANA</strong><br />
  Jalan Khatib Sulaiman No. 1 Padang Telp. 0751-7055317<br> 
  </div>

<hr>
<div id="kanan">
<?php
include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";
$qry=mysql_query("SELECT * FROM sppd,nppt,pegawai,tujuan,jabatan WHERE id_sppd='$_GET[id]' AND sppd.id_pegawai=pegawai.id_pegawai AND sppd.id_nppt=nppt.id_nppt AND nppt.id_tujuan=tujuan.id_tujuan AND jabatan.id_jabatan=pegawai.id_jabatan");
$r=mysql_fetch_array($qry);
?>
<table width="350">
<tr><td width="100">Lembar ke </td><td>: </td></tr>
<tr><td>Kode No </td><td>: </td></tr>

<?php
 echo " <tr><td>Nomor </td><td>: $r[no_sppd] </tr></td>";
?>
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
<tr id='garis1'><td>1.</td><td width=50% id='g4'>Pejabat yang memberi perintah		</td><td>$r[pejabat_perintah] </td></tr>
 <tr id='garis3'><td>2.</td><td id='g4'> Pegawai yang diperintahkan			</td><td>$r[nama]</td></tr>
 <tr><td>3.</td><td id='g4'>a. Pangkat dan Golongan menurut PP No. 11 Tahun 2011	</td><td>$r[pangkat] $r[golongan]</td></tr>
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
 <tr><td>6. </td><td id='g4'>a. Tempat Berangkat										</td><td>Padang </td></tr>
 <tr  id='garis2'><td></td><td id='g4'>b. Tempat Tujuan			</td><td> $r[tujuan]</td></tr>
 <tr><td>7. </td><td id='g4'>a. Lama Perjalanan Dinas								</td><td>$r[lama] hari</td></tr>
 <tr><td></td><td id='g4'>b. Tanggal Berangkat					</td><td>$tglpergi </td></tr>
 <tr id='garis2'><td></td><td id='g4'>c. Tanggal Kembali			</td><td>$tglkembali </td></tr>

 <tr><td>9. </td><td id='g4'>Pembina Anggaran											</td><td> </td></tr>
 <tr><td></td><td id='g4'>a. Instansi								</td><td>$r[instansi] </td></tr>
 <tr id='garis2'><td></td><td id='g4'>b. Mata Anggaran			</td><td>$r[mata_anggaran] </td></tr>
 <tr id='garis2'><td>10.</td><td id='g4'>Keterangan Lain-Lain						</td><td>$r[keterangan]</td></tr>
 </table>";		

?>
<div style="width:300px;float:right;margin-top:15px">
<p>Dikeluarkan di: Padang<br>
  <?php
echo" <tr><td>Pada Tanggal	</td><td>: $tgldibuat</td></tr>";
?>
</p>
<div style="text-align:center;font-weight:bold">
KEPALA<br>

<p>&nbsp;</p>
<p><u>Ir.H.HERYANTO RUSTAM, MM</u><br>
Pembina Utama Muda <br />
NIP. 19600421 199003 1 005</p>
</div>
</div>

</div>

</div>
<p>
<p>
<div style="clear:both;"></div>
<div style="margin-top:100px"></div>
<div id="wrapper">
</div>