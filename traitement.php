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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();                      
    $mail->Host       = 'smtp.ionos.fr';        
    $mail->SMTPAuth   = true;                
    $mail->Username   = 'contact@webprime.fr';
    $mail->Password   = 'Allamalyjass912!';     
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;       
    $mail->Port       = 465; 

    $mail->setFrom('contact@webprime.fr', 'WebPrime');
    $mail->addAddress('allam.bilal91@gmail.com'); 
    $mail->addAddress('contact@webprime.fr'); 

    $mail->isHTML(true);   
    $mail->Subject = 'Formulaire de contact';
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Formulaire envoyé';
} catch (Exception $e) {
    echo "Message non envoyé. Mailer Error: {$mail->ErrorInfo}";
}