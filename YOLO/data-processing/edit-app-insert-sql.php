<!--This file handles inserting apps into the database after they're edited.
    It uses prepared statements for the sql execution.

    Author: Sage Markwardt
    File: edit-app-insert-sql.php
    Last changed: 2/26/2024
    -->

<?php
    // require database connection file
    require '/home/cicadagr/atsdb.php';

    // grab the applicationId we're matching to
    $applicationsId = $_POST['applicationId'];

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

    // make sure the dates are in the correct format for the database
    $submissionDate = date("Y-m-d H:i:s", strtotime($submissionDate . " 00:00:00"));
    $followUpDate = date("Y-m-d H:i:s", strtotime($followUpDate . " 00:00:00"));

    // Construct the SQL UPDATE (since the file already exists) query
    $sql = "UPDATE applications 
                    SET role_name = ?,
                        job_description = ?,
                        employer_name = ?,
                        contact_name = ?,
                        contact_email = ?,
                        contact_phone = ?,
                        notes = ?,
                        status = ?,
                        application_date = ?, 
                        follow_up_date = ?
                WHERE applicationsId = ?";

    // prepare the connection
    $stmt = mysqli_prepare($cnxn, $sql);

    // if the connection runs, bind the values from the update page to the question marks
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssssssssss', $roleName, $jobDesc, $employerName, $contactName, $contactEmail, $contactPhone,
            $notes, $appStatus, $submissionDate, $followUpDate, $applicationsId);

        //execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // do nothing if it works
        } else {
            // print the error if it doesn't work
            echo "Error: " . mysqli_error($cnxn);
        }
        mysqli_stmt_close($stmt);
    }
    else {
        // if statement doesn't prep, print error
        echo "Error preparing statement: " . mysqli_error($cnxn);
    }
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Application Form</title>
        <link rel="icon" type="image/x-icon" href="../images/GRC_logo.png">
        <!-- Bootstrap CDN -->
        <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
              integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
        <!-- Our personal CSS styles -->
        <link rel="stylesheet" href="../css/styles.css">
        <!-- Setting dark mode theme before page loads -->
        <script type="text/javascript" src="../scripts/set-theme.js"></script>
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
    echo "<head>
            <title>Application Updated</title>
        </head>
                <div class='container-fluid'>
                    <div class='row col-12'>
                        <header>
                            <h1>Application Changes Saved</h1>
                        </header>
                    </div>
       
           
                <div class='row justify-content-center'>
                    <div class='form-container pt-0 col-lg-6 col-md-8 col-sm-12 col-12'>
                        <h1 class='pt-5 header-text text-center'>Your application has been updated!</h1>
                        <div class = 'form-response'>
                            <p>The details for this application are now:</p>
                            <p><b>Role name: </b> " . $roleName . ".</p>
                            <p><b>Job description</b> " . $jobDesc . ".</p>
                            <p><b>Employer:</b> " . $employerName . ".</p>
                            <p><b>Contact name:</b> " . $contactName . ".</p>
                            <p><b>Contact email:</b> " . $contactEmail . ".</p>
                            <p><b>Contact phone:</b> " . $contactPhone . ".</p>
                            <p><b>Interview notes:</b> " . $notes . ".</p>
                            <p><b>Status:</b> " . $appStatus . ".</p>
                            <p><b>Application date:</b> " . $submissionDate . ".</p>
                            <p><b>Follow up date:</b> " . $followUpDate . ".</p>
                        </div>
                    </div>
                </div>
            </div>
            ";
// Scripts
echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous">
        </script>
        <script type="text/javascript" src="../scripts/script.js"></script>
        </body>
    </html>';
?>