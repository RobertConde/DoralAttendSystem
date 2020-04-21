<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/require/connectSQL.php";

function existsUID($uid)
{
    global $sql_conn;

    if ($uid == '')
        return false;

    $sql_existsUID = "SELECT uid FROM accounts WHERE uid = '$uid'";
    $existsUID = $sql_conn->query($sql_existsUID);

    return (mysqli_num_rows($existsUID) > 0);
}

function existsID($id)
{
    global $sql_conn;

    $sql_existsID = "SELECT id FROM accounts WHERE id = $id";
    $existsID = $sql_conn->query($sql_existsID);

    return (mysqli_num_rows($existsID) > 0);
}

?>