<?php
// This file will ask the user to enter an email in order
// to get the password reset code

require '/home/cicadagr/atsdb.php';
?>

<!-- Navbar -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
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

// check if the email has been set
if(isset($_POST["email"]) && (!empty($_POST["email"]))){
    // create the email variable and make sure it's a real email without extra characters
    $email = $_POST["email"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);

    // if the email variable failed (due to not being a real address)
    if (!$email) {
        // print an error message
        $error .="<p>Invalid email address please type a valid email address!</p>";
    } else {

        // look for the user
        $sql = "SELECT * FROM `users` WHERE email = '$email'";
        $results = mysqli_query($cnxn, $sql);
        $row = mysqli_num_rows($results);

        // if the database found no results, return an error
        if ($row==""){
            $error .= "<p>Your email address is not in our database, please sign up.</p>";
        }
    }

    // if there are ANY errors in the error variable,
    if($error!=""){
        // tell the user the error(s) and to go back one page
        echo "<div class='error'>".$error."</div>
               <br /><a href='javascript:history.go(-1)'>Go Back</a>";
    }else{
        // set token to expire in one day
        $expFormat = mktime(
            date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
        );

        $expDate = date("Y-m-d H:i:s",$expFormat);
        // md5 will return the hashcode for their email + another string (note this will not work using email and numbers on the same line)
        $key = md5($email."this_is_going_to_be_hashed");
        $addKey = substr(md5(uniqid(rand(),1)),3,10);
        $key = $key . $addKey;


        // Insert key into the table for checking later
        mysqli_query($cnxn,
            "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
        VALUES ('".$email."', '".$key."', '".$expDate."');");

        // create the email message with the link to reset their password
        $message = '<p>Dear user,</p>
                <p>Please click on the following link to reset your password:</p>
                <br>
                <p><a href = "https://www.cicada.greenriverdev.com/blobbieblob/data-processing/password-reset.php?key='.$key.'&email='.$email.'">
        https://www.cicada.greenriverdev.com/blobbieblob/data-processing/password-reset.php?key='.$key.'&email='.$email.'</a></p>
        <br>
        <p>The link will expire after 1 day.</p>
        <p>If you did not request this forgotten password email, no action 
        is needed.</p>';

        $headers = "From: no-reply@applicationTrackingSystem.com" . "\r\n";
        $to = $email;
        $subject = "Password Reset Request";

        // Set headers for HTML email
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // Send email
        $mailSuccess = mail($to, $subject, $message, $headers);


        // echo out a page
        echo "  <div class='container-fluid'>
                        <div class='row col-12'>
                            <header>
                                <h1>Email sent!</h1>
                            </header>
                        </div>
                        <div class='row justify-content-center'>
                            <div class='form-container pt-0 col-lg-6 col-md-8 col-sm-12 col-12'>
                                <h1 class='pt-5 header-text text-center'>Reset Link Sent</h1>
                                <div class='form-response'>
                                    <p>A password reset link has been sent.</p>
                                    <p>Please check your email.</p>
                                    <p>It may take a few minutes, but if you don't see it within 30 minutes please resubmit below.</p>
                                </div>
                            </div>
                        </div>
                    </div>
            ";
    }
}

?>

<!-- the form content for submitting a request to reset password -->

<div class='container-fluid'>
    <div class='row col-12'>
        <header>
            <h1>Password Reset</h1>
        </header>
    </div>
    <div class='row justify-content-center'>
        <form class = "form-container pt-0 col-lg-6 col-md-8 col-sm-12 col-12" method="post" action="password-email.php" name="reset">
            <br>
            <section class = "form-group">
            <label for = "email">Enter Your Email Address:</label>
            <br>
            <input type="email" class = "form-control" id = "email" name="email" placeholder="username@email.com">
            </section>

            <section class = "form-group">
                <input id="submit-button" type="submit" class="btn btn-primary" value="Reset Password">
            </section>
        </form>
    </div>
</div>


