<?php
$aksi="modul/mod_kwitansi/aksi_kwitansi.php";
$print ="modul/mod_kwitansi/cetak.php";

switch($_GET[act]){
  // Tampil kwitansi
  default:
  echo   "<h2>KWITANSI PERJALANAN DINAS</h2>";
        //  <input type=button value='Tambah Data kwitansi' 
         // onclick=\"window.location.href='?module=kwitansi&act=tambahkwitansi';\">";
    echo "
    <table id=\"example1\" class=\"table table-bordered table-hover\">
          <thead><tr><th>No</th><th>Nama</th><th>Tujuan</th><th>Lama</th><th>Uang Harian</th><th>Uang Penginapan</th>
		  <th>Uang Transportasi</th><th>Lumpsum</th><th width=80>Total</th><th>Sudah Diterima Dari</th><th>Untuk Pembayaran</th><th>aksi</th></tr></thead>"; 
    $no=0;
	echo "<tbody>";
      $tampil = mysql_query("SELECT *, (SELECT COUNT(detail_nppt.id_detail) FROM detail_nppt WHERE detail_nppt.id_nppt = sppd.id_nppt) as banyak_karyawan FROM kwitansi JOIN sppd ON kwitansi.id_sppd = sppd.id_sppd");
    while ($t=mysql_fetch_array($tampil)){
		$harian= $t['harian'] ;
		$penginapan= $t['penginapan'];
		$transportasi= $t['transportasi'];
		$lumpsum= $t['lumpsum'];
		$tot =$harian + $penginapan + $transportasi + $lumpsum;
		$total = $tot;
		$no++;
	   echo "</td>
	   		<td style=\"background-color: #333333\">$no</td>";
			
			// Kolom nama pegawau
		// ambil data pegawai per nppt 
		echo "<td style='background-color: #333333;'>";
		$no_pegawai = 1;
		// daftar pegawai
		$data_pegawai = mysql_query("SELECT detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE detail_nppt.id_nppt = $t[id_nppt]");
			
		while($pegawai = mysql_fetch_array($data_pegawai)){
			// detail pangkat dll
			echo "$no_pegawai. $pegawai[nama] <br/>";
			$no_pegawai++;
		}
		echo "</td>";
		// akhir dari kolom pegawai
			
	echo "<td style=\"background-color: #333333\">$t[tujuan]</td>
			 <td style=\"background-color: #333333\">$t[lama] hari, ".($t['lama']-1)." malam</td>
			 <td style=\"background-color: #333333\">Rp. ".number_format($harian,0,'','.')."</td>
			 <td style=\"background-color: #333333\">Rp. ".number_format($penginapan,0,'','.')."</td>
			 <td style=\"background-color: #333333\">Rp. ".number_format($transportasi,0,'','.')."</td>
			 <td style=\"background-color: #333333\">Rp. ".number_format($lumpsum,0,'','.')."</td>
			 <td style=\"background-color: #333333\">Rp. ".number_format($total,0,'','.')."</td>
			 <td style=\"background-color: #333333\">$t[dari]</td>
			 <td style=\"background-color: #333333\">$t[untuk]</td>
             <td style=\"background-color: #333333\">
			 <a href=$print?module=kwitansi&act=print&id=$t[id_kwitansi] target=\"_blank\" ><span class=\"glyphicon glyphicon-print\"></a>";
			 if($_SESSION['level']!="kabag") {
			 echo " <a href=$aksi?module=kwitansi&act=hapus&id=$t[id_kwitansi]><span class=\"glyphicon glyphicon-trash\"></a>";
			 }
			 echo "</td></tr>";
    }
    echo "</tbody></table>";
    break;
  case "tambahkwitansi":
  	$t=mysql_fetch_array(mysql_query("SELECT * FROM sppd,pegawai,jabatan,nppt,tujuan,pangkat WHERE id_sppd='$_GET[id]'
	AND sppd.id_pegawai=pegawai.id_pegawai AND jabatan.id_jabatan=pegawai.id_jabatan AND pangkat.id_pangkat=pegawai.id_pangkat AND sppd.id_nppt=nppt.id_nppt
	AND tujuan.id_tujuan=nppt.id_tujuan"));

		  $c=mysql_query("SELECT * FROM biaya WHERE id_jabatan='$t[id_jabatan]' AND id_tujuan LIKE '%$t[id_tujuan]%'");
		  $b=mysql_fetch_array($c);
		  
?>
	<h2>TAMBAH DATA KWITANSI</h2>
	<form method=POST action='<?php echo $aksi;?>?module=kwitansi&act=input'>

    <table width=100% style= "background-color: #333333">
	
	<?php
		$query_data_pegawai = mysql_query("SELECT sppd.id_sppd, detail_nppt.id_nppt, detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan, biaya.* FROM detail_nppt 
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan 
		JOIN sppd ON detail_nppt.id_nppt = sppd.id_nppt 
JOIN nppt ON sppd.id_nppt = nppt.id_nppt 
JOIN biaya ON nppt.id_tujuan = biaya.id_tujuan AND pegawai.id_jabatan = biaya.id_jabatan AND pegawai.id_pangkat = biaya.id_pangkat WHERE sppd.id_sppd = $_GET[id] ORDER BY detail_nppt.status_perintah ASC");
		$banyak_pegawai = 0;
		$total_keseluruhan = 0;
		$total_transportasi = 0;
		$total_harian = 0;
		$total_penginapan = 0;
		$total_lumpsum = 0;
		while($pegawai = mysql_fetch_array($query_data_pegawai)){
		$harian = $t['lama'] * $pegawai['harian'];
		$penginapan = ($t['lama']-1) * $pegawai['penginapan'];
		$transportasi = $pegawai['transportasi'];
		$lumpsum =  $pegawai['lumpsum'];
		
		$total_transportasi += $transportasi;
		$total_harian += $harian;
		$total_penginapan += $penginapan;
		$total_lumpsum += $lumpsum;
		
		$total_keseluruhan += ($harian+$penginapan+$transportasi+$lumpsum);
		$banyak_pegawai++;
	?>
	<!-- Bagian data pegawai -->
        <tr>
            <td style="border-color: #333; padding: 5px;">Nama Pegawai</td>
            <td style="border-color: #333; padding: 5px;"><?php echo $pegawai['nama']; ?>
                <input type='hidden' name='id_pegawai' value='<?php echo $_GET[id_pegawai]; ?>'>
                <input type='hidden' name='id_sppd' value='<?php echo $t[id_sppd]; ?>'>
            </td>
        </tr>
        <tr>
            <td  style="border-color: #333; padding: 5px;">Pangkat </td>
            <td  style="border-color: #333; padding: 5px;"><?php echo $pegawai['pangkat']; ?></td>
        </tr>
        <tr>
            <td  style="border-color: #333; padding: 5px;">Jabatan </td>
            <td  style="border-color: #333; padding: 5px;"><?php echo $pegawai['jabatan']; ?></td>
        </tr>
        <tr>
            <td  style="border-color: #333; padding: 5px;">Dari/Ke </td>
            <td  style="border-color: #333; padding: 5px;">Padang / <?php echo $t[tujuan]; ?>
               
            </td>
        </tr>
        <tr>
            <td  style="border-color: #333; padding: 5px;">Lama Perjalanan </td>
            <td  style="border-color: #333; padding: 5px;"><?php echo $t[lama]; ?> hari
                
            </td>
        </tr>
<tr>
  <td  style="border-color: #333; padding: 5px;">harian</td>
  <td  style="border-color: #333; padding: 5px;"><?php echo $t['lama']." X Rp ".number_format($pegawai['harian'] ,0,'','.'); ?></td>
</tr>
<tr>
  <td  style="border-color: #333; padding: 5px;">Total Uang Harian</td>
  <td  style="border-color: #333; padding: 5px;"><input type='text' name='' value='Rp <?php echo number_format($pegawai['harian']*$t['lama'] ,0,'','.'); ?>' style="background-color: #333333" readonly>
    
  </td>
</tr>
<tr>
  <td  style="border-color: #333; padding: 5px;">Uang Penginapan</td>
  <td  style="border-color: #333; padding: 5px;"><?php echo ($t['lama']-1)." x Rp ".number_format($pegawai['penginapan'] ,0,'','.')?></td>
</tr>
<tr>
  <td  style="border-color: #333; padding: 5px;">Total Uang Penginapan</td>
  <td  style="border-color: #333; padding: 5px;"><input type='text' name='' value='Rp <?php echo number_format($pegawai['penginapan']*($t['lama']-1) ,0,'','.')?>' style="background-color: #333333" readonly>
    
  </td>
</tr>
<tr>
  <td  style="border-color: #333; padding: 5px;">Transportasi</td>
  <td  style="border-color: #333; padding: 5px;">Rp <?php echo number_format($pegawai['transportasi'] ,0,'','.')?></td>
</tr>
<tr>
  <td  style="border-color: #333; padding: 5px;">Total Transportasi</td>
  <td  style="border-color: #333; padding: 5px;"><input type='text' name='' value='Rp <?php echo number_format($pegawai['transportasi'] ,0,'','.')?>' style="background-color: #333333" readonly>
    
  </td>
</tr>
</td></tr>
<tr>
  <td  style="border-color: #333; padding: 5px;">Lumpsum</td>
  <td  style="border-color: #333; padding: 5px;">Rp <?php echo number_format($pegawai['lumpsum'] ,0,'','.')?></td>
</tr>
<tr>
  <td  style="border-color: #333; padding: 5px;">Total Lumpsum</td>
  <td  style="border-color: #333; padding: 5px;"><input type='text' name='' value='Rp <?php echo number_format($pegawai['lumpsum'] ,0,'','.')?>' style="background-color: #333333" readonly>
    
  </td>
</tr>
<tr>
  <td  style="border-color: #333; padding: 5px;">Total Biaya</td>
  <td  style="border-color: #333; padding: 5px;">Rp 
	<?php echo  number_format(($harian+$penginapan+$transportasi+$lumpsum) ,0,'','.'); ?>
  </td>
</tr>
<tr>
  <td  style="border-color: #333; padding: 5px;">  <br/> </td>
  <td  style="border-color: #333; padding: 5px;">  <br/> </td>
</tr>
<!-- akhir dari Bagian data pegawai -->
<?php
		}
?>

<tr>
  <td style="border-color: #333; padding: 5px;">Total Biaya Keseluruhan</td>
  <td style="border-color: #333; padding: 5px;">Rp 
	<?php echo number_format(($total_keseluruhan) ,0,'','.'); ?>
  </td>
</tr>
<tr>
  <td style="border-color: #333; padding: 5px;">Sudah di Terima dari</td>
  <td style="border-color: #333; padding: 5px;"><textarea name='dari' style="background-color: #333333">BENDAHARA PENGELUARAN DP3AP2KB KOTA PADANG</textarea></td>
</tr>
<tr>
  <td style="border-color: #333; padding: 5px;">Untuk Pembayaran</td>
  <td style="border-color: #333; padding: 5px;"><textarea name='untuk' style="background-color: #333333"></textarea></td>
</tr>
<tr>
  <td style="border-color: #333; padding: 5px;"></td>
  <td style="border-color: #333; padding: 5px;"><input type=submit name=submit value=Simpan  class='btn btn-success'>
    <input type=button value=Batal onclick=self.history.back()  class='btn btn-warning'>
  </td>
</tr>
</table>

<input type='hidden' name='penginapan' value='<?php echo ($total_penginapan)?>'>
<input type='hidden' name='transportasi' value='<?php echo ($total_transportasi)?>'>
<input type='hidden' name='harian' value='<?php echo ($total_harian)?>'>
<input type='hidden' name='lumpsum' value='<?php echo ($total_lumpsum)?>'>
<input type='hidden' name='tujuan' value='<?php echo $t[tujuan]; ?>'>
<input type='hidden' name='lama' value='<?php echo $t[lama]; ?>'>

</form>
<?php
     break;
}
?>
