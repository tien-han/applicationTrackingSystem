<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Application Form</title>
    <link rel="icon" type="image/x-icon" href="../images/GRC_logo.png">
    <!-- Bootstrap CDN -->
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <!-- Our personal CSS styles -->
    <link rel="stylesheet" href="../css/styles.css">
    <!-- Setting dark mode theme before page loads -->
    <script type="text/javascript" src="../scripts/set-theme.js"></script>
</head>

<body>
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
                <a class="nav-link" href="../pages/user-dashboard.html">Student Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/admin-dashboard.html">Admin Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/admin-announcement.html">Admin Announcement</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="../pages/new-app.html">New Application</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/sign-up.html">Sign Up</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/contact.html">Contact</a>
            </li>
        </ul>
    </div>
    <!-- Dark Mode Toggler -->
    <div id="darkmode-container" class="nav-item text-center px-3" hidden="true">
        <input type="checkbox" id="darkmode-toggle"></input>
        <label id="darkmode-label" for="darkmode-toggle"></label>
    </div>
</nav>
<br />
<br />
<br />
<br />

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $roleName = $_POST['RoleName'];
    $jobDesc = $_POST['Jobdesc'];
    $employerName = $_POST['employerName'];
    $contactName = $_POST['ContactName'] ;
    $contactEmail = $_POST['ContactEmail'];
    $contactPhone = $_POST['ContactPhone'] ;
    $interviewNotes = $_POST['InterviewNotes'];
    $applicationStatus = $_POST['Appliedposition'];
    $application_date = $_POST['application_date'];
    $follow_up_date = $_POST['follow_up_date'];

    $to = 'Matthews.Colton@student.greenriver.edu';


    echo "<html><head><title>Submission Successful</title></head><body>";
    echo "<div class='form-container pt-0'>
            <div class='row justify-content-center'>
            <div class='form-container pt-0 col-lg-6 col-md-8 col-sm-12 col-12'>
                <h1 class='pt-5 header-text'>A response will be sent soon, thank you!</h1>
                <h5>Here's what you just entered:</h5><br/>
                <p>The Role Name you added was: " . htmlspecialchars($roleName) . ".</p>
                <p>The Job Description you added was: " . htmlspecialchars($jobDesc) . ".</p>
                <p>The employer name you added was: " . htmlspecialchars($employerName) . ".</p>
                <p>The contact name you added was: " . htmlspecialchars($contactName) . ".</p>
                <p>The email you added was: " . htmlspecialchars($contactEmail) . ".</p>
                <p>The Contact Phone you added was: " . htmlspecialchars($contactPhone) . ".</p>
                <p>The Interview Notes You added were: " . htmlspecialchars($interviewNotes) . ".</p>
                <p>Your Application Status is: " . htmlspecialchars($applicationStatus) . ".</p>
                <p>Your Application date is: " . htmlspecialchars($application_date) . ".</p>
                <p>Your Application follow up date is: " . htmlspecialchars($follow_up_date) . ".</p>
            </div>
            </div>
          </div>";
    echo "</body></html>";
}
else {
    // Redirect to the form if the request method is not POST
    header("Location: new-app.html");
}
require '/home/cicadagr/atsdb.php';


$sql = "INSERT INTO applications (userId, role_name, job_description, employer_name, contact_name, contact_email, contact_phone, notes, status, application_date,follow_up_date ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($cnxn, $sql);


if ($stmt) {

    $userid = $userid = 1;
    mysqli_stmt_bind_param($stmt, 'sssssssssss', $userid, $roleName, $jobDesc, $employerName, $contactName, $contactEmail, $contactPhone, $interviewNotes, $applicationStatus,$application_date ,$follow_up_date);



    if (mysqli_stmt_execute($stmt)) {
        echo "";
    } else {

        echo "Error: " . mysqli_error($cnxn);
    }

    mysqli_stmt_close($stmt);
} else {

    echo "Error preparing statement: " . mysqli_error($cnxn);
}



?>

<!--Scripts-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<!-- Form validation and dark mode script -->
<script type="text/javascript" src="../scripts/script.js"></script>
</body>
</html>