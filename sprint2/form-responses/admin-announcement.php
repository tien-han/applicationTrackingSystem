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
<nav class="navbar navbar-expand-md fixed-top navbar-dark" role="navigation">
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
                <a class="nav-link" href="../index.html">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="../pages/admin-dashboard.html">Admin Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="../pages/admin-announcement.html">Admin Announcement</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/new-app.html">New Application</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../pages/sign-up.html">Sign Up</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="../pages/contact.html">Contact</a>
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
<!--Form Handling for admin announcement Form-->




<?php
if (isset($_POST['url']) && $_POST['url'] != '' &&
    isset($_POST['title']) && $_POST['title'] != '' &&
    isset($_POST['email']) && $_POST['email'] != '') {
    // Collect form data
    $title = $_POST['title'];
    $jobType = $_POST['job_type'];
    $location = $_POST['location'];
    $employer = $_POST['employer'];
    $moreInfo = $_POST['more_info'];
    $url = $_POST['url'];
    $email = $_POST['email'];
    $headers = "From: $employer" . "\r\n Reply-to: $email";
    $to = 'faison.eugene@student.greenriver.edu';

    // Create email message
    $subject = "New Admin Announcement: $title";
    $message = "
        <html>
        <head>
            <title>New Admin Announcement</title>
        </head>
        <body>
            <h2>Admin Announcement Details:</h2>
            <p><strong>Title:</strong> $title</p>
            <p><strong>Job or Internship:</strong> $jobType</p>
            <p><strong>Location:</strong> $location</p>
            <p><strong>Employer:</strong> $employer</p>
            <p><strong>More Information:</strong> $moreInfo</p>
            <p><strong>URL:</strong> $url</p>
        </body>
        </html>
    ";

    // Set headers for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Send email
    $mailSuccess = mail($to, $email, $subject, $moreInfo, $headers);


 // print out the reciept
            echo "<div class='form-container pt-0'>
            <div class = 'row justify-content-center'>
            <div class='form-container pt-0 col-lg-4 col-md-8 col-sm-12 col-12'>

            <h1 class='pt-5 header-text'>A response will be sent soon, thank you!</h1>
            <h5>Here's what you just entered:</h5><br/>
            <p>The name you added was: " . $title . ".</p>
            <p>The job type you added was: " . $jobType . ".</p>
            <p>The location you added was: " . $location . ".</p>
            <p>The subject of your message was: " . $subject . "</p>
            <p>The email you added was: " . $email . ".</p>
            <p>The message you added was: " . $moreInfo . ".</p>
            <p>The employer you added was: " . $employer . ".</p>
            <p>The url you added was: " . $url . ".</p>
            </div>
            </div>
            </div>";
        } else {
            // tell the user to go to the contact form and fill it out
            echo "<div class='form-container pt-0'>
            <div class = 'row justify-content-center'>
            <div class='form-container pt-0 col-lg-4 col-md-8 col-sm-10 col-12'>
            <h1 class='pt-5 header-text m-auto'>Error!</h1>
            <br>
            <p>Please fill out the form below. </p>
            <p>An email will not be sent until there is content.</p>
            </div>
            </div>
            </div>
            ";}

?>

<!--Scripts-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="../scripts/script.js"></script>

</body>
</html>
