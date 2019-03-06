<?php
session_start();
error_reporting(0);
include "config/koneksi.php";
if ($_POST['tipe']=="operator" || $_POST['tipe']=="kabag" ) {
	$username=$_POST['username'];
	$password=$_POST['password'];
	$login=mysql_query("SELECT * FROM admins WHERE username='$username' AND password='$password'");
	$ketemu=mysql_num_rows($login);
	$r=mysql_fetch_array($login);
	
	// Apabila username dan password ditemukan
	if ($ketemu > 0){
	
	  $_SESSION['namauser']     = $r['username'];
	  $_SESSION['passuser']     = $r['password'];
	  $_SESSION['level']		= $r['level'];
	  header('location:media.php?module=home');
	}
	else{
	  header('location:index.php?log=2');
	}
}else {
	$username=$_POST['username'];
	$password=$_POST['password'];
	$login=mysql_query("SELECT * FROM pegawai WHERE username='$username' AND password='$password'");
	$ketemu=mysql_num_rows($login);
	$r=mysql_fetch_array($login);
	
	// Apabila username dan password ditemukan
	if ($ketemu > 0){
	  session_start();
	  $_SESSION['id_pegawai']   = $r['id_pegawai'];
	  $_SESSION['namauser']     = $r['username'];
	  $_SESSION['passuser']     = $r['password'];
	  $_SESSION['level']		= $r['level'];
	  header('location:media.php?module=home');
	}
	else{
	 header('location:index.php?log=2');
	}

}
?>
