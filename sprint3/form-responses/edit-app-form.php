<?php
require "../data-processing/edit-app-populate.php"
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

    <!-- Edit Application Form -->
        <div class='container-fluid'>
            <div class='row col-12'>
                <header>
                    <h1>Edit Application</h1>
                </header>
            </div>

    <!-- NOTE: Updated id for form to mitigate conflict with styling
        uses same JavaScript as new app since the data is the same-->
    <!-- TODO: change JavaScript to check for changed value-->

        <div class="row justify-content-center">
            <form class = "form-container pt-0 col-lg-6 col-md-8 col-sm-12 col-12" method="POST" action="../data-processing/edit-app-insert-sql.php" onsubmit="return validateEditAppForm()">
                <input type="hidden" name="applicationId" value="<?php echo $applicationsId;?>">

                <section class="form-group">
                    <label for="RoleName" class="form-label">Name of role* </label>
                    <span class="text-danger" id="RoleName-error"></span>
                    <input type="text" id="RoleName" name="RoleName" class="form-control" value = "<?php echo $RoleName;?>" required >
                </section>

                <section class="form-group">
                    <label for="Jobdesc" class="form-label">Job Description* </label>
                    <span class="text-danger" id="message-error"></span>
                    <textarea id="Jobdesc" name="Jobdesc" rows="5" class= "form-control" required><?php echo $jobDesc;?></textarea>
                </section>

                <section class="form-group">
                    <label for = "submissionDate" class="form-label">Date of Application </label>
                    <br>
                    <input type="date" name = "submissionDate" id="submissionDate" value = "<?php echo "$submissionDate";?>">
                </section>

                <section class="form-group">
                    <label for = "followUpDateDisplay" class="form-label">Follow up date </label>
                    <br>
                    <input type="date" name = "followUpDateDisplay" id="followUpDateDisplay" value = "<?php echo "$followUpDateDisplay";?>">
                </section>

                <section class="form-group">
                    <label for="employerName" class="form-label">Employer Name*</label>
                    <span class="text-danger" id="employerName-error"></span>
                    <input type="text" id="employerName" name="employerName" class="form-control" value = "<?php echo $employerName;?>" required>
                </section>

                <section class="form-group">
                    <!-- This contains the radio buttons field -->
                    <div class="form-field form" id="appStatus" >
                        <label for ="appStatus" class = "form-label">Status</label><br>
                        <!-- create the radio buttons with the chosen one from database selected -->
                        <?php
                        // define possible options and their values
                        $options = array(
                            'NeedApply' => 'Need to apply',
                            'Applied' => 'Applied',
                            'Interviewing' => 'Interviewing',
                            'Rejected' => 'Rejected',
                            'Accepted' => 'Accepted',
                            'Inactive' => 'Inactive/Expired'
                        );
                        // use for loop and the function to create our radio buttons
                        foreach ($options as $optionValue => $optionLabel): ?>
                            <input type="radio" name="Appliedposition" id="<?php echo $optionValue; ?>" value="<?php echo $optionValue; ?>" <?php echo ($appStatus == $optionValue) ? 'checked' : ''; ?>>
                            <label for="<?php echo $optionValue; ?>"><?php echo $optionLabel;
                            echo "</label><br>";
                            // end the loop
                            endforeach;
                        ?>
                    </div>
                </section>

                <section class="form-group">
                    <label for="ContactName" class="form-label">Contact Name</label>
                    <span class="text-danger" id="name-error"></span>
                    <input type="text" id="ContactName" name="ContactName" class="form-control"  value = "<?php echo "$contactName"; ?>">
                </section>

                <section class="form-group">
                    <label for="ContactEmail" class="form-label mt-2">Contact Email</label>
                    <span class="text-danger" id="email-error"></span>
                    <input type="text" id="ContactEmail" name="ContactEmail" class="form-control" value = "<?php echo "$contactEmail"; ?>">
                </section>

                <section class="form-group">
                    <label for="ContactPhone" class="form-label mt-2">Contact Phone</label>
                    <span class="text-danger" id="phone-error"></span>
                    <input type="text" id="ContactPhone" name="ContactPhone" class="form-control" value = "<?php echo "$contactPhone"; ?>">
                </section>

                <section class="form-group">
                    <label for="InterviewNotes" class="form-label">Interview Notes*</label>
                    <span class="text-danger" id="InterviewNotes-error"></span>
                    <textarea id="InterviewNotes" name="InterviewNotes" rows="5" class="form-control"><?php echo "$notes";?></textarea>
                </section>

                <div class="row">
                    <div class="col-12">
                        <input id="submit" type="submit" value="Submit" class="btn btn-primary mt-3">

                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--Scripts-->
    <!-- Bootstrap CDN link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <!-- Form validation and dark mode script -->
    <script type="text/javascript" src="../scripts/script.js"></script>
</body>

</html>

