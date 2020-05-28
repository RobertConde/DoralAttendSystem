<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/boxes/FUN-verifyBox.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/attendance/FUN-updAttend.php";
//updAttend($studID, $date, $per, $facID, $updMark)

// GET variables
$bid = $_GET['bid'];
$uid = $_GET['uid'];

// Verify box
if (!verifyBox($bid))
	die("Not a valid box!");

// Get studID
$sql_stud = "SELECT id FROM people WHERE uid = '$uid'";
$stud = $sql->query($sql_stud);

$studID = mysqli_fetch_assoc($stud)['id'];

// Get facID
$sql_fac = "SELECT * FROM people p
			JOIN boxes b ON p.room = b.loc
			WHERE bid = '$bid'";
$fac = $sql->query($sql_fac);

$facID = mysqli_fetch_assoc($fac)['id'];

echo updAttend($studID, "", "", $facID, "P");
?>
