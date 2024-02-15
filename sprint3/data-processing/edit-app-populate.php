<?php

require '/home/cicadagr/atsdb.php';

// prefill fields with current data
// TODO: add a WHERE statement to match selected app with SQL apps
$sql = "SELECT * FROM applications)";
$result = @mysqli_query($cnxn, $sql);
// assign values to variables to place in fields initially
while ($row = mysqli_fetch_assoc($result))
{
    $RoleName = $row['role_name'];
    $jobDesc = $row['job_description'];
    $currentDateInput = $row['created_at'];
    $followUpDateDisplay = $row['follow_up_date'];
    $employerName = $row['employer_name'];
    $appStatus = $row['status'];
    $contactName = $row['contact_name'];
    $contactEmail = $row['contact_email'];
    $contactPhone = $row['contact_phone'];
    $notes = $row['notes'];
}


