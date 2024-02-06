
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link rel="stylesheet" href="../css/styles.css">

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
                        <a class="nav-link" href="../pages/admin-announcement.html">Admin Announcment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/new-app.html">New Application</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/sign-up.html">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="../pages/contact.html">Contact</a>
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
        <!--Form Handling for Contact Form-->
        <?php

        // TODO: CHANGE EMAIL TO TYLER'S ONCE TESTING IS DONE

        // check email fields are filled before sending email or showing receipt
        if (isset($_POST['message']) && $_POST['message'] != '' &&
            isset($_POST['name']) && $_POST['name'] != '' &&
            isset($_POST['email']) && $_POST['email'] != ''){
            // Collect form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            $headers = "From: $name" . "\r\n Reply-to: $email";
            $to = 'markwardt.sage@student.greenriver.edu';

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
            echo "<div class='form-container pt-0'>
            <div class = 'row justify-content-center'>
            <div class='form-container pt-0 col-lg-4 col-md-8 col-sm-12 col-12'>

            <h1 class='pt-5 header-text'>A response will be sent soon, thank you!</h1>
            <h5>Here's what you just entered:</h5><br/>
            <p>The name you added was: " . $name . ".</p>
            <p>The subject of your message was: " . $subject . "</p>
            <p>The email you added was: " . $email . ".</p>
            <p>The message you added was: " . $message . ".</p>
            </div>
            </div>
            </div>";
        } else {
            // tell the user to go to the contact form and fill it out
            echo "<div class='pt-0'>
            <div class = 'row justify-content-center'>
            <div class='form-container pt-0 col-lg-4 col-md-8 col-sm-12 col-12'>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="../scripts/script.js"></script>
    </body>
</html>
