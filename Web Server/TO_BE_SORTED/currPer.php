<?php
const format = "g:i A";
$classes = Array(  // Beginning of class
    1 => date_create_from_format(format, "7:15 AM"),
    2 => date_create_from_format(format, "8:22 AM"),
    3 => date_create_from_format(format, "10:10 AM"),
    4 => date_create_from_format(format, "12:44 PM"),
    5 => date_create_from_format(format, "3:30 PM"),  // End of School
);

function currPer()
{
    global $classes;

    date_default_timezone_set("America/New_York");
    //$timestamp = new DateTime("now");
    $timestamp = date_create_from_format(format, "7:30 AM");
    echo $timestamp->format("Y-m-d g:i A") . "<br><br>";

    for($per = 1; $per < 5; $per++) {
        echo $classes[$per]->format("Y-m-d g:i A") . "<br>";
        if($classes[$per] <= $timestamp && $timestamp < $classes[$per + 1]) {
            if($per == 1)
                return 1;

            $per = ($per - 1 ) * 2;
            if(isADay())
                $per += 1;

            return $per;
        }
    }

    return -1;
}

/* TODO: isADay() */
function isADay() {
    return true;
}

echo currPer();

?>
