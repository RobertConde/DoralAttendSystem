<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/require/connectSQL.php";

function existsUID($uid)
{
    global $sql_conn;

    if ($uid == '')
        return false;

    $sql_existsUID = "SELECT uid FROM info WHERE uid = '$uid'";
    $existsUID = $sql_conn->query($sql_existsUID);

    return (mysqli_num_rows($existsUID) > 0);
}

function existsID($id)
{
    global $sql_conn;

    $sql_existsID = "SELECT id FROM info WHERE id = $id";
    $existsID = $sql_conn->query($sql_existsID);

    return (mysqli_num_rows($existsID) > 0);
}

function uidToID($uid)
{
    global $sql_conn;

    if ($uid == '')
        die("No UID given!");

    $sql_uidToID = "SELECT id FROM info WHERE uid = '$uid'";
    $uidToID = $sql_conn->query($sql_uidToID);
    if (mysqli_num_rows($uidToID) == 0)
        die("No ID associated with that UID!");

    return mysqli_fetch_assoc($uidToID)['id'];
}

function idToUID($id)
{
    global $sql_conn;

    if ($id == '')
        die("No ID given!");

    $sql_idToUID = "SELECT uid FROM info WHERE id = $id";
    $idToUID = $sql_conn->query($sql_idToUID);
    if (mysqli_num_rows($idToUID) == 0)
        die("No UID associated with that ID!");

    return mysqli_fetch_assoc($idToUID)['uid'];
}

?>