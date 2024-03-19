<?php
require '/home/cicadagr/atsdb.php';

// include the navbar for the site
?>

    <!-- Navbar -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Password Reset</title>
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
                    <a class="nav-link" href="../pages/sign-up.html">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/contact.html">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../pages/login.php">Login</a>
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

// if ALL the correct items are in the link used to reach this page (i.e. the one that was emailed)
// make sure the POST action from the submitted password has not been done yet as well (no resetting it twice)
if (isset($_GET["key"]) && isset($_GET["email"]) && !isset($_POST["action"])){
    // assign variables
    $key = $_GET["key"];
    $email = $_GET["email"];
    $curDate = date("Y-m-d H:i:s");
    $sql = "SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='$email'";
    $query = mysqli_query($cnxn, $sql);

    // Check if it went through
    if (!$query) {
        // Handle the error
        echo "Error updating record: " . mysqli_error($cnxn);
    } else {
        $row = mysqli_num_rows($query);
    }
    if ($row==""){
        // if the row is empty, the code sat for more than a day and expired or was already used
        echo '<h2>Invalid Link</h2>
                    <p>The link used to access this page was invalid. It is possible your link sat for too long 
                    and expired, or that something happened on our end. Please try again.</p>
                    <p><a href="https://cicada.greenriverdev.com/blobbieblob/data-processing/password-email.php">
                    Click here to reset your password.</a></p>';
    } else {
        // go through the rows and check the expiration date
        $row = mysqli_fetch_assoc($query);
        $expDate = $row['expDate'];

        if ($expDate >= $curDate){
            // if the expiration date is after right now, give them the reset form
            echo '<div class="container-fluid">
                <div class="row col-12">
                    <header>
                        <h1>Password Reset</h1>
                    </header>
                </div>
                <div class="row justify-content-center">
                    <form class = "form-container pt-0 col-lg-6 col-md-8 col-sm-12 col-12" method="post" action="password-reset.php" name="update">
                        <section class="form-group">
                            <input type = "hidden" name = "action" value = "update">
                            <input type="hidden" name="email" value="'.$email.'">
                            <label>Enter a new password</label>
                            <br>
                            <input type="password" name="pass" required>
                        </section>
                                        
                        <section class = "form-group">
                            <input id="submit-button" type="submit" class="btn btn-primary" value="Reset Password">
                        </section>
                    </form>
                </div>
            </div>';
        } else {
            // if the date has passed already, the link is old
            echo "<h2>Link Expired</h2>
                    <p>The link you clicked is expired. The links sent out are only valid for 24 hours.</p>
                    <p><a href='https://cicada.greenriverdev.com/blobbieblob/data-processing/password-email.php'>
                        Click here to request another reset link.</a></p>";
        }
    }
}

// the following if statement will run only once the password has been submitted
if(isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"]=="update")){
    $pass = mysqli_real_escape_string($cnxn,$_POST["pass"]);
    $email = $_POST["email"];
    $curDate = date("Y-m-d H:i:s");

    // set the sql query up and run it
    $sql = "UPDATE users 
                SET password = '$pass'
                WHERE email='$email'";

    $query = mysqli_query($cnxn, $sql);

    // Check if it went through
    if (!$query) {
        // Handle the error
        echo "Error updating record: " . mysqli_error($cnxn);
    } else {
        // remove the reset token from the database after use
        $sql = "DELETE FROM `password_reset_temp` WHERE `email`= '$email'";

        $query = mysqli_query($cnxn, $sql);

        // Check if it went through
        if (!$query) {
            // Handle the error
            echo "Error updating record: " . mysqli_error($cnxn);
        } else {
            echo '<p>Congratulations! Your password has been updated successfully.</p>
                <p><a href="https://cicada.greenriverdev.com/blobbieblob/pages/login.php">
                Click here to Login.</a></p>';
        }

    }

}
?>