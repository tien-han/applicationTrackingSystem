<?php
    updateUser($_POST);

    //This function handles updating a user's information into the database
    function updateUser($VALUES) {
        $userId = $VALUES['userId'];

        //Get and clean form responses for the user
        $name = cleanFormResponses($VALUES["name"]);
        $email = cleanFormResponses($VALUES["email"]);
        $cohortNum = cleanFormResponses($VALUES["cohortNumber"]);
        $seekingPosition = cleanFormResponses($VALUES["seekingInternship"]);
        $roles = cleanFormResponses($VALUES["seekingRoles"]);

        //Calculate the timestamp for when the user is updated
        $date = date('Y-m-d H:i:s', time());

        //SQL query to update this user in the database
        $updateUserSQL = "
            UPDATE users
            SET
                name = '$name',
                email = '$email',
                cohort = '$cohortNum',
                status = '$seekingPosition',
                roles = '$roles',
                updated_at = '$date'
            WHERE userId = '$userId'
        ";

        //Get DB Connection credentials
        require '/home/cicadagr/atsdb.php';
    
        //Execute the SQL query
        $result = mysqli_query($cnxn, $updateUserSQL);

        // Check if it went through
        if (!$result) {
            // Handle the error
            echo "Error updating record: " . mysqli_error($cnxn);
        }

        //Update the user_roles table to update the user's roles
        updateUserRoles($userId);
    }

    // This function updates the user's roles
    function updateUserRoles($userId) {
        //Get DB Connection credentials
        require '/home/cicadagr/atsdb.php';

        $userPermission = 0;
        $adminPermission = 0;
        if (isset($_POST["user-permissions"])) {
            $userPermission = 2; //2 is the User role
        }
        if (isset($_POST["admin-permissions"])) {
            $adminPermission = 1; //1 is the Admin role
        }

        $getUserRolesSQL = "
            SELECT *
            FROM user_roles
            WHERE userId='$userId'
        ";
        $userRolesResult = mysqli_query($cnxn, $getUserRolesSQL);
        
        $updateUserRolesSQL = "";
        $date = date('Y-m-d H:i:s', time());

        //Look through each database result for the user and admin roles
        while ($userRole = mysqli_fetch_assoc($userRolesResult)) {
            $userRoleId = (int)$userRole['userRoleId'];

            //If the user has user permissions in the database and user permissions were removed
            if ($userRole['roleId'] == "2" && $userPermission == 0) {
                $updateUserRolesSQL = $updateUserRolesSQL . "DELETE FROM user_roles WHERE userRoleId='$userRoleId';";
            }

            //If the user has admin permissions in the database and admin permissions were removed
            if ($userRole['roleId'] == "1" && $adminPermission == 0) {
                $updateUserRolesSQL = $updateUserRolesSQL . "DELETE FROM user_roles WHERE userRoleId='$userRoleId';";
            }
        }

        //If the user does not have user permissions in the db and user permissions were granted
        if ($userPermission == 2) {
            $updateUserRolesSQL = $updateUserRolesSQL . "INSERT INTO user_roles (userId, roleId, created_at)
                                                        VALUES ('$userId', '2', '$date');";
        }

        //If the user does not have admin permissions in the db and admin permissions were granted
        if ($adminPermission == 1) {
            $updateUserRolesSQL = $updateUserRolesSQL . "INSERT INTO user_roles (userId, roleId, created_at)
                                                        VALUES ('$userId', '1', '$date');";
        }

        $userRoleUpdateResult = mysqli_multi_query($cnxn, $updateUserRolesSQL);
    }

    //Clean up form responses to prevent security issues
    function cleanFormResponses($data) {
        return trim(stripslashes(htmlspecialchars($data)));
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
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
                    <a class="nav-link active" href="../pages/sign-up.html">Sign Up</a>
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
        echo "
            <div class='container-fluid'>
                <div class='row col-12'>
                    <header>
                        <h1>User Updated Successfully</h1>
                    </header>
                </div>

                <div class='row justify-content-center'>
                    <div class='form-container pt-0 col-lg-6 col-md-8 col-sm-12 col-12'>
                        <h1 class='pt-5 header-text text-center'>The user " . $_POST['name'] . " has been updated successfully!</h1>
                        <div class='form-response'>
                            <p>The details you entered are: </p>
                            <p><b>Name</b>: " . $_POST['name'] . " </p>
                            <p><b>Email</b>: " . $_POST['email'] . " </p>
                            <p><b>Cohort Number</b>: " . $_POST['cohortNumber'] . "</p>
                            <p><b>Status</b>: " . $_POST['seekingInternship'] . "</p>
                            <p><b>Looking for</b>: " . $_POST['seekingRoles'] . "</p>
        ";

        if (isset($_POST['user-permissions'])) {
            echo "<p><b>User Permissions</b>: Granted</p>";
        } else {
            echo "<p><b>User Permissions</b>: Not granted</p>";
        }

        if (isset($_POST['admin-permissions'])) {
            echo "<p><b>Admin Permissions</b>: Granted</p>";
        } else {
            echo "<p><b>Admin Permissions</b>: Not granted</p>";
        }

        echo "


                        </div>
                    </div>
                </div>
            </div>
        ";
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