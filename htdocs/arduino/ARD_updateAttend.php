<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions/FUN_info.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions/FUN_updateAttend.php";

// Set GET contents to local variables
$uid = $_GET['uid'];
$mark = $_GET['mark'];

/* TODO: Get period from current time & corresponding mark */
updateAttend(uidToID($uid), 3, '', $mark);
?>