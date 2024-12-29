<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets/PHPMailer/src/Exception.php';
require 'assets/PHPMailer/src/PHPMailer.php';
require 'assets/PHPMailer/src/SMTP.php';

$nama=$_POST['nama'];
$email=$_POST['email'];
$whatsapp=$_POST['whatsapp'];
$pesan=$_POST['pesan'];

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'amartagroups@gmail.com';                     //SMTP username
    $mail->Password   = 'ersv podo aejg gqdi';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('amartagroups@gmail.com', 'pesan');
    $mail->addAddress('amartagroups@gmail.com', 'AmartaWeb');     //Add a recipient
    


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Pesan dari Website : ' .$nama;
    $mail->Body    = 'Nama : '. $nama.'<br>' .'Email : '.$email.'<br>' .'No Whatsapp : ' .$whatsapp.'<br>' .'Pesan : ' .$pesan;
   

    $mail->send();
   header("Location:index.php?alert=Pesan Terkirim");
} catch (Exception $e) {
    header("Location:index.php?alert=Pesan Gagal");
}
?>