<?php

require '/home/cicadagr/atsdb.php';

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
    $submissionDate = clean_form_responses($_POST['submissionDate']);
    $followUpDate = clean_form_responses($_POST['followUpDateDisplay']);
}

// make sure the dates are in the correct format
$submissionDate = date("Y-m-d H:i:s", strtotime($submissionDate . " 00:00:00"));
$followUpDate = date("Y-m-d H:i:s", strtotime($followUpDate . " 00:00:00"));

// Construct the SQL UPDATE (since the file already exists) query
$sql = "UPDATE applications 
            SET role_name = '$roleName',
                job_description = '$jobDesc',
                employer_name = '$employerName',
                contact_name = '$contactName',
                contact_email = '$contactEmail',
                contact_phone = '$contactPhone',
                notes = '$notes',
                status = '$appStatus',
                application_date = '$submissionDate', 
                follow_up_date = '$followUpDate'
        WHERE applicationsId = '$applicationsId'";

$result = mysqli_query($cnxn, $sql);

// Check if it went through
if (!$result) {
    // Handle the error
    echo "Error updating record: " . mysqli_error($cnxn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit An Application</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body id="edit-app-form">
<nav class="navbar navbar-expand-lg fixed-top navbar-dark" role="navigation">
    <!-- Navbar Brand & Toggler -->
    <div class="navbar-header" id="navbar-header">
        <a class="navbar-brand navbar-left px-3" href="https://www.greenriver.edu/" target="_blank"><img
                    alt="Green River College's logo" src="../images/GRC_logo_navbar.png" width="70"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-toggler"
                aria-controls="navbar-toggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span></button>
    </div>
    <!-- Navbar Items with Links -->
    <div class="collapse navbar-collapse" id="navbar-toggler">
        <ul class="navbar-nav align-items-center">
            <li class="nav-item">
                <a class="nav-link" href="../index.html">Student Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/admin-dashboard.html">Admin Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/admin-announcement.html">Admin Announcment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/new-app.html">New Application</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/sign-up.html">Sign Up</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/contact.html">Contact</a>
            </li>
        </ul>
        <ul class="navbar-nav align-items-center ms-auto">
            <!-- Dark Mode Toggler -->
            <li class="nav-item text-center px-3">
                <button type="button" class="btn btn-sm btn-dark" id="dark-light">Dark mode!</button>
            </li>
        </ul>
    </div>
</nav>
<br />
<br />
<br />
<br />

<?php
echo "<html><head><title>Submission Successful</title></head><body>";
echo "<div class='form-container pt-0'>
    <div class='row justify-content-center'>
        <div class='form-container pt-0 col-lg-4 col-md-8 col-sm-12 col-12'>
            <h1 class='pt-5 header-text'>Your application has been updated</h1>
            <h5>Here are your new values</h5><br/>
            <p>The role name you added was: " . $roleName . ".</p>
            <p>The job description you added was: " . $jobDesc . ".</p>
            <p>The employer name you added was: " . $employerName . ".</p>
            <p>The contact name you added was: " . $contactName . ".</p>
            <p>The email you added was: " . $contactEmail . ".</p>
            <p>The Contact Phone you added was: " . $contactPhone . ".</p>
            <p>The Interview Notes you added were: " . $notes . ".</p>
            <p>Your Application Status is: " . $appStatus . ".</p>
            <p>Your Application date is: " . $submissionDate . ".</p>
            <p>Your Application follow up date is: " . $followUpDate . ".</p>
        </div>
    </div>
</div>";
echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="../scripts/script.js"></script>
</body>
</html>';
?>
