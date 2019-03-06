<style>
table {
	font-family: "Segoe UI", Frutiger,Tahoma,Helvetica,"Helvetica Neue", Arial, sans-serif;
	font-size:12px;
	border-width: 1px;
	border-style: solid;
	border-color: #dddddd;
	border-collapse: collapse;
	margin: 20px 0px 0px 25px;
}
caption {margin: 0 0 .5em; font-size: 1.2em; color: #383E4B; }
th{
	font-size: 1.0em;
	text-align: center;
	padding: 0.5em;
	background-color: #DBEAF9;
}
td{
	padding: 0.5em;
	vertical-align: top;
	border-width: 1px;
	border-style: solid;
	border-color: #dddddd;
	border-collapse: collapse;
}          
@media print {
input.noPrint { display: none; }
}  
</style>
<div style="text-align:center;padding:10px;">
	<input class="noPrint" type="button" value="Cetak Halaman" onclick="window.print()">
	</div>

<div align="center">
<?php
include "../../config/koneksi.php";
      $tampil = mysql_query("SELECT * FROM pegawai,jabatan WHERE pegawai.id_jabatan=jabatan.id_jabatan ");
  echo   "<h2>DATA PEGAWAI</h2>
    		<table id=\"datatables\" class=\"cell-border\" cellspacing=\"0\">
          <thead><tr><th>No</th><th>NIP</th><th>Nama</th><th>Jabatan</th><th>Pangkat</th><th>Unit Kerja</th><th>Foto</th></tr></thead>";
    $no=1;
	echo "<tbody>";
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[nip]</td>
             <td>$r[nama]</td>
		     <td>$r[jabatan]</td>
		     <td>$r[pangkat]</td>
			 <td>$r[unitkerja]</td>
			 <td>$r[foto]</td>
			 </tr>";
      $no++;
    }
    echo "</tbody></table>";
?>
</div>