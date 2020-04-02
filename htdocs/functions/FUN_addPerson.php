<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/require/connectSQL.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/functions/FUN_info.php";

function addPerson($uid, $id, $fName, $lName, $secLev, $email)
{
    global $sql_conn;

    // If person isn't faculty, set email to 'NULL'
    $email = ($secLev == 2) ? "'$email'" : $email = "NULL";

    // Check that person doesn't already exist (UID & ID)
    if (existsUID($uid) || existsID($id))
        die ("<b><i>Already in DB!</i></b>");

    // Add to DB
    $sql_insert = "INSERT INTO info (uid, id, fName, lName, secLev, email)
                VALUES ('$uid', $id, '$fName', '$lName', $secLev, $email)";
    $insert = $sql_conn->query($sql_insert);

    // Check that insertion did not have an error
    if (!$insert)
        die ("<b>Failed Adding Person: </b>" . $sql_conn->error);

    // Display success message
    echo "Successfully added person '$fName $lName' (ID: '$id') with UID '$uid', security level '$secLev', and email '$email' (NULL for students).";
}

?>