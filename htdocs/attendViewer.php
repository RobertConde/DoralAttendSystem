<!--HTML-->
<title>Attendance Viewer</title>
<link rel="stylesheet" href="style.css">

<form id="attendViewer" action="" method="post">
    <label><b>Faculty ID: </b><input type="number" name="id"></label>&nbsp
    <label><b>Period: </b><input type="number" name="per"></label>&nbsp
    <label><b>Date (Blank -> Current): </b><input type="date" name="date"></label>&nbsp&nbsp
    <input type="submit" name="submit" value="View">
</form>

<!--PHP-->
<?php
const buttonMarks = Array('P', 'T', 'A');

if(isset($_POST[''])) {
    //f
}

if (isset($_POST['submit'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/require/connectSQL.php";
    date_default_timezone_set("America/New_York");

    // Set POST content to local variables
    $id = sprintf("%07d", $_POST['id']);
    $per = intval($_POST['per']);
    $date = (strlen($_POST['date']) == 0) ? (new DateTime("now"))->format("Y-m-d") : $_POST['date'];

    // Header
    $sql_info = "SELECT fName, lName FROM info WHERE id = $id";
    $info_row = mysqli_fetch_assoc($sql_conn->query($sql_info));
    $name = $info_row['fName'] . " " . $info_row['lName'];

    echo "<h1><b><u>Viewing Attendance for $name [$id] for Period $per of $date </u></b></h1>";

    // Get attendance
    $sql_attend = "SELECT info.id, info.fName, info.lName, attend.mark FROM info INNER JOIN attend ON info.id = attend.id
            WHERE info.per$per = $id AND attend.date = '$date'
            ORDER BY lName ASC, fName ASC, id ASC";
    $attend = $sql_conn->query($sql_attend);

    // Display attendance in the form of a table
    echo "<table>", "<tr> <th>ID</th> <th>Name</th> <th>Mark</th> </tr>";
    while ($attend_row = mysqli_fetch_assoc($attend)) {
        $stud_id = sprintf("%07d", $attend_row['id']);
        $stud_name = $attend_row['fName'] . " " . $attend_row['lName'];
        $stud_mark = $attend_row['mark'];

        echo "<tr>",
        "<td>$stud_id</td>",
        "<td>$stud_name</td>",
        "<td>$stud_mark</td>";

        // Attendance buttons
		require_once $_SERVER['DOCUMENT_ROOT'] . "/functions/FUN_info.php";
		$uid = idToUID($stud_id);
		/*
        echo "<td><form action=\"/arduino/ARD_updateAttend.php\">",
		"<input type=\"hidden\" name=\"uid\" value=\"$uid\" />",
		
        "<input type=\"hidden\" name=\"id\" value=\"$stud_id\" />",
        "<input type=\"hidden\" name=\"per\" value=\"$per\" />",
        "<input type=\"hidden\" name=\"date\" value=\"$date\" />";
        foreach (buttonMarks as $mark)
            echo "<button type=\"submit\" name=\"mark\" value=\"$mark\">$mark</button> ";
        echo "</form></td>";
		*/

		/*
		 * $id = sprintf("%07d", $_POST['id']);
            $per = intval($_POST['per']);
        $date = (strlen($_POST['date']) == 0) ? (new DateTime("now"))->format("Y-m-d") : $_POST['date'];

		 */

        echo "<td><form action='' method='post'>",
        "<input type='hidden' name='id'>",
        "<input type='hidden' name='per'></label>",
        "<input type='hidden' name='date'></label>",

        "<input type=\"hidden\" name=\"uid\" value=\"$uid\" />",

        "<input type=\"hidden\" name=\"id\" value=\"$stud_id\" />",
        "<input type=\"hidden\" name=\"per\" value=\"$per\" />",
        "<input type=\"hidden\" name=\"date\" value=\"$date\" />";
        foreach (buttonMarks as $mark)
            echo "<button type=\"submit\" name=\"mark\" value=\"$mark\">$mark</button> ";
        echo "</form></td>";

        "</tr>";
        /* TODO: Add buttons to manually change attendance status (use for-loop! and POST-method like in addPerson.php) */
    }
    echo "</table>";
}
?>