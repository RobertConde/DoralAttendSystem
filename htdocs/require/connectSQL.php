<?php
// Get config info from config file 'SQL.ini'
$config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . "/config/SQL.ini");

// Make connection to SQL server
$sql_conn = new mysqli($config['host'],
    $config['user'],
    $config['pass'],
    $config['dbname']);

// Check that connection was made w/o any errors
if ($sql_conn->connect_error)
    die("<b>Connection Failed:</b> " . $sql_conn->connect_error);
?>