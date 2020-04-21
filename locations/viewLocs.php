<!-- HTML -->
<html>

<meta http-equiv="refresh" content="2.5">

<title>Locations</title>

<link rel="stylesheet" type="text/css" href="/style.css">

<h1><u>Locations Viewer</u></h1>

</html>

<!-- PHP -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/sql/connectSQL.php";

// Get locations
$sql_locs = "SELECT p.id, p.uid, p.fName, p.lName, l.loc, l.timestamp
	FROM people p
	LEFT JOIN locations l ON p.id = l.id";
$locs = $sql_conn->query($sql_locs);

// Display locations
echo "<table>",
	"<tr> <th>ID</th> <th>UID</th> <th>Name</th> <th>Location</th> <th>Timestamp</th> </tr>";
while ($row = mysqli_fetch_assoc($locs)) {
	$id = sprintf("%07d", $row['id']);
	$uid = $row['uid'];
	$name = $row['fName'] . " " . $row['lName'];
	$loc = $row['loc'];
	$timestamp = $row['timestamp'];

	echo "<tr> <td>$id</td> <td>$uid</td> <td>$name</td> <td>$loc</td> <td>$timestamp</td </tr>";
}
echo "</table>";
?>
