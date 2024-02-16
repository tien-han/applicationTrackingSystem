<?php // This php file will populate the form with fields from the SQL database
// it will get the applicationID from the button submission to find the correct line

require '/home/cicadagr/atsdb.php';
// don't forget to grab the ID to use for filling the form from the button
$applicationsID = $_POST['applicationID'];

$sql = "SELECT * FROM applications WHERE applicationsID = '$applicationsID'";

$result = @mysqli_query($cnxn, $sql);

// assign values to variables to place in fields initially
while ($row = mysqli_fetch_assoc($result))
{
    $RoleName = $row['role_name'];
    $jobDesc = $row['job_description'];
    $submissionDate = $row['created_at'];
    $followUpDateDisplay = $row['follow_up_date'];
    $employerName = $row['employer_name'];
    $appStatus = $row['status'];
    $contactName = $row['contact_name'];
    $contactEmail = $row['contact_email'];
    $contactPhone = $row['contact_phone'];
    $notes = $row['notes'];
}





