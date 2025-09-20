<?php
// send.php
declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

mb_internal_encoding('UTF-8');


require __DIR__ . '/vendor/autoload.php';

// ---- SMTP config külön fájlban ----
$config = require __DIR__ . '/mail.config.php';

// ---- Csak POST-ból jöhet ----
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php#error=1#kapcsolat');
    exit;
}


$lang = 'hu';
if (!empty($_POST['lang']) && in_array($_POST['lang'], ['hu', 'en'], true)) {
    $lang = $_POST['lang'];
}

// ---- Honeypot: ha ezt a rejtett mezőt kitöltik, akkor bot ----
$honeypot = trim($_POST['website'] ?? '');
if ($honeypot !== '') {
    header("Location: index.php?error=1&lang={$lang}#kapcsolat");
    exit;
}


$name    = trim((string)($_POST['name'] ?? ''));
$email   = trim((string)($_POST['email'] ?? ''));
$message = trim((string)($_POST['message'] ?? ''));

// ---- Alap validáció ----
if ($name === '' || $email === '' || $message === '') {
    header("Location: index.php?error=1&lang={$lang}#kapcsolat");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: index.php?error=1&lang={$lang}#kapcsolat");
    exit;
}

// ---- Sanitization ----
$name    = htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$message = htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

// ---- Címzett: ide kapod meg az üzenetet ----
$toEmail = $config['admin_email'];
$toName  = $config['admin_name'];

$subject = ($lang === 'hu')
    ? "Kapcsolatfelvétel a portfólió oldaladról - {$name}"
    : "Contact from portfolio site - {$name}";

$bodyText = "Név  {$name}\n"
          . "Feladó: {$email}\n\n"
          . "Üzenet \n{$message}\n";

// ---- Küldés PHPMailerrel ----
$mail = new PHPMailer(true);

try {
    // SMTP
    $mail->isSMTP();
    $mail->Host       = $config['host'];          
    $mail->SMTPAuth   = true;
    $mail->Username   = $config['username'];      
    $mail->Password   = $config['password'];      
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
    $mail->Port       = (int)$config['port'];     // 465

    // EHLO domain (opcionális, de Titan szereti, ha saját domain)
    if (!empty($config['ehlo_domain'])) {
        $mail->Hostname = $config['ehlo_domain'];
    }

    // Fejlécek
    $mail->CharSet  = 'UTF-8';
    $mail->setFrom($config['from_address'], $config['from_name']);
    $mail->addAddress($toEmail, $toName);

    // Válaszcím a feladó emailje
    $mail->addReplyTo($email, $name);

    // Tartalom
    $mail->isHTML(false);
    $mail->Subject = $subject;
    $mail->Body    = $bodyText;

    $mail->send();

    header("Location: index.php?success=1&lang={$lang}#kapcsolat");
    exit;

} catch (Exception $e) {
    
     //error_log('PHPMailer error: ' . $mail->ErrorInfo);

    header("Location: index.php?error=1&lang={$lang}#kapcsolat");
    exit;
}
