<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions/FUN_info.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions/FUN_updateLoc.php";

// Set GET contents to local variables
$uid = $_GET['uid'];
$loc = $_GET['loc'];

updateLoc(uidToID($uid), $loc);
?>