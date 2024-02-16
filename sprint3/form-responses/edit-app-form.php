<?php
require "../data-processing/edit-app-populate.php"
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

<!-- Add a New Application Form -->
<div class="container-fluid">
    <div class="row col-12">
        <header>
            <h1>Edit Your Application</h1>
        </header>
    </div>
</div>

<!-- NOTE: Updated id for form to mitigate conflict with styling
    uses same JavaScript as new app since the data is the same-->
<!-- TODO: change JavaScript to check for changed values
    TODO: Use JavaScript to add a message once the new values are saved
   -->

<!-- This message is hidden until the form submits -->
<div class='pt-0 d-none' id = 'successMessage'>
    <div class = 'row justify-content-center'>
        <div class='form-container pt-0 col-lg-4 col-md-8 col-sm-12 col-12'>
            <h1 class='pt-5 header-text m-auto'>Success!</h1>
            <br>
            <p>Your changes have been saved!</p>
        </div>
    </div>
</div>


<div class="row justify-content-center">
    <form class = "form-container pt-0 col-lg-4 col-md-8 col-sm-12 col-12" method="POST" action="../data-processing/edit-app-insert-sql.php" onsubmit="return validateEditAppForm()">
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
        <!-- TODO: How do we set these to the value in the database? -->
        <section class="form-group">
            <h5>Date of Application: </h5>
            <!-- use a hidden element to hold the date from SQL for JavaScript-->
            <input type="hidden" id="DatabaseDate" value="<?php echo "$submissionDate"; ?>">
            <input type="date" id="submissionDate">
        </section>

        <section class="form-group">
            <h5>Follow update: </h5>
            <input type="date" id="followUpDateDispLay">
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
                <!-- Define the possible options for the radio buttons AND the value to show in html-->
                <?php $options = array(
                    'NeedApply' => 'Need to apply',
                    'Applied' => 'Applied',
                    'Interviewing' => 'Interviewing',
                    'Rejected' => 'Rejected',
                    'Accepted' => 'Accepted',
                    'Inactive' => 'Inactive/Expired'
                );

                // use for loop and the function to create our radio buttons
                foreach ($options as $optionValue => $optionLabel): ?>
                <input type="radio" id="<?php echo $optionValue; ?>" name="Appliedposition" value="<?php echo $optionValue; ?>" <?php echo ($appStatus == $optionValue) ? 'checked' : ''; ?>>
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
            <input type="text" id="ContactName" name="ContactName" class="form-control"  value = "<?php echo "$contactName"; ?>" required >
        </section>

        <section class="form-group">
            <label for="ContactEmail" class="form-label mt-2">Contact Email</label>
            <span class="text-danger" id="email-error"></span>
            <input type="text" id="ContactEmail" name="ContactEmail" class="form-control" value = "<?php echo "$contactEmail"; ?>"  required>
        </section>
        <section class="form-group">
            <label for="ContactPhone" class="form-label mt-2">Contact Phone</label>
            <span class="text-danger" id="phone-error"></span>
            <input type="text" id="ContactPhone" name="ContactPhone" class="form-control" value = "<?php echo "$contactPhone"; ?>" required>
        </section>

        <section class="form-group">
            <label for="InterviewNotes" class="form-label">Interview Notes*</label>
            <span class="text-danger" id="InterviewNotes-error"></span>
            <textarea id="InterviewNotes" name="InterviewNotes" rows="5" class="form-control" required><?php echo "$notes";?></textarea>
        </section>

        <div class="row">
            <div class="col-12">
                <input id="submit" type="submit" value="Submit" class="btn btn-primary mt-3">

            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/boot  strap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="../scripts/script.js"></script>
</body>

</html>

