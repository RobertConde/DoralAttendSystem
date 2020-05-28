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

<title>Scheduler</title>

<link rel="stylesheet" type="text/css" href="/style.css">

<form action="/TO_BE_DEALT/accountsRUCTURED/accounts/logout.php" method="get">
    <input type="submit" value="Logout" style="float: right">
</form>

<h1><u>Scheduler</u></h1>

<form action="" method="get">
    <b>

        <label>ID:
            <input type="number" name="id">
        </label>&nbsp&nbsp

        <input type="submit" value="View">

    </b>
</form>

<br>

</html>

<!-- PHP -->
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/sql/SQL.php";

// Update & display schedule
if (isset($_GET['id'])) {
    // GET variables
    $id = $_GET['id'];

    // Update schedule
    if (isset($_POST['per'])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . "/schedules/FUN-updSchedule.php";

        // POST variables
        $studID = $_POST['studID'];
        $per = $_POST['per'];
        $updFac = $_POST['updFac'];

        echo updSchedule($studID, $per, $updFac) ?
            "Successfully updated schedule for $studID." :
            "Failed to update schedule for $studID.";
    }

    // Header to table
    echo "<h2><u>Schedule</u></h2>";

    // Get schedule
    $sql_schedule = "
	SELECT p.fName, p.lName, s.*
	FROM people p
	LEFT JOIN schedules s
		ON s.id = p.id
    WHERE
        p.id = $id;
	";
    $schedule = mysqli_fetch_assoc($sql->query($sql_schedule));

    // Table header
    echo "<table>",
    "<tr> <th>ID</th> <th>Name</th>
        <th>P1</th> <th>P2</th> <th>P3</th> <th>P4</th>
        <th>P5</th> <th>P6</th> <th>P7</th> <th>P8</th> </tr>";

    // Schedule variables
    $id = sprintf("%07d", $id);
    $name = $schedule['fName'] . " " . $schedule['lName'];

    // Display Schedule
    echo "<tr>
    <td>$id</td>
    <td>$name</td>";

    for ($per = 1; $per <= 8; ++$per) {
        echo "<td>", $schedule["p$per"],
        "<br>";

        // Schedule change input
        echo "<form action='' method='post'>",
        "<input type='hidden' name='studID' value='$id'>",
        "<input type='number' name='updFac'>&nbsp",
        "<input type='submit' name='per' value='$per'>",
        "</form> </td>";
    }

    echo "</tr> </table>";
}
?>
