<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions/FUN_addPerson.php";

// Set GET contents to local variables
$uid = $_GET['uid'];
$id = $_GET['id'];
$fName = $_GET['fName'];
$lName = $_GET['lName'];
$secLev = $_GET['secLev'];
$email = $_GET['email'];

addPerson($uid, $id, $fName, $lName, $secLev, $email);
?>