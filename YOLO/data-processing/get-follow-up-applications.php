<!-- This document will get data from the database to figure out
    which applications are due for follow-ups.

    Author: Sage Markwardt
    File: get-follow-up-applications.php
    Last edited: 2/26/2024
 -->
<?php
    ob_start();
    header('Content-Type: application/json');
    require '/home/cicadagr/atsdb.php';

    // grab the applications starting with the earliest follow up date
    $sql = "SELECT * FROM applications 
         ORDER BY follow_up_date";

    $result = mysqli_query($cnxn, $sql);

    // create an array for saving the rows into
    $recentApplications = [];

    // get the rows for javascript to grab
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $recentApplications[] = $row;
        }
    } else {
        // if it fails, print the error
        $recentApplications = ["error" => "No recent applications found."];
    }
    ob_end_clean();
    // echo the json for javascript to fetch
    echo json_encode($recentApplications);
?>

