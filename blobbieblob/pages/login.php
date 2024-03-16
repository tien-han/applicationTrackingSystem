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
                echo "admin and student";
            } else {
                //If the user only has one role
                $permission = $permissions[0];
                if ($permission == "Admin") {
                    setAdmin($userId);
                } else if ($permission == "User") {
                    setUser($userId);
                }
            }
            exit();
        } else {
            //If the password doesn't match, let the user know
            $error_message = "Invalid username or password";
        }
    }

    function setAdmin($userId) {
        // Set the logged-in status in the session
        $_SESSION["logged_in"] = true;
        $_SESSION["userId"] = $userId;

        // Assign the cookie key-value pair for the admin permissions
        $cookie_name = "permissions";
        $cookie_value = "Admin";
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

        //Set a cookie for the administrator's ID as well
        $cookie_name = "userId";
        setcookie($cookie_name, $userId);

        //Redirect to the admin dashboard
        header("Location: admin-dashboard.html");
    }

    function setUser($userId) {
        // Set the logged-in status in the session
        $_SESSION["logged_in"] = true;
        $_SESSION["userId"] = $userId;

        // Assign the cookie key-value pair for the user permissions
        $cookie_name = "permissions";
        $cookie_value = "User";
        setcookie($cookie_name, $cookie_value);

        // store the userId in a cookie as well
        $cookie_name = "userId";
        setcookie($cookie_name, $userId);

        //Redirect to the user dashboard
        header("Location: user-user-dashboard.html");
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
                    <a class="nav-link active" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/sign-up.html">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages/contact.html">Contact</a>
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

    <h2>Login</h2>

    <?php
        if (isset($error_message)) {
            echo "<p style='color: red;'>$error_message</p>";
        }
    ?>

    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>