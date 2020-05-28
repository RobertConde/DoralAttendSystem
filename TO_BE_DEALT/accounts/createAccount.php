<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/sql/SQL.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/email/sendEmail.php";

function createAccount($id, $email)
{
    global $sql;
    
    // Create account
    $tempPass = substr(md5(rand()), 0, 8);

    $sql_create = "INSERT INTO accounts
        VALUES ($id, '$tempPass')";
    $create = $sql->query($sql_create);

    if (!$create)
        return $sql->error;
    
    // Send email
    $sendEmail_body =
    "<h2><u>Login Credentials:</u></h2>
    <b>ID:</b> $id<br>
    <b>Password:</b> $tempPass<br>
    <br>
    <i>Password can be changed at the login page.</i>";

    return sendEmail($email, "DAAS: Login Credentials", $sendEmail_body);
}

?>