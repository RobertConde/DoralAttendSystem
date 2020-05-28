<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/sql/SQL.php";

function updLoc($uid, $bid)
{
    global $sql;

    // Get ID from UID
    $sql_getID = "SELECT id FROM people WHERE uid = '$uid'";
    $getID = $sql->query($sql_getID);

    if (mysqli_num_rows($getID) < 1)
        return "No ID associated with that UID.";

    $id = mysqli_fetch_assoc($getID)['id'];

    // Get location from BID
    $sql_getLoc = "SELECT loc FROM boxes WHERE bid = '$bid'";
    $getLoc = $sql->query($sql_getLoc);

    if (mysqli_num_rows($getLoc) < 1)
        return "No location associated with that BID.";

    $loc = mysqli_fetch_assoc($getLoc)['loc'];

    // Update location
    $sql_update = "INSERT INTO locations
        VALUES ($id, '$loc', CURRENT_TIMESTAMP)
        ON DUPLICATE KEY UPDATE loc = '$loc', timestamp = CURRENT_TIMESTAMP";
    $update = $sql->query($sql_update);

    return $sql->error;
}

?>
