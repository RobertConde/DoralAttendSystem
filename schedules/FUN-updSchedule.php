<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/sql/connectSQL.php";

function updSchedule($studID, $per, $updFac) {
    global $sql_conn;

    // Update schedule
    $sql_insert = "INSERT INTO schedules (id, p$per)
        VALUES ($studID, $updFac)
        ON DUPLICATE KEY UPDATE
            p$per = $updFac";

    return $sql_conn->query($sql_insert);
}

?>

