<?php
/* This file will pull the announcements from the last 5 days.
    It is intended to be used with a javascript fetch call.
    It does not use prepared SQL calls (since announcements are viewed by all
    we are not passing any id through, only dates)

    Author: Sage Markwardt
    File: get-recent-announcements
    Date last updated: 2/28/2024
   */

    // TODO: change column names to table accurate names instead of place holders.
    // tell php not to do anything with the following information just yet
    ob_start();
    header('Content-Type: application/json');

    // require our database
    require '/home/cicadagr/atsdb.php';

    // grab the announcements and order by date, most recent first
    $sql = "SELECT * FROM announcements
                ORDER BY date DESC";

    $result = mysqli_query($cnxn, $sql);
    $reminders = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // save each row to the array
            $reminders[] = $row;
        }
    } else {
        $reminders = ["error" => "No reminders found."];
    }
    // let php know we're done going through the data
    ob_end_clean();
    // echo the json data for javascript to use
    echo json_encode($reminders);
?>
