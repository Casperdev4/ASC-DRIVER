<?php

$nom = $_POST['nom'];
$email = $_POST['e-mail'];
$telephone = $_POST['telephone'];
$depart = $_POST['depart'];
$arrive = $_POST['arrive'];
$date = $_POST['telephone'];
$heure = $_POST['heure'];
$passagers = $_POST['passagers'];

$message = "Nom: $nom \n";
$message .= "E-mail: $email \n";
$message .= "Téléphone: $telephone \n";
$message = "Lieu de départ: $depart \n";
$message .= "Lieu d'arrivé: $arrive \n";
$message .= "Date: $date \n";
$message .= "Heure: $heure \n";
$message .= "Passagers: $passagers \n";

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.ionos.fr';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'contact@webprime.fr';                     //SMTP username
    $mail->Password   = 'Allamalyjass912!';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('contact@webprime.fr', 'WebPrime');
    $mail->addAddress('allam.bilal91@gmail.com');     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Formulaire de contact';
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Formulaire envoyé';
} catch (Exception $e) {
    echo "Message non envoyé. Mailer Error: {$mail->ErrorInfo}";
}