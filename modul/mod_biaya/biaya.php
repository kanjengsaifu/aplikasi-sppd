<?php
$aksi="modul/mod_biaya/aksi_biaya.php";

switch($_GET[act]){
  // Tampil biaya
  default:
      $tampil = mysql_query("SELECT * FROM biaya,jabatan,pangkat WHERE biaya.id_jabatan=jabatan.id_jabatan and biaya.id_pangkat=pangkat.id_pangkat");
	  
  echo   "<h2>BIAYA PERJALANAN DINAS</h2>
          <input type=button value='Tambah Data ' class='btn btn-success'
          onclick=\"window.location.href='?module=biaya&act=tambahbiaya';\"><br /><br />";
    echo "
    <table id=\"example1\" class=\"table table-bordered table-hover\">
          <thead><tr><th>No</th><th>Tujuan</th><th>Jabatan</th><th>Pangkat</th><th>Uang Harian</th><th>Uang Penginapan</th><th>Uang Transportasi</th><th>Lumpsum</th><th>aksi</th></tr></thead>"; 
    $no=1;
	echo "<tbody>";
    while ($r=mysql_fetch_array($tampil)){
	$value =explode('-',$r['id_tujuan']);
       echo "<tr><td style=\"background-color: #333333\">$no</td>
             <td style=\"background-color: #333333\">";
	$nomer= 0;
	for($i=0;$i<count($value);$i++) { 
	$data=$value[$i];
	$nomer++;
	   $sql=mysql_query("SELECT * FROM tujuan WHERE id_tujuan='$data'");
	   $t=mysql_fetch_array($sql);
	   echo "$t[tujuan]<br/> ";
	}
	   echo "</td>
	   
             <td style=\"background-color: #333333\">$r[jabatan]</td>
			 <td style=\"background-color: #333333\">$r[pangkat]</td>
			 <td style=\"background-color: #333333\">Rp. $r[harian]</td>
		     <td style=\"background-color: #333333\">Rp. $r[penginapan]</td>
		     <td style=\"background-color: #333333\">Rp. $r[transportasi]</td>
			 <td style=\"background-color: #333333\">Rp. $r[lumpsum]</td>
             <td style=\"background-color: #333333\"><a href=?module=biaya&act=editbiaya&id=$r[id_biaya]><span class=\"glyphicon glyphicon-edit\"></a>
			 <a href=$aksi?module=biaya&act=hapus&id=$r[id_biaya] onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><span class=\"glyphicon glyphicon-trash\"></a></td></tr>";
      $no++;
    }
    echo "</tbody></table>";
    break;
  case "tambahbiaya":
    echo "
	<h2>TAMBAH DATA BIAYA PERJALANAN DINAS</h2>
       <div class='box box-solid box-primary'>
        <div class='box-header'>
          <h3 class='box-title'>Form Input Biaya Perjalanan Dinas</h3>
        </div>
        <div class='box-body' style=\"background-color: #333333\">
		<div align='center'>
          <form method=POST action='$aksi?module=biaya&act=input'>
          <table width='90%' class='table2' style=\"background-color: #333333\">
		  <tr><td>Tujuan</td><td> <select name='id_tujuan' style=\"background-color: #333333\">
			  <option value=0 selected>Pilih Kategori</option>";
			   $tampil=mysql_query("SELECT * FROM tujuan");
			   while($r=mysql_fetch_array($tampil)){
			   echo "<option value=$r[id_tujuan]>$r[tujuan]</option></p>"; }
   echo "</select>";	
   echo  "</td> 
	<td>   <div align='center'>
          
		  <tr><td>Jabatan</td><td> <select name='id_jabatan' style=\"background-color: #333333\">
			  <option value=0 selected>Pilih Kategori</option>";
			   $tampil=mysql_query("SELECT * FROM jabatan");
			   while($r=mysql_fetch_array($tampil)){
			   echo "<option value=$r[id_jabatan]>$r[jabatan]</option></p>"; }
   echo "</select>";
   echo  "</td>
	<td>   <div align='center'>
          
		  <tr><td>Pangkat</td><td> <select name='id_pangkat' style=\"background-color: #333333\" onchange='changeValue(this.value)'>
			  <option value=0 selected>Pilih Kategori</option>";
			   $tampil=mysql_query("SELECT * FROM pangkat ");
			   while($r=mysql_fetch_array($tampil)){
				   $sa = mysql_fetch_array(mysql_query("SELECT * FROM biaya where id_tujuan='$_POST[id_tujuan]' and id_pangkat='$_POST[id_pangkat]'"));
				   $jsArray = "var dtp = new Array ();\n";
			   echo "<option value=$r[id_pangkat]>$r[pangkat]</option></p>";
				$jsArray .="dtp ['".$sa['id_pangkat']."']= {harian :'". addslashes($sa['harian'])."'} ; \n";
			   }
   echo "</select>";		
  
 echo "   <tr><td>Uang Harian</td><td> <input type=text name='harian' size=30 id='harian' required style=\"background-color: #333333\"/></td></tr>
          <tr><td>Uang Penginapan</td><td> <input type=text name='penginapan' size=30 required style=\"background-color: #333333\"/></td></tr>
          <tr><td>Uang Transportasi</td><td> <input type=text name='transportasi' size=45 required style=\"background-color: #333333\"/></td></tr>
		  <tr><td>Lumpsum</td><td> <input type=text name='lumpsum' size=45 required style=\"background-color: #333333\"/></td></tr>
          <tr><td></td><td><input type=submit name=submit value=Simpan class='btn btn-danger'>
                            <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
          </table></div>
		  </td></tr></table></form></div></div></div>";
		  ?>
		  <script>
				<?php echo $jsArray ; ?>
				function changeValue('id_pangkat'){
					document.getElementById('harian').value = dtp['id_pangkat'].harian;
				};
			</script>
			<?php 
     break;
	 
	 
	 
  case "editbiaya":
    $edit=mysql_query("SELECT * FROM biaya WHERE id_biaya='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "
	<h2>EDIT DATA BIAYA PERJALANAN DINAS</h2>
       <div class='box box-solid box-primary'>
        <div class='box-header'>
          <h3 class='box-title'>Form Edit Biaya Perjalanan Dinas</h3>
        </div>
        <div class='box-body' style=\"background-color: #333333\">
		<div align='center'>
          <form method=POST action=$aksi?module=biaya&act=update>
          <input type=hidden name=id value='$r[id_biaya]'>
			  
			  
	<td>
		  <table width='100%' class='table2' style=\"background-color: #333333\">
		  <tr><td>Tujuan</td><td><select name='id_tujuan' style=\"background-color: #333333\">";
		  $tampil=mysql_query("SELECT * FROM tujuan");
		   if ($r[id_tujuan]==0){
		   echo "<option value=0 selected>- Pilih Kategori -</option>"; }   
		
		   while($w=mysql_fetch_array($tampil)){
		   if ($r[id_tujuan]==$w[id_tujuan]){
		   echo "<option value=$w[id_tujuan] selected>$w[tujuan]</option>";}
		   else{
		   echo "<option value=$w[id_tujuan]>$w[tujuan]</option> </p> ";}}
		
		   echo "</select>";
	echo  "</td>
	<td>
		  
		  <tr><td>Jabatan</td><td><select name='id_jabatan' style=\"background-color: #333333\">";
		  $tampil=mysql_query("SELECT * FROM jabatan");
		   if ($r[id_jabatan]==0){
		   echo "<option value=0 selected>- Pilih Kategori -</option>"; }   
		
		   while($w=mysql_fetch_array($tampil)){
		   if ($r[id_jabatan]==$w[id_jabatan]){
		   echo "<option value=$w[id_jabatan] selected>$w[jabatan]</option>";}
		   else{
		   echo "<option value=$w[id_jabatan]>$w[jabatan]</option> </p> ";}}
		
		   echo "</select>";	
		   echo  "</td>
	<td>
		  
		  <tr><td>Pangkat</td><td><select name='id_pangkat' style=\"background-color: #333333\">";
		  $tampil=mysql_query("SELECT * FROM pangkat");
		   if ($r[id_pangkat]==0){
		   echo "<option value=0 selected>- Pilih Kategori -</option>"; }   
		
		   while($w=mysql_fetch_array($tampil)){
		   if ($r[id_pangkat]==$w[id_pangkat]){
		   echo "<option value=$w[id_pangkat] selected>$w[pangkat]</option>";}
		   else{
		   echo "<option value=$w[id_pangkat]>$w[pangkat]</option> </p> ";}}
		
		   echo "</select>";
echo "    <tr><td>Uang Harian </td><td> <input type=text name='harian' value='$r[harian]' size=30 style=\"background-color: #333333\"></td></tr>
          <tr><td>Uang Penginapan</td><td> <input type=text name='penginapan' value='$r[penginapan]' size=30 style=\"background-color: #333333\"></td></tr>
          <tr><td>Uang Transportasi</td><td> <input type=text name='transportasi' value='$r[transportasi]' size=45 style=\"background-color: #333333\"></td></tr>
		  <tr><td>Lumpsum</td><td> <input type=text name='lumpsum' value='$r[lumpsum]' size=45 style=\"background-color: #333333\"></td></tr>
          <tr><td></td><td><input type=submit value=Update class='btn btn-success'>
                            <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
          </table>
		  </td></tr></table></form></div></div></div>";     
    break;  
}
?>
