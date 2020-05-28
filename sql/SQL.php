<?php
// Get config info from config file 'SQL.ini'
$config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/sql/config.ini");

// Make connection to SQL server and use 'doral' databse
$sql = new mysqli($config['host'],
	$config['user'],
	$config['pass'],
	$config['dbname']);
if ($sql->connect_error)
	die("Error: " . $sql->connect_error);
?>