<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/require/connectSQL.php";

function updateAttend($id, $per, $date, $mark)
{
    global $sql_conn;

    $date = (strlen($date) == 0) ? "CURRENT_DATE" : "'" . $date . "'";

    // Delete if already in 'attend'
    $sql_delete = "DELETE FROM attend
        WHERE id = $id AND per = $per AND date = $date";
    if (!$sql_conn->query($sql_delete))
        die("Failed to delete!");

    // If already in 'attend' then update, else insert
    $sql_updateAttend = "INSERT INTO attend (id, per, date, mark)
        VALUES ($id, $per, $date, '$mark')";
    if (!$sql_conn->query($sql_updateAttend))
        die("Failed to insert!");

    echo "Successfully updated attendance.";
}

?>