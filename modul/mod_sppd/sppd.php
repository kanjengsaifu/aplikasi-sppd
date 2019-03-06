<?php
$aksi="modul/mod_sppd/aksi_sppd.php";
$print ="modul/mod_sppd/cetak.php";

switch($_GET[act]){
  // Tampil sppd
  default:
      $tampil = mysql_query("SELECT * FROM sppd,nppt,pegawai,tujuan WHERE sppd.id_nppt=nppt.id_nppt AND pegawai.id_pegawai=sppd.id_pegawai AND nppt.id_tujuan=tujuan.id_tujuan");
  echo   "<h2>SURAT PERINTAH PERJALANAN DINAS</h2>
          ";
    echo "
    <table id=\"example1\" class=\"table table-bordered table-hover\">
          <thead><tr><th>No</th><th>Nama</th>
		  <th>Pangkat</th><th>Jabatan</th><th>Pejabat Yang Memberi Perintah</th>
		  <th>Nomor</th><th>Maksud Perjalanan Dinas</th><th>Tempat Tujuan</th><th>Tanggal Berangkat</th><th>Tanggal Kembali</th><th>Lama Perjalanan</th><th>Instansi</th><th>Mata Anggaran</th><th>Cetak</th><th>Hapus</th><th>Kwitansi</th></tr></thead>"; 
     $no=1;
	echo "<tbody>";
   while ($r=mysql_fetch_array($tampil)){
	$value =explode('-',$r['id_pegawai']);
	
       echo "<tr>
	        <td style=\"background-color: #333333\">$no</td>";
             
			 
	// Kolom nama pegawau
		// ambil data pegawai per nppt 
		echo "<td style='background-color: #333333;'>";
		$no_pegawai = 1;
		// daftar pegawai
		$data_pegawai = mysql_query("SELECT detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE detail_nppt.id_nppt = $r[id_nppt]");
		while($pegawai = mysql_fetch_array($data_pegawai)){
			// detail pangkat dll
			echo "$no_pegawai. $pegawai[nama] <br/>";
			$no_pegawai++;
		}
		echo "</td>";
		// akhir dari kolom pegawai
		
		// Kolom nama pangkat
		// ambil data pegawai per nppt 
		echo "<td style='background-color: #333333;'>";
		$no_pegawai = 1;
		// daftar pegawai
		$data_pegawai = mysql_query("SELECT detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE detail_nppt.id_nppt = $r[id_nppt]");
		while($pegawai = mysql_fetch_array($data_pegawai)){
			// detail pangkat dll
			echo "$no_pegawai. $pegawai[pangkat] <br/>";
			$no_pegawai++;
		}
		echo "</td>";
		// akhir dari kolom pangkat
		
		
		// Kolom nama jabatan
		// ambil data pegawai per nppt 
		echo "<td style='background-color: #333333;'>";
		$no_pegawai = 1;
		// daftar pegawai
		$data_pegawai = mysql_query("SELECT detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE detail_nppt.id_nppt = $r[id_nppt]");
		while($pegawai = mysql_fetch_array($data_pegawai)){
			// detail pangkat dll
			echo "$no_pegawai. $pegawai[jabatan] <br/>";
			$no_pegawai++;
		}
		echo "</td>";
		// akhir dari kolom jabatan
		
		
	
echo "	 </td>
			 <td style=\"background-color: #333333\">$r[pemberi_perintah]</td>
			 <td style=\"background-color: #333333\">$r[no_sppd]</td>
		     <td style=\"background-color: #333333\">$r[maksud]</td>
			 <td style=\"background-color: #333333\">$r[tujuan]</td>
			 <td style=\"background-color: #333333\">$r[tgl_pergi]</td>
			 <td style=\"background-color: #333333\">$r[tgl_kembali]</td>
			 <td style=\"background-color: #333333\">$r[lama] hari, ".($r['lama']-1)." malam</td>
			 <td style=\"background-color: #333333\">$r[instansi]</td>
			 <td style=\"background-color: #333333\">$r[mata_anggaran]</td>
             <td align='center' style=\"background-color: #333333\"><a href=$print?module=sppd&act=print&id=$r[id_sppd] target=\"_blank\" ><span class=\"glyphicon glyphicon-print\"></a></td>
			 <td align='center' style=\"background-color: #333333\"><a href=$aksi?module=sppd&act=hapus&id=$r[id_sppd] onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><span class=\"glyphicon glyphicon-trash\"></a></td>
			 <td align='center' style=\"background-color: #333333\">";
			 $cek=mysql_num_rows(mysql_query("SELECT * FROM kwitansi WHERE id_sppd='$r[id_sppd]'"));
			 if ($cek > 0 ) {
			  echo "<img src='images/ico_active_16.png'>";
			 }else {
			 echo "
			 <input type=button value='Buat Kwitansi' style=\"background-color: #0000FF\" 
          onclick=\"window.location.href='?module=kwitansi&act=tambahkwitansi&id=$r[id_sppd]&id_pegawai=$r[id_pegawai]';\">";
			 }
			 echo "</td></tr>";
      $no++;
    }
    echo "</tbody></table>";
    break;
  case "tambahsppd":
    echo "<h2>TAMBAH DATA SURAT PERINTAH PERJALANAN DINAS</h2>
       <div class='box box-solid box-primary'>
        <div class='box-header'>
          <h3 class='box-title'>Form Tambah Data SPPD</h3>
        </div>
        <div class='box-body' style=\"background-color: #333333\">
		<div align='center'>          <form method=POST action='$aksi?module=sppd&act=input'>
		  <table width=\"100%\">
		  <tr align='center'><th><b>Pilih Data Pegawai</b></th></tr>
		  <tr style=\"background-color: #333333\">
		  <td valign='top' style='padding-left:4px'>";
		  if ($_GET['id']=="") {
		   $sql=mysql_query("SELECT a.*, b.jabatan, c.pangkat FROM pegawai a  
			JOIN pangkat c on a.id_pangkat = c.id_pangkat 
			JOIN jabatan b on a.id_jabatan = b.id_jabatan");
		   while ($t=mysql_fetch_array($sql)) {
		  echo "<input type='checkbox' name='id_pegawai[]' value='$t[id_pegawai]'> $t[nama] / $t[jabatan] / $t[pangkat] <br/>"; 
		   }
		  }else{
		  $sql=mysql_query("SELECT c.*, d.pangkat, e.jabatan FROM spt a RIGHT JOIN detail_nppt b on a.id_nppt = b.id_nppt join pegawai c on b.id_pegawai = c.id_pegawai 
			JOIN pangkat d on c.id_pangkat = d.id_pangkat 
			JOIN jabatan e on c.id_jabatan = e.id_jabatan WHERE a.id_spt='$_GET[id]'");
		  $nomer= 0;
		  while($t=mysql_fetch_array($sql)) {
			$value =explode('-',$r['id_pegawai']);
			$nomer++;
		    echo "<input type='checkbox' name='id_pegawai[]' value='$t[id_pegawai]' checked='checked'>  $t[nama] / $t[jabatan] / $t[pangkat]<br/>";  
		  }
	echo  "</td></tr>";
		  }
  echo "</table>";
  echo "<table style='width: 100%;'>";
  echo "<tr><th><b>Isi Data Berikut</b></th></tr>";
  $sql=mysql_query("SELECT * FROM spt WHERE id_spt='$_GET[id]'");
  $r=mysql_fetch_array($sql);
    $edit=mysql_query("SELECT * FROM nppt,tujuan WHERE id_nppt='$r[id_nppt]' AND nppt.id_tujuan=tujuan.id_tujuan");
    $t=mysql_fetch_array($edit);
	echo "<tr style=\"background-color: #333333\">
		  <td style=\"background-color: #333333\">
		  <div align=\"center\" >
          <table class='table2'><input type=hidden name='id_nppt' value='$r[id_nppt]'>
          <tr style=\"background-color: #333333\"><td>Pejabat Yang Memberi Perintah</td><td> <input type=text name='pemberi_perintah' size=35 value='Sekretaris Daerah Kota Padang' required style=\"background-color: #333333\"/></td></tr>
		  <tr style=\"background-color: #333333\"><td>Nomor</td><td> <input type=text name='no_sppd' size=35 required style=\"background-color: #333333\"/></td></tr>
          <tr style=\"background-color: #333333\"><td>Tempat Tujuan</td><td> <input type=text name='tujuan' value='$t[tujuan]' size=35 style=\"background-color: #333333\"></td></tr>
          <tr style=\"background-color: #333333\"><td>Maksud Perjalanan Dinas</td><td> <input type=text name='maksud' value='$t[maksud]' size=60 style=\"background-color: #333333\"></td></tr>
          <tr style=\"background-color: #333333\"><td>Transportasi</td><td>";
		  if ($t['id_transportasi'] !="") {
				$value =explode('-',$t['id_transportasi']);
				for($i=0;$i<count($value);$i++) { 
				$data=$value[$i];
				$nomer++;
				   $sql=mysql_query("SELECT * FROM transportasi WHERE id_transportasi='$data'");
				   $r=mysql_fetch_array($sql);
				   echo "- $r[transportasi] ";
				   echo "<br/>";
				}
		  }else {
		  $sql=mysql_query("SELECT * FROM transportasi");
		  while($r=mysql_fetch_array($sql)) {
		  echo "<input type='checkbox' name='id_transportasi[]' value='$r[id_transportasi]'>$r[transportasi]<br/>";  
		  }
			  
		  }
			echo "</td></tr>
          <tr style=\"background-color: #333333\"><td>Lama Perjalanan</td><td><input type=text name='lama' value='$t[lama]' size=4 ' style=\"background-color: #333333\">&nbsp; Hari</td></tr>
		  
          <tr style=\"background-color: #333333\"><td>Tanggal Berangkat</td><td><input type=text name='tgl_pergi' id='tgl_pergi' value='$t[tgl_pergi]' size=10 ' style=\"background-color: #333333\"></td></tr>
          <tr style=\"background-color: #333333\"><td>Tanggal Kembali</td><td><input type=text name='tgl_kembali' id='tgl_kembali' value='$t[tgl_kembali]' size=10 ' style=\"background-color: #333333\"></td></tr>
          <tr style=\"background-color: #333333\"><td>Instansi</td><td><input type=text name='instansi' value='DP3AP2KB Kota Padang' size=45 style=\"background-color: #333333\"></td></tr>
          <tr style=\"background-color: #333333\"><td>Mata Anggaran</td><td><input type=text name='mata_anggaran' value='DP3AP2KB Kota Padang 2.02.2.02.01.01.18.5.2.2.15.02
' size=25 required style=\"background-color: #333333\"></td></tr>
          <tr style=\"background-color: #333333\"><td>Keterangan Lain</td><td> <textarea name='keterangan' style=\"background-color: #333333\"></textarea></td></tr>
		  <tr style=\"background-color: #333333\"><td></td><td><input type=submit name=submit value=Simpan class='btn btn-success'>
                            <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
          </table></div>
		  </td>
		  </tr>
          
		  </table></form></div></div></div>";
     break;
  case "editsppd":
    $edit=mysql_query("SELECT * FROM sppd WHERE id_sppd='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit sppd</h2>
    <div class='box box-success'>
		<div align='center'>
          <form method=POST action=$aksi?module=sppd&act=update>
          <input type=hidden name=id value='$r[id_sppd]'>
          <table>
          <tr><td>NIP</td><td> : <input type=text name='nip' value='$r[nip]' size=45></td></tr>
          <tr><td>Nama</td><td> : <input type=text name='nama' value='$r[nama]' size=30></td></tr>
          <tr><td>Pangkat</td><td> : <input type=text name='pangkat' value='$r[pangkat]' size=45></td></tr>
		  <tr><td>Golongan</td><td> : <input type=text name='golongan' value='$r[golongan]' size=10></td></tr>
		  <tr><td>Jabatan</td><td> : <input type=text name='jabatan' value='$r[jabatan]' size=45></td></tr>
		  <tr><td>Unit Kerja</td><td> : <input type=text name='unitkerja' value='$r[unitkerja]' size=45></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form></div></div>";     
    break;  
}
?>

