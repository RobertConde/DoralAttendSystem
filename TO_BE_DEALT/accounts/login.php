<!-- PHP -->
<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['id']))
    header("location: http://" . $_SERVER['HTTP_HOST'] . "/attendance/attendManager.php");

require_once $_SERVER['DOCUMENT_ROOT'] . "/sql/SQL.php";

// Login if credentials have been POSTed
if (isset($_POST['login'])) {
	// POST variables
	$id = $_POST['id'];
	$pass = $_POST['pass'];

	// Find if the id & password corresponds to an account
	$sql_login = "SELECT * FROM accounts WHERE id = $id AND pass = '$pass'";
	$login = $sql->query($sql_login);

	// If an account exists then login and go to attendance manager, else go back to login page
	if(mysqli_num_rows($login) > 0) {
	    $account = mysqli_fetch_assoc($login);

	    $_SESSION['id'] = $id;
	    $_SESSION['fName'] = $account['fName'];
	    $_SESSION['lName'] = $account['lName'];

	    header("location: http://" . $_SERVER['HTTP_HOST'] . "/attendance/attendManager.php");
	}
}
?>

<!--HTML-->
<html lang="en">

<title>Login</title>

<h1><u>Login Page</u></h1>

<?php
echo "7";
require_once $_SERVER['DOCUMENT_ROOT'] . "/Person.php";
Person::createAccount($sql, 0264171);
?>

<form action="" method="post">
	<b>

    <label>ID:
    	<input type="number" name="id">
    </label><br>

    <label>Password:
    	<input type="password" name="pass">
    </label><br>

    <br>
    <input type="submit" name="login" value="Login">

	</b>
</form>

</html>

