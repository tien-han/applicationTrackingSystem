<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Redirect the user if they're not an administrator -->
    <script type="text/javascript" src="../scripts/get-cookies.js"></script>
    <script type="text/javascript">
        let permissions = getCookie("permissions");
        if (permissions == "Admin") {
            window.location.replace("/sprint5/pages/admin-admin-announcement.html");
        } else if (permissions == "User") {
            window.location.replace("/sprint5/pages/user-user-dashboard.html");
        } else if (permissions == "admin-user") {
            //We don't actually want to do anything, but if we provide this then we can have a catch-all else statement
        } else {
            window.location.replace("/sprint5/index.html");
        }
    </script>
    <title>Admin Announcement Form</title>
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
                    <a class="nav-link" href="../pages/admin-dashboard.html">Admin Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../pages/admin-announcement.html">Admin Announcement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/user-dashboard.html">Student Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/new-app.html">Add New Application</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/contact.html">Contact Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
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
            $to = '';

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
            $mailSuccess = mail($to, $subject, $message, $headers);

                // print out the receipt
                    echo "
                        <div class='container-fluid'>
                            <div class='row col-12'>
                                <header>
                                    <h1>Admin Announcement Form Completed</h1>
                                </header>
                            </div>

                            <div class='row justify-content-center'>
                                <div class='form-container pt-0 col-lg-6 col-md-8 col-sm-12 col-12'>
                                    <h1 class='pt-5 header-text text-center'>Thank You.</h1>
                                    <div class='form-response'>
                                        <p>The details you entered are:</p>
                                        <p><b>Title</b>: " . $title . "</p>
                                        <p><b>Job Type</b>: " . $jobType . "</p>
                                        <p><b>Employer</b>: " . $employer . "</p>
                                        <p><b>Email</b>: " . $email . "</p>
                                        <p><b>Location</b>: " . $location . "</p>
                                        <p><b>Url</b>: " . $url . "</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
            } else {
                // tell the user to go to the contact form and fill it out
                echo "<div class='form-container pt-0'>
                <div class = 'row justify-content-center'>
                <div class='form-container pt-0 col-lg-6 col-md-8 col-sm-10 col-12'>
                <h1 class='pt-5 header-text m-auto'>Error!</h1>
                <br>
                <p>Please fill out the form below. </p>
                <p>An email will not be sent until there is content.</p>
                </div>
                </div>
                </div>
                ";}
        require '/home/cicadagr/atsdb.php';
        require '../data-processing/get-users-email.php';

        $userId = 1;

        // Insert data into the database
        $stmt = $cnxn->prepare("INSERT INTO announcements (userId, date, title, more_info, job_type, location, employer, url, email) VALUES (?, NOW(), ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $userId, $title, $moreInfo, $jobType, $location, $employer, $url, $email);

        if ($stmt->execute()) {
            echo "Announcement submitted successfully.";

            $emails = fetchUserEmails($cnxn);
            $emailSuccess = true;

            foreach ($emails as $email) {
                if (!mail($email, $subject, $message, $headers)) {
                    error_log("Failed to send email to $email");
                    $emailSuccess = false;
                }
            }

            if ($emailSuccess) {
                echo "All emails sent successfully.";
            } else {
                echo "Failed to send one or more emails.";
            }
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $cnxn->close();
    ?>

    <!--Scripts-->
    <!-- Bootstrap CDN link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <!-- Form validation and dark mode script -->
    <script type="text/javascript" src="../scripts/script.js"></script>
</body>
</html>
