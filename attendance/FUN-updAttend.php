<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/sql/connectSQL.php";

function updAttend($studID, $date, $per, $facID, $updMark) {
	global $sql_conn;

	// Correct date and period
	if ($date == "") {
		$date = "CURRENT_DATE";
		$per = 3;
		/* TODO: currPer() */
	} else
		$date = "'$date'";

	// Verify that the update period corresponds to schedule
	$sql_verify = "SELECT id FROM schedules WHERE id = $studID AND p$per = $facID";
	$verify = $sql_conn->query($sql_verify);

	if (mysqli_num_rows($verify) < 1)
		return false;

	// Delete prior attendance entry
	$sql_delete = "DELETE FROM attendance
		WHERE studID = $studID AND date = $date AND per = $per AND facID = $facID";
	$delete = $sql_conn->query($sql_delete);

	if (!$delete)
		return false;

	// Insert updated attendance entry
	$sql_insert = "INSERT INTO attendance (studID, date, per, facID, mark)
		VALUES ($studID, $date, $per, $facID, '$updMark')";

	return $sql_conn->query($sql_insert);
}

?>
