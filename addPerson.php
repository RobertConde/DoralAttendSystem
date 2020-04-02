<!--HTML-->
<title>Add Person</title>
<link rel="stylesheet" href="style.css">

<h1><b><u>Add Person to 'info' Database</u></b></h1>
<form id="addPerson" action="" method="post">
    <label><b>UID: </b><input type="text" name="uid"></label> <br><br>

    <label><b>First Name: </b><input type="text" name="fName"></label> <br><br>

    <label><b>Last Name: </b><input type="text" name="lName"></label> <br><br>

    <label><b>ID: </b><input type="number" name="id"></label> <br><br>

    <label><b>Security Level: </b>
        <label><input type="radio" id="studRad" name="secLev" value="1"> Student</label>
        <label><input type="radio" id="facRad" name="secLev" value="2"> Faculty</label>
    </label><br><br>

    <fieldset id="email-group" style="display: none">
        <label><b>Email: </b><input type="email" id="email" name="email"> </label><br><br>
    </fieldset>

    <input type="submit" name="submit" value="Submit">
</form>

<!--Javascript-->
<script>
    // Get the two radio buttons for the security levels
    let rads = document.forms['addPerson'].elements['secLev'];

    // Add event handler (the function) for each radio button for event 'onchange' to change if the email box should be displayed
    for (let i = 0; i < rads.length; i++) {
        rads[i].onchange = function () {
            let facRad = document.getElementById('facRad');
            let emailGroup = document.getElementById('email-group');

            // If the faculty button is 'checked' (selected) then display the email box, if not, do not display it
            emailGroup.style.display = facRad.checked ? "block" : "none";
        }
    }
</script>

<!--PHP-->
<?php
// If the page has info from a POST request process is and display result on bottom of page
if (isset($_POST['submit'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/functions/FUN_addPerson.php";

    addPerson($_POST['uid'], $_POST['id'], $_POST['fName'], $_POST['lName'], $_POST['secLev'], $_POST['email']);
}
?>