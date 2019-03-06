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
#header {clear:both;text-align:center;}

#garis1{border-top:solid 1px #fff;border-right:1px solid #fff}
#garis2 {border-bottom:1px solid #000}
#g4{border-right:1px solid #000}
#table {
	font-family: Verdana, Arial, Helvetica, sans-serif; 
	font-size: 10pt;
	border-width: 1px;
	border-style: solid;
	border-color: #fff;
	border-collapse: collapse;
	margin: 10px 0px;
}
#table td{
	padding: 0.5em;
}
th{
	text-transform: uppercase;
	text-align: center;
	padding: 0.5em;
	border-width: 1px;
	border-style: solid;
	border-color: #000;
	border-collapse: collapse;
}
td{
	padding: 0.5em;
	vertical-align: top;
	border-width: 1px;
	border-style: solid;
	border-color: #000;
	border-collapse: collapse;
	text-align:center;
}
#table2 {
	font-family: Verdana, Arial, Helvetica, sans-serif; 
	font-size: 10pt;
}
#table2 tr {padding:0px}
#table2 td {padding:0px}
.table {border:none;
	font-family: Verdana, Arial, Helvetica, sans-serif; 
	font-size: 10pt;
}
.table tr {border:none;text-align:left;padding:0px;}
.table td {border:none;text-align:left;padding:0px;}

</style>
<body onLoad="window.print()">
<div id="wrapper">
<div style="width:300px;float:right;margin-bottom:8px;">No</div>
<div style="text-align:center;clear:both;"><h3>KWITANSI</h3></div>

<?php
include "../../config/koneksi.php";
include "../../config/fungsi_terbilang.php";
include "../../config/fungsi_indotgl.php";

function tanggal_indo($tanggal, $cetak_hari = false)
{
	$hari = array ( 1 =>    'Senin',
				'Selasa',
				'Rabu',
				'Kamis',
				'Jumat',
				'Sabtu',
				'Minggu'
			);
			
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split 	  = explode('-', $tanggal);
	$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
	
	if ($cetak_hari) {
		$num = date('N', strtotime($tanggal));
		return $hari[$num] . ', ' . $tgl_indo;
	}
	return $tgl_indo;
}


$t=mysql_fetch_array(mysql_query("SELECT 
kwitansi.*,
nppt.*,
tujuan.tujuan 
 FROM kwitansi 
JOIN sppd ON kwitansi.id_sppd = sppd.id_sppd 
JOIN nppt ON sppd.id_nppt = nppt.id_nppt 
JOIN tujuan on nppt.id_tujuan = tujuan.id_tujuan WHERE kwitansi.id_kwitansi = $_GET[id];"));
	
$data_pegawai = mysql_query("SELECT sppd.id_sppd, detail_nppt.id_nppt, pegawai.nip, detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan 
JOIN sppd ON detail_nppt.id_nppt = sppd.id_nppt WHERE sppd.id_sppd = $t[id_sppd] ORDER BY detail_nppt.status_perintah ASC");

$pegawai_utama = mysql_fetch_array($data_pegawai);

$lama = $t['lama'];
$tgldibuat = $t['tgl_dibuat'];
$tot_lumpsum = $t['lumpsum'];
$tot_penginapan = $t['penginapan'];
$tot_transportasi = $t['transportasi'];
$tot_harian = $t['harian'];
$tot_lumpsum_rupiah = number_format($tot_lumpsum,0,'','.');
$tot_penginapan_rupiah = number_format($tot_penginapan,0,'','.');
$tot_transportasi_rupiah = number_format($tot_transportasi,0,'','.');
$tot_harian_rupiah = number_format($tot_harian,0,'','.');
$lumpsum_rupiah = number_format($t['lumpsum'],0,'','.');
$penginapan_rupiah = number_format($t['penginapan'],0,'','.');
$transportasi_rupiah = number_format($t['transportasi'],0,'','.');
$harian_rupiah = number_format($t['harian'],0,'','.');
$total = $tot_lumpsum + $tot_penginapan + $tot_transportasi + $tot_harian;
$tot_rupiah = number_format($total,0,'','.');
$n=mysql_fetch_array(mysql_query("SELECT * FROM ttdkwitansi"));
$terbilang=terbilang($total, $style=3);

	echo "<table id='table' width=100%>
		  <tr><td width=240 height=170>
		  KODE REKENING<br />
		  2.02.2.02.01.01.18.5.2.2.15.2
		  </td><td colspan=2 rowspan=2 id='garis1' style='text-align:left'>
		  <table class='table' width='100%'>
		  <tr><td>Telah Di Terima Dari </td><td>$t[dari]</td></tr>
		  <tr><td>Uang Sejumlah </td><td><b>Rp. $tot_rupiah</b><br><i> $terbilang Rupiah</i></td></tr>
		  <tr><td>Untuk Keperluan </td><td>$t[untuk]</td></tr>
		  </table>
		  </td>
		  <tr><td height=170>
		  SETUJU BAYAR<br />
		  Kuasa Pengguna Anggaran<br />
		  BP3AP2KB Kota Padang<br /><br /><br /><br />
		  <u>$n[kabag]</u><br />
		  NIP. $n[nip_kabag]
		  </td></tr>
		  <tr>
		  <td height=140>
		  LUNAS BAYAR<br />
		  Bendahara Pengeluaran Pembantu<br />
		  <br /><br /><br />
		  <u>$n[bendahara]</u><br />
		  NIP. $n[nip_bendahara]</td>
		  <td>
		  Mengetahui<br />
		  Pejabat Pelaksana Teknis Kegiatan<br />
		  <br /><br /><br />
		  <u>$n[pptk]</u><br />
		  NIP. $n[nip_pptk]</td>
		  <td>
		  <br />
		  Yang Menerima <br />
		  <br /><br /><br />
		  <u>$pegawai_utama[nama]</u><br />
		  NIP. $pegawai_utama[nip]</td>
		  </tr>
		  </table>";		
?>
<div style="page-break-before:always;"></div>
<div style="font-family: Arial; text-align: center; font-size: 12pt; font-weight: bold; margin-top: 100px; ">
DAFTAR PEMBAYARAN PERJALANAN DINAS LUAR DAERAH LUAR PROVINSI <br/>
<?php echo strtoupper($t['maksud']); ?> <br/>
<?php
	$tgl_pergi = explode("-", $t['tgl_pergi']);
?>
PADA TANGGAL <?php echo $tgl_pergi[2]." S/D ".strtoupper(tanggal_indo($t['tgl_kembali']))?> DI <?php echo strtoupper($t['tujuan']) ?>
</div>
<br/>
<br/>
<table style="font-family: Arial; border: 2px solid black; border-collapse: collapse; width: 1000px; margin-left: -130px;">
	<tr>
		<td style="border: 2px solid; black;">Nama</td>
		<td style="border: 2px solid; black;">Jabatan</td>
		<td style="border: 2px solid; black;width: 110px;">Uang Transportasi</td>
		<td style="border: 2px solid; black;width: 110px;">Uang Penginapan</td>
		<td style="border: 2px solid; black;width: 110px;">Uang Harian</td>
		<td style="border: 2px solid; black;width: 110px;">Uang Lumpsum</td>
		<td style="border: 2px solid; black;width: 110px;">Jumlah</td>
		<td style="border: 2px solid; black;width: 60px;">Tanda Tangan</td>
	</tr>
	<?php
	
	$banyak_pegawai = mysql_fetch_array(mysql_query("SELECT COUNT(id_detail) AS id FROM detail_nppt WHERE id_nppt = $pegawai_utama[id_nppt]"));

	$data_pegawai = mysql_query("SELECT sppd.id_sppd, detail_nppt.id_nppt, nppt.lama, pegawai.nip, detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan, biaya.* FROM detail_nppt   
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan 
	JOIN sppd ON detail_nppt.id_nppt = sppd.id_nppt 
	JOIN nppt on sppd.id_nppt = nppt.id_nppt 
JOIN biaya ON nppt.id_tujuan = biaya.id_tujuan AND pegawai.id_jabatan = biaya.id_jabatan AND pegawai.id_pangkat = biaya.id_pangkat
	WHERE sppd.id_sppd = $t[id_sppd] ORDER BY detail_nppt.status_perintah ASC");
	$jumlah = 0;
	$jumlah_keseluruhan = 0;
	while($pegawai = mysql_fetch_array($data_pegawai)){
	$jumlah = $pegawai['transportasi'] + ($pegawai['penginapan']*($pegawai['lama']-1)) + ($pegawai['harian']*$pegawai['lama']) + $pegawai['lumpsum'];
	$jumlah_keseluruhan += $jumlah;
	?>
	<tr>
		<td style="border: 2px solid; black;"><?php echo $pegawai['nama']; ?></td>
		<td style="border: 2px solid; black;"><?php echo $pegawai['jabatan']; ?></td>
		<td style="border: 2px solid; black;">Rp <?php echo number_format($pegawai['transportasi'] ,0,'','.'); ?></td>
		<td style="border: 2px solid; black;">Rp <?php echo number_format($pegawai['penginapan']*($pegawai['lama']-1) ,0,'','.'); ?></td>
		<td style="border: 2px solid; black;">Rp <?php echo number_format($pegawai['harian']*$pegawai['lama'] ,0,'','.'); ?></td>
		<td style="border: 2px solid; black;">Rp <?php echo number_format($pegawai['lumpsum'] ,0,'','.'); ?></td>
		<td style="border: 2px solid; black;">Rp <?php echo number_format($jumlah ,0,'','.'); ?></td>
		<td style="border: 2px solid; black;">     </td>
	</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="6" style="border: 2px solid; black;"><b><i>JUMLAH</i></b></td>
		<td style="border: 2px solid; black;">Rp. <?php echo number_format($jumlah_keseluruhan ,0,'','.'); ?></td>
		<td></td>
	</tr>
</table>
<?php
$tgl_sekarang = explode(" ", tanggal_indo(date("Y-m-d")));

$ttd = mysql_fetch_array(mysql_query("SELECT * FROM ttdkwitansi"));
?>
<div style="margin-top: 30px;text-align: left; width: 250px; float: right; margin-right: -50px; font-family: Arial; font-weight: bold;">
Padang, &nbsp <?php echo $tgl_sekarang[1]." ".$tgl_sekarang[2]; ?><br/>
Bendahara Pengeluaran<br/>
<br/>
<br/>
<br/>
<br/>
<u><?php echo $ttd['bendahara']; ?></u><br/>
NIP.<?php echo $ttd['nip_bendahara']; ?>
</div>

