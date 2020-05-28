<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/require/SQL.php";

function existsUID($uid)
{
    global $sql;

    if ($uid == '')
        return false;

    $sql_existsUID = "SELECT uid FROM accounts WHERE uid = '$uid'";
    $existsUID = $sql->query($sql_existsUID);

    return (mysqli_num_rows($existsUID) > 0);
}

function existsID($id)
{
    global $sql;

    $sql_existsID = "SELECT id FROM accounts WHERE id = $id";
    $existsID = $sql->query($sql_existsID);

    return (mysqli_num_rows($existsID) > 0);
}

?>