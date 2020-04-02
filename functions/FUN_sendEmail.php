<?php

/*
    EXAMPLE USAGE:
        require "require/FUN_sendEmail.php";
        sendMail("to_email", "to_name", "subject", "body");
*/

sendMail("dany.rfp@gmail.com", "Dany", "subject", "Yee");

use PHPMailer\PHPMailer\PHPMailer;

function sendMail($to, $name, $subj, $body)
{
    // Require PHPMailer code
    require_once $_SERVER['DOCUMENT_ROOT'] . "/require/PHPMailer/PHPMailer.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/require/PHPMailer/SMTP.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/require/PHPMailer/Exception.php";

    // Get config info from config file
    $config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/config/Email.ini");

    // Set username and password to local variables from config file
    $user = $config['user'];
    $pass = $config['pass'];

    // Create mailer object for PHPMailer
    $mail = new PHPMailer();

    // Email config
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->SMTPAuth = true;

    // Email credentials
    $mail->Username = $user;
    $mail->Password = $pass;

    // Email 'from' and 'to' addresses
    $mail->setFrom($user, "Doral Academy [TEST]");
    $mail->addAddress($to, $name);

    // Email contents
    $mail->Subject = $subj;
    $mail->msgHTML($body);

    // Send email and return a boolean indicating if the email was successfully sent
    return $mail->send();
}

?>