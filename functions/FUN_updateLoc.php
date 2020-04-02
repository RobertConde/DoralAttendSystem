<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/require/connectSQL.php";

function updateLoc($id, $loc)
{
    global $sql_conn;

    // If already in 'locs' then update, else insert
    $sql_updateLoc = "INSERT INTO locs (id, lastLoc, time)
        VALUES ($id, '$loc', CURRENT_TIMESTAMP)
        ON DUPLICATE KEY UPDATE lastLoc = '$loc', time = CURRENT_TIMESTAMP";
    if (!$sql_conn->query($sql_updateLoc))
        die("Failed to update!");

    echo "Successfully updated location.";
}

?>