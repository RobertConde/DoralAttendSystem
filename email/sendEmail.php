<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

sendEmail("robert0264171@gmail.com", "SUBJ", "BDY");
function sendEmail($to, $subj, $body)
{
    require_once $_SERVER['DOCUMENT_ROOT'] . "/email/PHPMailer/PHPMailer.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/email/PHPMailer/SMTP.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/email/PHPMailer/Exception.php";

    // Get config info from config file
    $config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/email/config.ini");

    // Set username and password to local variables from config file
    $user = $config['user'];
    $pass = $config['pass'];

    echo "$user | $pass";

    // Create mailer object for PHPMailer
    $mail = new PHPMailer();
    $mail->SMTPDebug=2;

    // Email config
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->SMTPAuth = true;

    // Email credentials
    $mail->Username = $user;
    $mail->Password = $pass;

    // Email 'from' and 'to' addresses
    $mail->setFrom($user, "Doral Academy Automated System [TEST]");
    $mail->addAddress($to);  // $mail->addAddress($to, $name);

    // Email contents
    $mail->Subject = $subj;
    $mail->msgHTML($body);

    // Send email and return a boolean indicating if the email was successfully sent
    return $mail->send();
}

?>