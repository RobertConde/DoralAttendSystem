<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/boxes/FUN-verifyBox.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/locations/FUN-updLoc.php";

// GET variables
$bid = $_GET['bid'];
$uid = $_GET['uid'];

// Verify box
if (!verifyBox($bid))
	die("Not a valid box!");

echo updLoc($uid, $bid);
?>
