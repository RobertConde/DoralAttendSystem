<?php

use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

require_once $_SERVER['DOCUMENT_ROOT'] . "/email/PHPMailer/PHPMailer.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/email/PHPMailer/SMTP.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/email/PHPMailer/Exception.php";

class Email
{
	function sendEmail($to, $subject, $body)
	{
		// Get config info from config file
		$config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/email/config.ini");

		// Set username and password to local variables from config file
		$user = $config['user'];
		$pass = $config['pass'];

		// Create mailer object for PHPMailer
		$mail = new PHPMailer();
		//$mail->SMTPDebug = 2;

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
		$mail->Subject = $subject;
		$mail->msgHTML($body);

		// Send email
		$mail->send();
		if ($mail->isError())
			die("Error: Could not send email.");
	}
}
