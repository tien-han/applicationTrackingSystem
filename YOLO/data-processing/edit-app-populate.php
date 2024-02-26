<!-- This document will get data from the database to populate the form for editing
    an application.

    Author: Sage Markwardt
    File: edit-app-populate.php
    Last edited: 2/26/2024
 -->
<?php
// Get the application ID
$applicationsId = $_POST['applicationId'];

require '/home/cicadagr/atsdb.php';

// use a placeholder for our id so it's kept secret
$sql = "SELECT * FROM applications WHERE applicationsId = ?";

// Prepare the statement
if ($stmt = mysqli_prepare($cnxn, $sql)) {
    // 'bind' the variable containing what should go where the question mark is
    mysqli_stmt_bind_param($stmt, "i", $applicationsId);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // go through and get each variable from the database
    while ($row = mysqli_fetch_assoc($result)) {
        // assign values to variables to place in fields initially
        $RoleName = $row['role_name'];
        $jobDesc = $row['job_description'];
        $submissionDate = $row['application_date'];
        $followUpDateDisplay = $row['follow_up_date'];
        $employerName = $row['employer_name'];
        $appStatus = $row['status'];
        $contactName = $row['contact_name'];
        $contactEmail = $row['contact_email'];
        $contactPhone = $row['contact_phone'];
        $notes = $row['notes'];
    }

    // change dates to correct date format (not datetime)
    $submissionDate = date("Y-m-d", strtotime($submissionDate));
    $followUpDateDisplay = date("Y-m-d", strtotime($followUpDateDisplay));

    // Close the statement
    mysqli_stmt_close($stmt);
}
?>

