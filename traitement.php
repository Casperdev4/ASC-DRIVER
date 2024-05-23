<?php

$nom = $_POST['nom'];
$email = $_POST['email'];
$depart = $_POST['lieu_depart'];
$arrive = $_POST['lieu_arrivee'];
$passagers = $_POST['passagers'];
$bagages = $_POST['bagages'];

$message = "NOM : $nom \n";
$message .= "/ E-MAIL : $email \n";
$message .= "/ DEPART : $depart \n";
$message .= "/ ARRIVE : $arrive \n";
$message .= "/ PASSAGERS : $passagers \n";
$message .= "/ BAGAGES : $bagages \n";

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
