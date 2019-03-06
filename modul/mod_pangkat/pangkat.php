<?php
$aksi="modul/mod_pangkat/aksi_pangkat.php";

switch($_GET[act]){
  // Tampil pangkat
  default:
      $tampil = mysql_query("SELECT * FROM pangkat");
  echo   "
  <h2>DATA PANGKAT</h2>
          <input type=button value='Tambah Data' class='btn btn-success' 
          onclick=\"window.location.href='?module=pangkat&act=tambahpangkat';\"><br /><br />";
    echo "<div style=\"width:450px\">
    <table id=\"example2\" class=\"table table-bordered table-hover\" >
          <thead ><tr><th>No</th><th>pangkat</th><th>aksi</th></tr></thead>"; 
    $no=1;
	echo "<tbody>";
    while ($r=mysql_fetch_array($tampil)){
		$biaya = number_format($r['biaya'],0,'','.');
       echo "<tr><td align='center' style=\"background-color: #333333\">$no</td>
             <td style=\"background-color: #333333\">$r[pangkat]</td>
             <td align='center' style=\"background-color: #333333\"><a href=?module=pangkat&act=editpangkat&id=$r[id_pangkat]><span class=\"glyphicon glyphicon-edit\"></a>
			 <a href=$aksi?module=pangkat&act=hapus&id=$r[id_pangkat] onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><span class=\"glyphicon glyphicon-trash\"></a></td></tr>";
      $no++;
    }
    echo "</tbody></table></div>";
    break;
  case "tambahpangkat":
    echo "
	<h2>TAMBAH DATA PANGKAT</h2>
       <div class='box box-solid box-primary'>
        <div class='box-header'>
          <h3 class='box-title'>Form Tambah Data Pangkat</h3>
        </div>
        <div class='box-body' style=\"background-color: #333333\">
		<div align='center'>          <form method=POST action='$aksi?module=pangkat&act=input'>
          <table width='100%' class='table2' style=\"background-color: #333333\">
          <tr><td>Pangkat</td><td> <input type=text name='pangkat' size=45 required style=\"background-color: #333333\" /></td></tr>
          <tr><td></td><td><input type=submit name=submit value=Simpan class='btn btn-success'>
                            <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
          </table></form></div></div></div>";
     break;
  case "editpangkat":
    $edit=mysql_query("SELECT * FROM pangkat WHERE id_pangkat='$_GET[id]'");
    $r=mysql_fetch_array($edit);
    echo "
	<h2>EDIT DATA PANGKAT</h2>
       <div class='box box-solid box-primary'>
        <div class='box-header'>
          <h3 class='box-title'>Form Edit Pangkat</h3>
        </div>
        <div class='box-body' style=\"background-color: #333333\">
		<div align='center' class='table2'>          
		<form method=POST action=$aksi?module=pangkat&act=update>
          <input type=hidden name=id value='$r[id_pangkat]'>
		  <table width='100%' class='table2' style=\"background-color: #333333\">
          <tr><td>Pangkat</td><td> <input type=text name='pangkat' size=45 value='$r[pangkat]' required style=\"background-color: #333333\" /></td></tr>
          <tr><td></td><td><input type=submit value=Update class='btn btn-success'>
                            <input type=button value=Batal onclick=self.history.back() class='btn btn-warning'></td></tr>
          </table>
		  </form></div></div></div>";     
    break;  
}
?>
