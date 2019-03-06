<?php
$aksi="modul/mod_spt/aksi_spt.php";
$print ="modul/mod_spt/cetak.php";

switch($_GET[act]){
  // Tampil spt
  default:
  
  if ($_SESSION['level']=="operator") {
      $tampil = mysql_query("SELECT * FROM spt");
  echo   "<h2>SURAT PERINTAH TUGAS</h2>
          ";
    echo "
    <table id=\"example1\" class=\"table table-bordered table-hover\">
          <thead><tr><th>No</th><th>Nama</th>
		  <th>Pangkat</th><th>Jabatan</th>
		  <th>Pejabat Perintah</th><th>No SPT</th><th>Diperintahkan Untuk</th></th><th>Dasar Surat Perintah</th><th>Tempat</th><th>Dasar Pembebanan Anggaran</th><th>aksi</th><th>SPPD</th></tr></thead>"; 
     $no=1;
	echo "<tbody>";
	
    while ($r=mysql_fetch_array($tampil)){
		echo "<tr>";
		echo "<td style=\"background-color: #333333\">$no</td>";
		
		// Kolom nama pegawai
		// ambil data pegawai per nppt 
		echo "<td style='background-color: #333333;'>";
		$no_pegawai = 1;
		// daftar pegawai
		$data_pegawai = mysql_query("SELECT detail_nppt.id_pegawai, pegawai.nama, pangkat.pangkat, jabatan.jabatan FROM detail_nppt 
			JOIN pegawai ON detail_nppt.id_pegawai = pegawai.id_pegawai 
			JOIN pangkat ON pegawai.id_pangkat = pangkat.id_pangkat 
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE detail_nppt.id_nppt = $r[id_nppt] ORDER BY detail_nppt.status_perintah ASC");
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
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE detail_nppt.id_nppt = $r[id_nppt] ORDER BY detail_nppt.status_perintah ASC");
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
			JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan WHERE detail_nppt.id_nppt = $r[id_nppt] ORDER BY detail_nppt.status_perintah ASC");
		while($pegawai = mysql_fetch_array($data_pegawai)){
			// detail pangkat dll
			echo "$no_pegawai. $pegawai[jabatan] <br/>";
			$no_pegawai++;
		}
		echo "</td>";
		// akhir dari kolom jabatan
	   
	  echo "	<td style=\"background-color: #333333\">$r[pejabat_perintah]</td>
	  		<td style=\"background-color: #333333\">$r[no_spt]</td>
		     <td style=\"background-color: #333333\">$r[tugas]</td>
			 <td style=\"background-color: #333333\">$r[dasar_hukum]</td>
			 <td style=\"background-color: #333333\">$r[tempat]</td>
			 <td style=\"background-color: #333333\">$r[pembebanan_anggaran]</td>
			 <td style=\"background-color: #333333\">
<a href=$print?module=spt&act=print&id=$r[id_spt] target=\"_blank\" ><span class=\"glyphicon glyphicon-print\"></a> 
&nbsp;<a href=?module=spt&act=editspt&id=$r[id_spt]><span class=\"glyphicon glyphicon-edit\"></a>
&nbsp;<a href=$aksi?module=spt&act=hapus&id=$r[id_spt] onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><span class=\"glyphicon glyphicon-trash\"></a>
 <td style=\"background-color: #333333\">";
 $cek=mysql_fetch_array(mysql_query("SELECT * FROM sppd WHERE id_nppt='$r[id_nppt]'"));
 if ($cek > 0) {
 echo "sppd sudah dibuat";
 }
 elseif ($r['no_spt'] != "") {
 echo "<input type=button value='Buat SPPD' style=\"background-color: #0000FF\"
          onclick=\"window.location.href='?module=sppd&act=tambahsppd&id=$r[id_spt]';\">";
 }elseif ($r['no_spt']== ""){
	echo "No SPT Kosong";	 
 }
echo "
</td></tr>";
      $no++;
    }
    echo "</tbody></table>";
  }
  else {
  $tampil = mysql_query("SELECT * FROM spt,nppt WHERE spt.id_nppt=nppt.id_nppt AND spt.id_pegawai LIKE '%$_SESSION[id_pegawai]%'");
  echo   "<h2>SURAT PERINTAH TUGAS</h2>
  		  <table id=\"example1\" class=\"table table-bordered table-hover\">
          <thead><tr><th>No</th><th>No SPT</th><th>Tugas</th><th>T.Pergi</th><th>T.Kembali</th>
		  <th>Lama</th><th>Laporan</th></tr></thead>"; 
    $no=0;
	echo "<tbody>";
    while ($r=mysql_fetch_array($tampil)){
		$no++;
	  echo "<tr>
	  		 <td style=\"background-color: #333333\">$no</td>
	  		 <td style=\"background-color: #333333\">$r[no_spt]</td>
		     <td style=\"background-color: #333333\">$r[tugas]</td>
			 
			 <td style=\"background-color: #333333\">$r[tgl_pergi]</td>
			 <td style=\"background-color: #333333\">$r[tgl_kembali]</td>
			 <td style=\"background-color: #333333\">$r[lama] hari</td>
			 <td style=\"background-color: #333333\">";
			 $cek=mysql_num_rows(mysql_query("SELECT * FROM lpd WHERE id_spt='$r[id_spt]'"));
			 if ($cek > 0 ) {
			  echo "<img src='images/ico_active_16.png'>";
			 }else {
			 echo "
				<input type=button value='Buat Laporan' style=\"background-color: #0000ff\"
				  onclick=\"window.location.href='?module=lpd&act=tambahlpd&id=$r[id_spt]';\">";	
			 }
			 echo "</td></tr>";
	}
	echo "</tbody></table>";
  }
    break;
	
  case "tambahspt":
    echo "
	<h2>Tambah Data SPT</h2>
       <div class='box box-solid box-primary'>
        <div class='box-header'>
          <h3 class='box-title'>Form Tambah Data SPT</h3>
        </div>
        <div class='box-body'>
		<div align='center'>          
		<form method=POST action='$aksi?module=spt&act=input'>
		  <table>
		  <tr align='center'><th>Pilih Data Pegawai</th><th>Isi Data Berikut</th></tr>
		  <tr><td valign='top' style='padding-left:4px'>";
		  $sql=mysql_query("SELECT * FROM pegawai");
		  while($r=mysql_fetch_array($sql)) {
		  echo "<input type='checkbox' name='id_pegawai[]' value='$r[id_pegawai]'> $r[nama]<br/>";  
			  
		  }
	echo  "</td>
		  <td>
          <table width=600px class='table2'>
          <tr>
			<td>No spt</td>
			<td><input type=text name='no_spt' size=45 required /></td>
		  </tr>
		  <tr><td>Pejabat Perintah<br/><input type=text name='pejabat_perintah' size=45 required /></td></tr>
		  
          <tr><td>Untuk<br /> <textarea name='tugas' style='width: 750px; height: 100px;'></textarea></td></tr>
		  <tr><td>Dasar<br /><textarea name='dasar_hukum' style='width:750px;height:150px'></textarea></td></tr>
		  <tr><td>Tempat<br/><input type=text name='tempat' size=45 required /></td></tr>
		  <tr><td>Pembebanan Anggaran<br /><textarea name='pembebanan_anggaran' style='width:750px;height:150px'></textarea></td></tr>
          </table>
		  </td>
		  </tr>
          <tr><td></td><td><input type=submit name=submit value=Simpan class='btn btn-success'>
                            <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
		  </table></form></div></div></div>
		  ";
     break;
  case "editspt":
    $edit=mysql_query("SELECT a.*, c.tujuan FROM spt a JOIN nppt b ON a.id_nppt = b.id_nppt JOIN tujuan c on b.id_tujuan = c.id_tujuan WHERE id_spt='$_GET[id]'");
    $c=mysql_fetch_array($edit);

    echo "
	<h2>Edit SPT</h2>
       <div class='box box-solid box-primary'>
        <div class='box-header'>
          <h3 class='box-title'>Form Edit Data SPT</h3>
        </div>
		<div class='box-body' style=\"background-color: #333333\">
			  <div align='center'>          <form method=POST action='$aksi?module=spt&act=update' onsubmit='return checkForm(this);'>
		  <table width=100%>
		  <tr align='center'><th><b>PILIH DATA PEGAWAI</b></th></tr>
		  <tr style=\"background-color: #333333\"><td valign='top' style='padding-left:4px' >
		  <div style='overflow:auto;' >";
		 if ($_GET['id']=="") {
		   $sql=mysql_query("SELECT a.*, b.jabatan, c.pangkat FROM pegawai a  
			JOIN pangkat c on a.id_pangkat = c.id_pangkat 
			JOIN jabatan b on a.id_jabatan = b.id_jabatan");
		   while ($t=mysql_fetch_array($sql)) {
		  echo "<input type='checkbox' name='id_pegawai[]' value='$r[id_pegawai]' > $t[nama] / $t[jabatan] / $t[pangkat]<br/>"; 
		   }
		  }else{
		  $sql=mysql_query("SELECT c.*, d.pangkat, e.jabatan FROM spt a RIGHT JOIN detail_nppt b on a.id_nppt = b.id_nppt join pegawai c on b.id_pegawai = c.id_pegawai 
			JOIN pangkat d on c.id_pangkat = d.id_pangkat 
			JOIN jabatan e on c.id_jabatan = e.id_jabatan  WHERE a.id_spt = '$_GET[id]'");
		  $nomer= 0;
		  while($r=mysql_fetch_array($sql)) {
			$value =explode('-',$r['id_pegawai']);
			
			$nomer++;
			echo "<input type='checkbox' name='id_pegawai[]' value='$r[id_pegawai]' checked='checked'> $r[nama] / $r[jabatan] / $r[pangkat] <br/>";  
		  }
	echo  "</td>";
		  }
		
		echo"
        <div class='box-body' style=\"background-color: #333333\">
		<div align='center'>          
          <form method=POST action=$aksi?module=spt&act=update>
          <input type=hidden name=id value='$c[id_spt]'>
		  <table width='100%'>
		  <tr><th><b>Isi Data Berikut</b></th></tr>
		  
		  <td style=\"background-color: #333333\" align='center'>
          <table width=600px >
          <tr style=\"background-color: #333333\" >
			<td>No Spt</td>
			<td><input type=text name='no_spt' size=45 value='$c[no_spt]' style=\"background-color: #333333\"></td>
		  </tr>
		  <tr style=\"background-color: #333333\">
			<td>Pejabat Perintah </td>
			<td><input type=text name='pejabat_perintah' value='Sekretariat Daerah Kota Padang' size=45 value='$c[pejabat_perintah]' style=\"background-color: #333333\"></td>
		  </tr>
          <tr style=\"background-color: #333333\">
			<td>Untuk </td>
			<td> <textarea name='tugas' style=\"background-color: #333333\" >$c[tugas]</textarea></td>
		  </tr>
		  <tr style=\"background-color: #333333\">
		    <td>Dasar </td>
		    <td> <textarea name='dasar_hukum' style=\"background-color: #333333\" >$c[dasar_hukum]</textarea></td>
		  </tr>
		  <tr style=\"background-color: #333333\">
		    <td>Tempat</td>
			<td><input type=text name='tempat' size=45 value='$c[tujuan]' style=\"background-color: #333333\"></td>
		  </tr>
		  <tr style=\"background-color: #333333\">
		    <td>Pembebanan Anggaran</td>
			<td><textarea name='pembebanan_anggaran' style=\"background-color: #333333\">$c[pembebanan_anggaran]</textarea></td>
		  </tr>
					<tr style=\"background-color: #333333\" align='center'><td colspan='2'></br><input type=submit name=submit value=Update  class='btn btn-success'>
                            <input type=button value=Batal onclick=self.history.back()  class='btn btn-warning'></td></tr>
							
							
		  				
							
          </table>
		  </td>
		  </tr>
          
		  </table></form></div></div></div>";
    break;  
}
?>
