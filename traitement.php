<?php

header('Content-Type: text/html; charset=UTF-8');

function sanitize_input($data) {
    $data = strip_tags($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    $data = preg_replace('/<a\s+href\s*=\s*["\'][^"\']*["\']/i', '[Lien supprimé]', $data);
    $data = preg_replace('/<script\b[^>]*>([\s\S]*?)<\/script>/i', '[Script supprimé]', $data);
    $data = preg_replace('/https?:\/\/[^\s]+/i', '[URL supprimée]', $data);
    return $data;
}

$nom = sanitize_input($_POST['nom']);
$telephone = sanitize_input($_POST['telephone']);
$depart = sanitize_input($_POST['lieu_depart']);
$arrive = sanitize_input($_POST['lieu_arrivee']);
$numero = sanitize_input($_POST['numero']);
$date = sanitize_input($_POST['date']);
$heure = sanitize_input($_POST['heure']);
$passagers = sanitize_input($_POST['passagers']);
$enfants = sanitize_input($_POST['enfants']);
$bagages = sanitize_input($_POST['bagages']);
$sieges_auto = sanitize_input($_POST['sieges_auto']);
$commentaires = sanitize_input($_POST['commentaires']);

$message = "NOM : $nom\n";
$message .= "TÉLÉPHONE : $telephone\n";
$message .= "DÉPART : $depart\n";
$message .= "ARRIVÉE : $arrive\n";
$message .= "NUMÉRO DE VOL/TRAIN : $numero\n";
$message .= "DATE : $date\n";
$message .= "HEURE : $heure\n";
$message .= "PASSAGERS : $passagers\n";
$message .= "ENFANTS : $enfants\n";
$message .= "BAGAGES : $bagages\n";
$message .= "SIÈGES AUTO : $sieges_auto\n";
$message .= "COMMENTAIRES : $commentaires\n";

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
    $mail->addAddress('webprime91@hotmail.com');

    $mail->CharSet = 'UTF-8'; 
    $mail->isHTML(true);
    $mail->Subject = 'Formulaire';
    $mail->Body    = nl2br($message);
    $mail->AltBody = $message;

    $mail->send();

    header('Location: index.html');
    exit();
} catch (Exception $e) {
    echo "Message non envoyé. Mailer Error: {$mail->ErrorInfo}";
}
?>



