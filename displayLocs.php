<title>Display Locations</title>
<link rel="stylesheet" href="style.css">
<meta http-equiv="refresh" content="2.5">

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/require/connectSQL.php";
date_default_timezone_set("America/New_York");

// Header
$currTimestamp = new DateTime("now");
echo "<h1><b><u>Latest locations as of ", $currTimestamp->format('g:i:s A n/j/Y'), "</u></b></h1>";

// Get locations
$sql_locs = "SELECT id, lastLoc, CAST(time AS CHAR) AS time FROM locs ORDER BY time DESC";
$locs = $sql_conn->query($sql_locs);

// Display locations in a table with the most recent scans first
echo "<table>", "<tr> <th>ID</th> <th>Name</th> <th>Level</th> <th>Last Known Location</th> <th>Time</th> </tr>";
while ($loc_row = mysqli_fetch_assoc($locs)) {
    $sql_info = "SELECT fName, lName, secLev FROM info WHERE id = " . $loc_row['id'];
    $info_row = mysqli_fetch_assoc($sql_conn->query($sql_info));

    $id = $loc_row['id'];
    $name = $info_row['fName'] . " " . $info_row['lName'];
    $secLev = $info_row['secLev'];
    $lastLoc = $loc_row['lastLoc'];

    echo "<tr>",
    "<td>" . sprintf("%07d", $loc_row['id']) . "</td>",
    "<td>$name</td>",
    "<td>$secLev</td>",
    "<td>$lastLoc</td>",
    "<td>" . date_create($loc_row['time'])->format('g:i:s A n/j/Y') . "</td>",
    "<tr>";
}
?>