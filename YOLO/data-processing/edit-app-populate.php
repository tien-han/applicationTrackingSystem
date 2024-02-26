<?php
$applicationsId = $_POST['applicationId'];

require '/home/cicadagr/atsdb.php';

$sql = "SELECT * FROM applications WHERE applicationsId = '$applicationsId'";

$result = @mysqli_query($cnxn, $sql);

// assign values to variables to place in fields initially
while ($row = mysqli_fetch_assoc($result))
{
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

?>

