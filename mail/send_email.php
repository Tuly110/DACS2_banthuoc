<?php

$name = $_POST["name"];
$email = $_POST["email"];
$subject = $_POST["subject"];
$message = $_POST["message"];

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

$mail = new PHPMailer(true);
// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->CharSet="UTF-8";

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "tytly0110@gmail.com";
$mail->Password = "swqagypnlshrtvtm";

$mail->setFrom('tytly0110@gmail.com', 'Mailer');
$mail->addAddress($email, $name);


$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();

header("Location: sent.php");
// echo "email sent";