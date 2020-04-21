<!-- PHP -->
<?php
session_start();

// Go to login page if not logged in
if (!isset($_SESSION['id']))
    header("location: http://" . $_SERVER['HTTP_HOST'] . "/accounts/login.php");

// Session variables
$sessID = $_SESSION['id'];
?>

<!-- HTML -->
<html lang="en">

<title>Attendance Manager</title>

<link rel="stylesheet" type="text/css" href="/style.css">

<form action="/accounts/logout.php" method="get">
    <input type="submit" value="Logout" style="float: right">
</form>

<h1><u>Attendance Manager</u></h1>

<form action="" method="get">
    <b>

        <label>Period:
            <input type="number" name="per">
        </label>&nbsp&nbsp

        <label>Date <i>(Blank → Current)</i>:
            <input type="date" name="date">
        </label>&nbsp&nbsp

        <input type="submit" value="View">

    </b>
</form>

<br>

</html>

<!-- PHP -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/sql/connectSQL.php";

const MARKS = ['P', 'T', 'A'];

// Update & display attendance
if (isset($_GET['per']) && isset($_GET['date'])) {
    // GET variables
    $per = $_GET['per'];
    $date = $_GET['date'];

    // Update attendance
    if (isset($_POST['updMark'])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/attendance/FUN-updAttend.php";

        // POST variables
        $updID = $_POST['updID'];
        $updMark = $_POST['updMark'];

        echo updAttend($updID, $date, $per, $sessID, $updMark) ?
            "Successfully updated attendance for $updID." :
            "Failed to update attendance for $updID.";
    }

    // Header to table
    echo "<h2><u>Period $per of $date</u></h2>";

    // Get attendance
    $sql_attend = "
	SELECT p.id, p.fName, p.lName, a.mark
	FROM people p, schedules s
	LEFT JOIN attendance a
		ON s.id = a.studID AND a.date = '$date'
	WHERE p.id = s.id AND
		((a.per = $per AND a.facID = $sessID) OR s.p$per = $sessID)
	ORDER BY lName, fName, id;
	";
    $attend = $sql_conn->query($sql_attend);

    // Display attendance
    echo "<table>",
    "<tr> <th>ID</th> <th>Name</th> <th>Mark</th> </tr>";
    while ($row = mysqli_fetch_assoc($attend)) {
        // Table variables
        $studID = sprintf("%07d", $row['id']);
        $studName = $row['lName'] . ", " . $row['fName'];
        $studMark = is_null($row['mark']) ? "―" : $row['mark'];

        // Display attendance
        echo "<tr>
		<td>$studID</td>
		<td>$studName</td>
		<td>$studMark</td>";

        // Attendance change buttons
        echo "<td>",
        "<form action='' method='post'>",
        "<input type='hidden' name='updID' value='$studID'>";

        foreach (MARKS as $mark)
            echo "<input type='submit' name='updMark' value='$mark'>";

        echo "</form> </td> </tr>";
    }

    echo "</table>";
}
?>