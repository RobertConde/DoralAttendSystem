<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/sql/SQL.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/person/Person.php";

Person::newPerson($sql, "0264171", "12345678", "Robert", "Conde", "robert0264171@gmail.com", 2, "ROBC");

?>
