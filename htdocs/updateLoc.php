<!--HTML-->
<title>Update Location</title>
<link rel="stylesheet" href="style.css">

<h1><b><u>Update Location:</u></b></h1>
<form action="" method="POST">
    <label><b>ID: </b><input type="text" name="id"></label> <br><br>

    <label><b>Location: </b><input type="text" name="loc"></label> <br><br>

    <input type="submit" name="submit" value="Submit">
</form>

<!--PHP-->
<?php
if (isset($_POST['submit'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/functions/FUN_updateLoc.php";

    updateLoc($_POST['id'], $_POST['loc']);
}
?>