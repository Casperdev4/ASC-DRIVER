<?php

$nom = $_POST['nom'];
$email = $_POST['email'];
$depart = $_POST['lieu_depart'];
$arrive = $_POST['lieu_arrivee'];
$date = $_POST['date'];
$heure = $_POST['heure'];
$passagers = $_POST['passagers'];

$message = "Nom: $nom \n";
$message .= "/ E-mail: $email \n";
$message .= "/ Depart: $depart \n";
$message .= "/ Arrive: $arrive \n";
$message .= "/ Date: $date \n";
$message .= "/ Heure: $heure \n";
$message .= "/ Passagers: $passagers \n";

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

    $mail->setFrom('contact@webprime.fr', 'ASC-DRIVER');
    $mail->addAddress('asc.driver@outlook.com');
    $mail->addAddress('contact@webprime.fr');

    $mail->isHTML(true);
    $mail->Subject = 'Formulaire de contact';
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    header('Location: index.html');
    exit();
} catch (Exception $e) {
    echo "Message non envoyé. Mailer Error: {$mail->ErrorInfo}";
}
?>
