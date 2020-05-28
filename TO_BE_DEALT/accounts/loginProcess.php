<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/sql/SQL.php";
session_start();

// Set POST contents to local variables
$id = $_POST['id'];
$pass = $_POST['pass'];

// Find the account that the id & password may correspond to
$sql_login = "SELECT id FROM accounts WHERE id = $id AND pass = '$pass'";
$login = $sql->query($sql_login);

// If an account exists then login and go to attendance manager, else go back to login page
if(mysqli_num_rows($login) > 0) {
    $account = mysqli_fetch_assoc($login);

    $_SESSION['id'] = $id;
    $_SESSION['fName'] = $account['fName'];
    $_SESSION['lName'] = $account['lName'];

    header("location: http://" . $_SERVER['HTTP_HOST'] . "/attendance/attendManager.php");
} else
    header("location: http://" . $_SERVER['HTTP_HOST'] . "/login.php");
?>