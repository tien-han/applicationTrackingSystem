<?php
    session_start();
    $_SESSION["logged_in"] = false;
    // call database pull for email to check password and get userID
    include ('../data-processing/user-pull.php');

    if (isset($_GET['logged_out'])) {
        echo "<script>alert('You have been logged out.');</script>";
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["username"];
        $password = $_POST["password"];

        // Check if password matches the one in database for the email
        //Go through all the user roles and assign session & cookies per their permissions
        if ($password == $passwordDB) {
            //If the user is an admin AND a user
            if (count($permissions) > 1) {
                setPermissions($userId, "admin-user");
            } else {
                //If the user only has one role
                $permission = $permissions[0];
                if ($permission == "Admin") {
                    setPermissions($userId, "Admin");
                } else if ($permission == "User") {
                    setPermissions($userId, "User");
                }
            }
        } else {
            //If the password doesn't match, let the user know
            $error_message = "Invalid username or password";
        }
    }

    function setPermissions($userId, $permissionRole) {
        // Set the logged-in status in the session
        $_SESSION["logged_in"] = true;
        $_SESSION["userId"] = $userId;

        // Assign the cookie key-value pair for the admin permissions
        setcookie("permissions", $permissionRole, time() + (86400 * 30), "/"); // 86400 = 1 day

        //Set a cookie for the individual's ID as well
        setcookie("userId", $userId);

        //Redirect to the user's main dashboard
        if ($permissionRole == "Admin") {
            header("Location: admin-admin-dashboard.html");
        } else if ($permissionRole == "User") {
            header("Location: user-user-dashboard.html");
        } else if ($permissionRole == "admin-user") {
            header("Location: admin-dashboard.html");
        }
        exit();
    }
?>
<!-- Navbar -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Dashboard</title>
    <!-- Favicon for the tab -->
    <link rel="icon" type="image/x-icon" href="../images/GRC_logo.png">
    <!-- Bootstrap CDN -->
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <!-- Datatables CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
    <!-- Link to connect free icons -->
    <script src="https://kit.fontawesome.com/bf84dcb5c2.js" crossorigin="anonymous"></script>
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
                    <a class="nav-link" href="../index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sign-up.html">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="login.php">Login</a>
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

    <!-- Login Form -->
    <div class="container-fluid">
        <div class="row col-12">
            <header>
                <h1>Login</h1>
            </header>
        </div>
    </div>

    <?php
        if (isset($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        }
    ?>

    <div class="row justify-content-center">
        <form class="form-container pt-0 col-lg-6 col-md-8 col-sm-12 col-12" action="login.php" method="post">
            <section class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required><br>
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required><br>
                <!-- Submit Button -->
                <section class="form-group text-left">
                    <input id="submit-button" type="submit" class="btn btn-primary" value="Login"></input>
                </section>
                <!-- the redirect for resetting passwords -->
                <section>
                    <br>
                    <a href = "../data-processing/password-email.php">Password Reset</a>
                </section>
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
