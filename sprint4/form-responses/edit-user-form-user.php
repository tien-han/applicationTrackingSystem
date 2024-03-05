<!--
    This page features a "Edit User" form where users can edit their account information.

    Author: Tien Han
    File: edit-user-form-user.php
    Date: 3/4/2024
 -->

<?php
    require "../data-processing/edit-user-populate.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Form</title>
    <link rel="icon" type="image/x-icon" href="../images/GRC_logo.png">
    <!-- Bootstrap CDN -->
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet">
    <!-- Our personal CSS styles -->
    <link rel="stylesheet" href="../css/styles.css">
    <!-- Setting dark mode theme before page loads -->
    <script type="text/javascript" src="../scripts/set-theme.js"></script>
</head>

<body id="sign-up-form">
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
                    <a class="nav-link" href="../pages/admin-announcement.html">Admin Announcement</a>
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

    <!-- Sign Up Form -->
    <div class="container-fluid">
        <div class="row col-12">
            <header>
                <h1>View/Update User</h1>
            </header>
        </div>
    </div>

    <div class="row justify-content-center">
        <form class="form-container pt-0 col-lg-6 col-md-8 col-sm-12 col-12" id="editUser" method="POST"
            action="../data-processing/edit-user-insert.php" onsubmit="return validateEditUser()">
            <input type="hidden" name="userId" value="<?php echo $userId;?>">
            <!-- Name -->
            <div class="form-group">
                <label for="name">Name*</label><span class="text-danger" id="name-error"></span>
                <input type="text" class="form-control" id="name" name="name" maxlength="100" minlength="1"
                    aria-describedby="nameHelp" value="<?php echo $name;?>" required>
            </div>

            <!-- Email -->
            <section class="form-group">
                <label for="email">Email address*</label><span class="text-danger" id="email-error"></span>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                    value="<?php echo $email;?>" required>
                <small id="emailHelp" class="form-text text-muted"></small>
            </section>

            <!-- Cohort Number -->
            <section class="form-group"><span class="text-danger" id="cohort-error"></span>
                <label for="cohortNumber" class="form-label">Cohort Number*</label>
                <input type="number" id="cohortNumber" name="cohortNumber" value="<?php echo $cohort;?>" required>
            </section>

            <!-- Status Radio Buttons -->
            <section class="form-group">
                <label>Status</label>
                <!-- Create the status radio butons with the user's status from the database -->
                <?php
                    //Define all the status options
                    $statusOptions = array(
                        "seekingInternship" => "Seeking Internship",
                        "seekingJob" => "Seeking Job",
                        "notActivelySearching" => "Not Actively Searching"
                    );

                    //Loop through all of the status options and create the radio buttons for the status
                    foreach ($statusOptions as $statusKey => $statusValue):
                ?>
                <div class="form-check">
                    <input type="radio"
                            name="seekingInternship"
                            id="<?php echo $statusKey;?>"
                            value="<?php echo $statusValue;?>"
                        <?php echo ($status == $statusValue) ? "checked" : ""; ?>>
                    <label class="form-check-label" for="<?php echo $statusKey; ?>">
                        <?php
                            echo $statusValue;
                        ?>
                    </label>
                </div>
                <?php
                    endforeach;
                ?>
            </section>

            <!-- Text (Seeking what types of roles) -->
            <section class="form-group">
                <label for="seekingRoles">What types of roles are you seeking?*</label>
                <textarea class="form-control" name="seekingRoles" id="seekingRoles" rows="4" required><?php echo "$roles";?></textarea>
            </section>

            <!-- Submit Button -->
            <section class="form-group text-left">
                <input id="submit-button" type="submit" class="btn btn-primary" value="Send"></input>
            </section>
        </form>
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