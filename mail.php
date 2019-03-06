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
	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.mail.yahoo.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'bp3ap2kb@yahoo.com';                 // SMTP username
    $mail->Password = 'daviddwi96';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('bp3ap2kb@yahoo.com', 'Admin BP3AP2KB');
    // $mail->addAddress($email['email'], $email['username']);
    $mail->addAddress('egodasa@hotmail.com', $email['username']);

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Lupa Password';
    $mail->Body    = 'Password Baru Anda Sudah Siap Digunakan. Password Baru Anda Adalah <b>'.$password_baru.'</b>.';

    $mail->send();
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
}
header("Location: lupapassword.php?log=1");
?>