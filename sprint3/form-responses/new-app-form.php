<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link rel="stylesheet" href="../css/styles.css">

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
                    <a class="nav-link" href="../index.html">Student Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/admin-dashboard.html">Admin Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/admin-announcement.html">Admin Announcment</a>
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


    $to = 'Matthews.Colton@student.greenriver.edu';


    // Create email message
    $subject = "New Application Submission: $roleName";
    $message = "
        <html>
        <head>
            <title>New Application Submission</title>
        </head>
        <body>
            <h2>Application Details:</h2>
            <p><strong>Role Name:</strong> $roleName</p>
            <p><strong>Job Description:</strong> $jobDesc</p>
            <p><strong>Employer Name:</strong> $employerName</p>
            <p><strong>Contact Name:</strong> $contactName</p>
            <p><strong>Contact Email:</strong> $contactEmail</p>
            <p><strong>Contact Phone:</strong> $contactPhone</p>
            <p><strong>Interview Notes:</strong> $interviewNotes</p>
            <p><strong>Application Status:</strong> $applicationStatus</p>
        </body>
        </html>
    ";


    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


    $headers .= "From: Matthews.Colton@student.greenriver.edu" . "\r\n";

    // Attempt to send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "<html><head><title>Submission Successful</title></head><body>";
        echo "<h2>Application Submitted Successfully!</h2>";
        echo "<p>Thank you for submitting your application.</p>";
        echo "</body></html>";
    } else {
        echo "<html><head><title>Error</title></head><body>";
        echo "<h2>There was an error submitting your application.</h2>";
        echo "<p>Please try again later.</p>";
        echo "</body></html>";
    }
} else {

    header("Location:new-app.html");
}
?>

    <!--Scripts-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script type="text/javascript" src="../scripts/script.js"></script>
</body>
</html>