<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/sql/SQL.php";

function updSchedule($studID, $per, $updFac) {
    global $sql;

    // Update schedule
    $sql_insert = "INSERT INTO schedules (id, p$per)
        VALUES ($studID, $updFac)
        ON DUPLICATE KEY UPDATE
            p$per = $updFac";

    return $sql->query($sql_insert);
}

?>

