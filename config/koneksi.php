<?php
$server = "localhost";
$username = "mandanon_sppd";
$password = "qwe123*IOP";
$database = "mandanon_sppd";

// Koneksi dan memilih database di server
mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
