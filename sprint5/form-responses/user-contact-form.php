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
            window.location.replace("/sprint5/pages/admin-admin-dashboard.html");
        } else if (permissions == "User") {
            //We don't actually want to do anything, but if we provide this then we can have a catch-all else statement
        } else if (permissions == "admin-user") {
            window.location.replace("/sprint5/pages/user-dashboard.html");
        } else {
            window.location.replace("/sprint5/index.html");
        }
    </script>
    <title>Contact Form</title>
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
                        <a class="nav-link" href="../pages/user-user-dashboard.html">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/user-new-application.html">Add New Application</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../pages/user-contact.html">Contact Admin</a>
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
        <!--Form Handling for Contact Form-->
        <?php

        // check email fields are filled before sending email or showing receipt
        if (isset($_POST['message']) && $_POST['message'] != '' &&
            isset($_POST['name']) && $_POST['name'] != '' &&
            isset($_POST['email']) && $_POST['email'] != ''){
            // Collect form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $headers = "From: $name" . "\r\n Reply-to: $email";
            $to = 'tschrock@greenriver.edu';

            // Create email message
            // Use subject field if filled out - otherwise use generic title
            if (isset($_POST['subject']) && $_POST['subject'] != '') {
                $subject = $_POST['subject'];
            } else {
                // default subject with customer name
                $subject = "No subject - $name Contact Form";
            };
            $msg = "
                <html>
                    <head>
                        <h1>$subject</h1>
                    </head>
                    <body>
                        <h5>A new contact request has been sent from $name:</h5><br/>
                        <p>Please reply to this address: " . $email . ".</p>
                        <p>The new message says: </p>
                        <p>" . $message . "</p>
                    </body>
                </html>";

            // Set headers for HTML email
            $headers .= "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // Send email
            $mailSuccess = mail($to, $subject, $message, $headers);


            // print out the receipt
            echo "
                <div class='container-fluid'>
                    <div class='row col-12'>
                        <header>
                            <h1>Contact Us Form Completed</h1>
                        </header>
                    </div>

                    <div class='row justify-content-center'>
                        <div class='form-container pt-0 col-lg-6 col-md-8 col-sm-12 col-12'>
                            <h1 class='pt-5 header-text text-center'>Thanks for contacting us " . $name . ", you'll receive an email response soon!</h1>
                            <div class='form-response'>
                                <p>The details you entered are:</p>
                                <p><b>Name</b>: " . $name . "</p>
                                <p><b>Subject</b>: " . $subject . "</p>
                                <p><b>Email</b>: " . $email . "</p>
                                <p><b>Message</b>: " . $message . "</p>
                            </div>
                        </div>
                    </div>
                </div>
            ";
        } else {
            // tell the user to go to the contact form and fill it out
            echo "<div class='pt-0'>
            <div class = 'row justify-content-center'>
            <div class='form-container pt-0 col-lg-6 col-md-8 col-sm-12 col-12'>
            <h1 class='pt-5 header-text m-auto'>Please fill out the form below!</h1>
            <br>
            <p>An email will not be sent until there is content.</p>
            </div>
            ";

            // include form to fill out
            include("includes-contact.php");
            // close remaining divs
            echo "</div>
               </div>";
        }
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
