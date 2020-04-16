<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/sql/connectSQL.php";

function verifyBox($bid) {
	global $sql_conn;

	// Check if box is in table of boxes
	$sql_check = "SELECT * FROM boxes WHERE bid = '$bid'";
	$check = $sql_conn->query($sql_check);

	return mysqli_num_rows($check) > 0;
}

?>
