<?php
$aksi="modul/mod_pegawai/aksi_pegawai.php";
$aksi2="modul/mod_pegawai/cetak.php";
switch($_GET[act]){
  // Tampil Pegawai
  default:
      $tampil = mysql_query("SELECT * FROM pegawai,jabatan,pangkat WHERE pegawai.id_jabatan=jabatan.id_jabatan AND pegawai.id_pangkat=pangkat.id_pangkat");
	 
  echo   "<h2>DATA PEGAWAI</h2>
          <input type=button value='Tambah Data Pegawai' class='btn btn-success'
          onclick=\"window.location.href='?module=pegawai&act=tambahPegawai';\">
		  <div style='float:right'>
          
		  </div><br /><br />
    <table id=\"example1\" class=\"table table-bordered table-hover\">
          <thead><tr><th>No</th><th>NIP</th><th>Nama</th><th>Pangkat</th><th>Jabatan</th><th>Unit Kerja</th><th>Username</th><th>Password</th><th>Foto</th><th>aksi</th></tr></thead>"; 
    $no=1;
	echo "<tbody>";
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nip]</td>
             <td>$r[nama]</td>
		     <td>$r[pangkat]</td>
			 <td>$r[jabatan]</td>
			 <td>$r[unitkerja]</td>	 
			 <td>$r[username]</td>
			 <td>$r[password]</td>
			 <td>$r[foto]</td>
             <td><a href=?module=pegawai&act=editPegawai&id=$r[id_pegawai]><span class=\"glyphicon glyphicon-edit\"></a>
			 <a href=$aksi?module=pegawai&act=hapus&id=$r[id_pegawai] onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><span class=\"glyphicon glyphicon-trash\"></a></td></tr>";
      $no++;
    }
    echo "</tbody></table>";
    break;
  case "tambahPegawai":
echo "	<h2>TAMBAH DATA PEGAWAI</h2>
       <div class='box box-solid box-primary'>
        <div class='box-header'>
          <h3 class='box-title'>Form Input Pegawai</h3>
        </div>
        <div class='box-body'>
		<div align='center'>
          <form method=POST action='$aksi?module=pegawai&act=input'>
          <table class='table2'>
          <tr><td width='150'>NIP</td><td><input type=text name='nip' size=45 required /></td></tr>
          <tr><td>Nama</td><td><input type=text name='nama' size=30 required /></td></tr>
          
		  </select></td></tr>
		  <tr><td>Jabatan</td><td><select name='jabatan' required />
			  <option value=0 selected>Pilih Kategori</option>";
			   $tampil=mysql_query("SELECT * FROM jabatan");
			   while($r=mysql_fetch_array($tampil)){
			   echo "<option value=$r[id_jabatan]>$r[jabatan]</option></p>"; }
   echo "</select>";
   
 		  echo "</select></td></tr>
		  <tr><td>Pangkat</td><td><select name='pangkat' required />
			  <option value=0 selected>Pilih Kategori</option>";
			   $tampil=mysql_query("SELECT * FROM pangkat");
			   while($r=mysql_fetch_array($tampil)){
			   echo "<option value=$r[pangkat]>$r[pangkat]</option></p>"; }
   
   echo "</select>";
   
   
   
echo " 
  	   <tr><td>Unit Kerja</td><td><input type=text name='unitkerja' size=65 required /></td></tr>
	   <tr><td>Foto</td><td><input type=file  name='foto' size=65 required /></td></tr>
          <tr><td></td><td><input type=submit name=submit value=Simpan class='btn btn-danger'>
                            <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
          </table></form>
		  </div></div></div>";
     break;
  case "editPegawai":
    $edit=mysql_query("SELECT * FROM Pegawai WHERE id_Pegawai='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "
	<h2>EDIT DATA PEGAWAI</h2>
       <div class='box box-solid box-primary'>
        <div class='box-header'>
          <h3 class='box-title'>Form Edit Pegawai</h3>
        </div>
        <div class='box-body'>
		<div align='center'>
          <form method=POST action=$aksi?module=pegawai&act=update>
          <input type=hidden name=id value='$r[id_pegawai]'>
		  <table class='table2'>
          <tr><td width=150>NIP</td><td><input type=text name='nip' value='$r[nip]' size=45 required /></td></tr>
          <tr><td>Nama</td><td><input type=text name='nama' value='$r[nama]' size=30 required /></td></tr>
          <tr><td>Pangkat</td><td><select name='pangkat'>";
		  $tampil2=mysql_query("SELECT * FROM pangkat");
		   if ($r[pangkat]==0){
		   echo "<option value=0 selected>- Pilih Kategori -</option>"; }   
		
		   while($wq=mysql_fetch_array($tampil2)){
		   if ($r[pangkat]==$wq[pangkat]){
		   echo "<option value=$wq[pangkat] selected>$wq[pangkat]</option>";}
		   else{
		   echo "<option value=$wq[pangkat]>$wq[pangkat]</option> </p> ";}}
		
		   echo "</select></td></tr>
		  <tr><td>Jabatan</td><td> <select name='jabatan'>";
		  $tampil=mysql_query("SELECT * FROM jabatan");
		   if ($r[id_jabatan]==0){
		   echo "<option value=0 selected>- Pilih Kategori -</option>"; }   
		
		   while($w=mysql_fetch_array($tampil)){
		   if ($r[id_jabatan]==$w[id_jabatan]){
		   echo "<option value=$w[id_jabatan] selected>$w[jabatan]</option>";}
		   else{
		   echo "<option value=$w[id_jabatan]>$w[jabatan]</option> </p> ";}}
		
		   echo "</select>";	
		   
		   		   
echo " 
		  <tr><td>Unit Kerja</td><td><input type=text name='unitkerja' value='$r[unitkerja]' size=65 required /></td></tr>
		  <tr><td>Foto</td><td><input type=file name='foto' value='$r[foto]' size=65 required /></td></tr>
          <tr><td></td><td><input type=submit value=Update class='btn btn-danger'>
                            <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
          </table>
		  </form></div></div></div>";     
    break;  
}
?>
