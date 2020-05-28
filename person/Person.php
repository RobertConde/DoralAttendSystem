<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/email/Email.php";

class Person
{
	/* New & Create Functions */
	static function newPerson(mysqli $sql, $id, $uid, $fName, $lName, $email, $role, $room)
	{
		// Make sure person doesn't already exist
		if (Person::existsPerson($sql, $id))
			die("Error: Person already exists.");

		// Replace empty for NULL
		if (empty($uid))
			$uid = "NULL";
		if (empty($room))
			$room = "NULL";

		// Insert person
		$newPerson = "INSERT INTO person
			VALUES ('$id', $uid, '$fName', '$lName', '$email', '$role', '$room')";
		if (!$sql->query($newPerson))
			die("Error: " . $sql->error);

		// If teacher then create account
		if ($role > 1)
			Person::createAccount($sql, $id);
	}

	static function createAccount(mysqli $sql, $id)
	{
		// Make sure account doesn't already exist
		if (Person::existsAccount($sql, $id))
			die("Error: Account already exists.");

		// Generate random 8-character password
		$randPassword = substr(md5(rand()), 0, 8);

		// Insert account
		$createAccount = "INSERT INTO account VALUES ('$id', '$randPassword')";
		if (!$sql->query($createAccount))
			die("Error: " . $sql->error);

		// Send email with login credentials and instructions to change password
		$body = "<h3><b><u>Login Credentials:</u></b></h3>
            <u>ID:</u> $id<br>
            <u>Password:</u> $randPassword<br>";

		Email::sendEmail(Person::getInfo($sql, $id, 'email'), "DAES: Login Credentials", $body);
	}

	/* Exists Functions */
	static function existsPerson(mysqli $sql, $id)
	{
		// Query for person
		$existsPerson = "SELECT COUNT(1) FROM person WHERE id = '$id'";
		$numPeople = mysqli_fetch_row($sql->query($existsPerson))[0];

		return $numPeople == 1;
	}

	static function existsAccount(mysqli $sql, $id)
	{
		// Query for account
		$existsPerson = "SELECT COUNT(1) FROM account WHERE id = '$id'";
		$numPeople = mysqli_fetch_row($sql->query($existsPerson))[0];

		return $numPeople == 1;
	}

	/* Get Person Info Functions */
	static function getInfo(mysqli $sql, $id, $type)
	{
		// Query for email
		$getInfo = "SELECT $type FROM person WHERE id = '$id'";
		if (!($res_getInfo = $sql->query($getInfo)))
			die("Error: " . $sql->error);

		return mysqli_fetch_assoc($res_getInfo)["$type"];
	}
}
