<?php
$aksi="modul/mod_nppt/aksi_nppt.php";
$print ="modul/mod_nppt/cetak.php";

switch($_GET[act]){
  // Tampil nppt
  default:
      $tampil = mysql_query("SELECT * FROM nppt n LEFT JOIN tujuan tu ON n.id_tujuan=tu.id_tujuan LEFT JOIN pegawai pg ON n.id_pegawai=pg.id_pegawai LEFT JOIN pangkat pa ON pg.id_pangkat=pa.id_pangkat LEFT JOIN jabatan j ON pg.id_jabatan=j.id_jabatan ORDER BY id_nppt DESC");
  echo   "<h2>NOTA PERMINTAAN PERJALANAN DINAS</h2>
          <input type=button value='Tambah Data' class='btn btn-success'
          onclick=\"window.location.href='?module=tambahnppt';\"><br /><br />";
   echo "
    <table id=\"example1\" class=\"table table-bordered table-hover\">
          <thead align='center' ><tr><th align='center'>No</th><th align='center' >Nama Pegawai</th>
		  <th>Pangkat</th><th>Jabatan</th>
		  <th>Tujuan</th><th>Maksud Perjalanan Dinas</th><th>Tanggal Pergi</th><th>Tanggal Kembali</th><th>Lama</th><th>Tanggal Dibuat</th><th>Status</th><th>Aksi</th></tr></thead>"; 
    $no=1;
	echo "<tbody>";
	
    while ($r=mysql_fetch_array($tampil)){
		echo "<tr>";
		echo "<td style=\"background-color: #333333\">$no</td>";
		
		// Kolom nama pegawau
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
		
		
		echo "<td style=\"background-color: #333333\">$r[tujuan]</td>
			 <td style=\"background-color: #333333\">$r[maksud]</td>
			 <td align='center' style=\"background-color: #333333\">$r[tgl_pergi]</td>
			 <td align='center' style=\"background-color: #333333\">$r[tgl_kembali]</td>
			 <td style=\"background-color: #333333\">$r[lama] hari, ".($r['lama']-1)." malam  </td>
			 <td align='center' style=\"background-color: #333333\">$r[tgl_dibuat]</td>
			 <td align='center' style=\"background-color: #333333\">";
			 if ($r['status']== 'Y') {
				echo "<div style='color:#00000'>Terverifikasi</div>";
			 }else{
				 if ($_SESSION['level']=="kabag"){
				echo "<a href=$aksi?module=nppt&act=editstatus&id=$r[id_nppt]&status=Y onClick=\"return confirm('Apakah Anda Mensetujui SPT ini?')\">N</a>";
				 }else{
				echo "<div style='color:#1693D1'>Belum Di Setujui</div>";
				 }
			 }
		echo "</td>
<td align='right' style=\"background-color: #333333\"><a href=$print?module=nppt&act=print&id=$r[id_nppt] target=\"_blank\" ><span class=\"glyphicon glyphicon-print\"></a> 
&nbsp;<a href=?module=nppt&act=editnppt&id=$r[id_nppt]><span class=\"glyphicon glyphicon-edit\"></a>
&nbsp;<a href=$aksi?module=nppt&act=hapus&id=$r[id_nppt] onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><span class=\"glyphicon glyphicon-trash\"></a></td>
			 </tr>";
      $no++;
    }
    echo "</tbody></table>";
    break;
  case "editnppt":
    $edit=mysql_query("SELECT * FROM nppt WHERE id_nppt='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Data Nota Permintaan Perjalanan Dinas</h2>
       <div class='box box-solid box-primary'>
        <div class='box-header'>
          <h3 class='box-title'>Form Edit NPPT</h3>
        </div>
        <div class='box-body' style=\"background-color: #333333\">
		<div align='center'>
          <form method=POST action='$aksi?module=nppt&act=update' onsubmit='return checkForm(this);'>
          <input type=hidden name=id value='$r[id_nppt]'>
		  <table width=100%>
		  <tr style=\"background-color: #333333\"><th width='250'><b>Pilih Data Pegawai</b></th></tr>
		  <tr style=\"background-color: #333333\"><td valign='top' style='padding-left:4px' >";
			  $id2=explode("-",$r['id_pegawai']);
			  echo "$data<br>";
			  $tam1=mysql_query("select a.*,b.*, c.pangkat,
d.jabatan from detail_nppt a 
right join pegawai b on a.id_pegawai = b.id_pegawai 
join pangkat c on b.id_pangkat = c.id_pangkat 
join jabatan d on b.id_jabatan = d.id_jabatan");
			  while ($k=mysql_fetch_array($tam1)) {
				$selected = "";
				if($k['id_nppt'] == $_GET['id']){
				  $selected = "checked='checked'";
				  echo "<input type='checkbox' name='id_pegawai[]' value='$k[id_pegawai]' $selected onclick='isiPegawai()'> <span name='nm_pegawai'> $k[nama] / $k[pangkat] / $k[jabatan]</span><br/>";
				}
				else{
		 		  echo "<input type='checkbox' name='id_pegawai[]' value='$k[id_pegawai]' onclick='isiPegawai()'> <span name='nm_pegawai'> $k[nama] / $k[pangkat] / $k[jabatan]</span><br/>";
				}

			  }	
	echo  "</td>
		  
							
							
							<div class='box-body' style=\"background-color: #333333\">
		<div align='center'>
          <form method=POST action=$aksi?module=nppt&act=update>
          <input type=hidden name=id value='$r[id_nppt]'>
		  <table width=100%>
		  <tr style=\"background-color: #333333\"><th><b>Isi Data Berikut Ini</b></th></tr>
		  
		  <td style=\"background-color: #333333\">
          <table class='table2'>
		  <tr style=\"background-color: #333333\">
			<td>Pegawai Yang Diperintahkan</td>
			<td>
				<select name='id_pemimpin' style=\"background-color: #333333\"></select>
			</td>
		  </tr>
		  <tr style=\"background-color: #333333\"><td>Tempat Tujuan</td><td><select name='tujuan' style=\"background-color: #333333\">";
		  $tampil=mysql_query("SELECT * FROM tujuan");
		   if ($r[id_tujuan]==0){
		   echo "<option value=0 selected>- Pilih Kategori -</option>"; }   
		
		   while($w=mysql_fetch_array($tampil)){
		   if ($r[id_tujuan]==$w[id_tujuan]){
		   echo "<option value=$w[id_tujuan] selected>$w[tujuan]</option>";}
		   else{
		   echo "<option value=$w[id_tujuan]>$w[tujuan]</option> </p> ";}}
		
		   echo "</select>";
		   echo "</td></tr>
          <tr style=\"background-color: #333333\"><td>Maksud Perjanalan Dinas</td><td><input type=text name='maksud' value='$r[maksud]' size=80 style=\"background-color: #333333\"></td></tr>
		  <tr style=\"background-color: #333333\"><td>Tipe Transportasi</td><td valign='top'>";
			  $id2=explode("-",$r['id_transportasi']);
			  echo "$data";
			  $tam1=mysql_query("SELECT * FROM transportasi");
			  while ($k=mysql_fetch_array($tam1)) {
				  $selected = "";
				  if (in_array($k['id_transportasi'],$id2)) {
					  $selected = "checked='checked'";
		 		 echo "<input type='checkbox' name='id_transportasi[]' value='$k[id_transportasi]' $selected>$k[transportasi]<br/>";
				  }else{
		 		 echo "<input type='checkbox' name='id_transportasi[]' value='$k[id_transportasi]'>$k[transportasi]<br/>";
				}

			  }	
	echo  "</td></tr>
          <tr style=\"background-color: #333333\"><td>Lama Perjalanan</td><td><input type=text id='lama' name='lama' value='$r[lama]' size=4 style=\"background-color: #333333\">&nbsp; Hari</td></tr>
          <tr style=\"background-color: #333333\"><td>Malam Perjalanan</td><td><input type=text id='malam' name='malam' size=4 style=\"background-color: #333333\">&nbsp; Hari</td></tr>
          <tr style=\"background-color: #333333\"><td>Tanggal Berangkat</td><td><input type=text name='tgl_pergi' id='tgl_pergi' value='$r[tgl_pergi]' size=10 style=\"background-color: #333333\"> <span class='glyphicon glyphicon-calendar'></span></td></tr>
          <tr style=\"background-color: #333333\"><td>Tanggal Kembali</td><td><input type=text name='tgl_kembali' id='tgl_kembali' value='$r[tgl_kembali]' size=10 style=\"background-color: #333333\"> <span class='glyphicon glyphicon-calendar'></span></td></tr>
		  <tr style=\"background-color: #333333\"><td>Tanggal Dibuat</td><td><input type=text name='tgl_dibuat' id='tgl_dibuat' value='$r[tgl_dibuat]' size=10 style=\"background-color: #333333\"> <span class='glyphicon glyphicon-calendar'></span></td></tr>
		  <tr style=\"background-color: #333333\"><td></td><td></br></br><input type=submit name=submit value=Update class='btn btn-success'>
                            <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
							
							
          </table class='table2'>
		  </td>
		  </tr>
          
		  </table></form></div></div></div>";
		  ?>
<script>
function isiPegawai(){
	var data = document.getElementsByName("id_pegawai[]");
	var banyak = data.length;
	var pilih_pegawai = document.getElementsByName("id_pemimpin")[0];
	pilih_pegawai.innerHTML = "";
	for(var x = 0;x < banyak; x++){
		if(data[x].checked)
		{
			pilih_pegawai.innerHTML += "<option value='" + data[x].value + "'>" + document.getElementsByName("nm_pegawai")[x].innerHTML + "</option>";
		}
	}
}
isiPegawai();
document.getElementsByName("id_pemimpin")[0].value = "<?php echo $r['id_pegawai_perintah']; ?>";	  
		  <?php
	if(isset($_GET['hasil_cek'])){
?>
alert("Tidak Bisa Diinputkan Karena Jadwal Bentrok");
<?php
	}
?>
var tgl_dibuat = new Pikaday({
	field: document.getElementById('tgl_dibuat'),
	format: 'YYYY-MM-DD',
});
 var tanggal  = new Pikaday({
        field: document.getElementById('tgl_pergi'),
        format: 'YYYY-MM-DD',
      });
      var tgl_kembali = new Pikaday({
        field: document.getElementById('tgl_kembali'),
        format: 'YYYY-MM-DD'
      });
      
      // Disable date before tanggal 
      document.getElementById("tgl_pergi").addEventListener("change", function(){
        tgl_kembali.setMinDate(moment(this.value).toDate());
	tgl_dibuat.setMaxDate(moment(this.value).toDate());
      })
      document.getElementById("tgl_kembali").addEventListener("change", function(){
        var tanggal  = moment(document.getElementById("tgl_pergi").value);
        var tgl_kembali = moment(this.value);
        var hari = tgl_kembali.diff(tanggal , 'days');
		// lebihkan hari
		hari++;
		var malam = hari - 1;
        document.getElementById("malam").value = malam;
        document.getElementById("lama").value = hari;
      })
</script>
		  <?php
    break;  
}
?>