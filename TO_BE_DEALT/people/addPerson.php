<!-- PHP -->
<?php
if (isset($_POST['add'])) {
	require_once $_SERVER['DOCUMENT_ROOT'] . "/sql/SQL.php";

	// POST
	$id = $_POST['id'];
	$isFac = $_POST['isFac'];
	$fName = $_POST['fName'];
	$lName = $_POST['lName'];
	$email = $_POST['email'];
	$uid = $_POST['uid'];
	$room = $_POST['room'];

	// Add person
	$sql_addPerson = "INSERT INTO people
		VALUES ($id, $isFac, '$fName', '$lName', '$email', " . ($uid == '' ? "NULL" : "'$uid'") . ", " . ($room == '' ? "NULL" : "'$room'") . ")";
	$addPerson = $sql->query($sql_addPerson);

	if ($addPerson)
		echo "<center><h2>Successfully added person.</h2></center>";
	else
		die ("<center><h2>FAILED: " . $sql->error . "</h2></center>");

	// Create account if person is faculty
	if ($isFac) {
		require_once $_SERVER['DOCUMENT_ROOT'] . "/accounts/createAccount.php";

		$createAccount = createAccount($id, $email);
		if ($createAccount)
			echo "<center><h2>Successfully created account (check email).</h2></center>";
		else
			die ("<center><h2>FAILED: $createAccount</h2></center>");
	}
}
?>

<!-- HTML -->
<html>

<title>Add Person</title>

<h1><u>Add Person</u></h1>

<form action="" method="post">
	<b>

	<label>ID:
		<input type="number" name="id">
	</label><br><br>

	Role:
	<label>
		<input type="radio" name="isFac" value="0" checked>
	Student</label>&nbsp
	<label>
		<input type="radio" name="isFac" value="1">
	Faculty</label><br><br>

	<label>First Name:
		<input type="text" name="fName">
	</label><br><br>

	<label>Last Name:
		<input type="text" name="lName">
	</label><br><br>

	<label>Email:
		<input type="email" name="email">
	</label><br><br>

	<label>UID (All CAPS & No Dashes):
		<input type="text" name="uid">
	</label><br><br>

	<label>Room (Leave Blank for Student):
		<input type="text" name="room">
	</label><br><br>

	</b>

	<input type="submit" name="add" value="Add Person">
</form>

</html>
