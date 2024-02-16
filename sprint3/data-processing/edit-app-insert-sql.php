<?php
$applicationsID = 1;

include "../form-responses/edit-app-form.php";
// create a function to clean input
function clean_form_responses($data) {
    return trim(stripslashes(htmlspecialchars($data)));
}
// Ensure the form is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $roleName = clean_form_responses($_POST['RoleName']);
    $jobDesc = clean_form_responses($_POST['Jobdesc']);
    $employerName = clean_form_responses($_POST['employerName']);
    $contactName = clean_form_responses($_POST['ContactName']);
    $contactEmail = clean_form_responses($_POST['ContactEmail']);
    $contactPhone = clean_form_responses($_POST['ContactPhone']);
    $notes = clean_form_responses($_POST['InterviewNotes']);
    $appStatus = clean_form_responses($_POST['Appliedposition']);

    // Construct the SQL UPDATE (since the file already exists) query
    $sql = "UPDATE applications 
            SET role_name = '$roleName',
                job_description = '$jobDesc',
                employer_name = '$employerName',
                contact_name = '$contactName',
                contact_email = '$contactEmail',
                contact_phone = '$contactPhone',
                notes = '$notes',
                status = '$appStatus'
            WHERE applicationsID = $applicationsID";

    $result = mysqli_query($cnxn, $sql);

    // Check if it went through
    if ($result) {
        // use javascript to update the invisible part
        validateSuccess();

    } else {
        // Handle the error
        echo "Error updating record: " . mysqli_error($cnxn);
    }
}
?>