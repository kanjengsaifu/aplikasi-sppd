<?php

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// cek email apakah ada atau tidak
require "config/koneksi.php";
$cek_email = mysql_query("SELECT * FROM admins WHERE email = '$_POST[email]'");

$email = mysql_fetch_array($cek_email);

if(empty($email) == FALSE)
{	
	// buat password baru
	$password_baru = generateRandomString();
	
	// update password lama dengan yang baru
	mysql_query("UPDATE admins SET password = '$password_baru' WHERE email = '$_POST[email]'");
	
	// jika email ditemukan, maka kirim password ke email
	// the message
    $msg = "Password Baru Anda Sudah Siap Digunakan. Password Baru Anda Adalah <b>'.$password_baru.'</b>.";

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);

    // send email
    mail($_POST['email'],"Lupa Password", $msg);
}
header("Location: lupapassword.php?log=1");
?>