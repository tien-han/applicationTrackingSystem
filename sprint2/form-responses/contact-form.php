<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-md fixed-top navbar-dark" role="navigation">
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
                        <a class="nav-link" href="new-app.html">New Application</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="sign-up.html">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="contact.html">Contact</a>
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
            if (isset($_POST["contact-form"])) {
                echo "<div class='form-container pt-0'>
                    <h1 class='pt-5 header-text'>Great job adding a new contact!</h1>
                    <h4>Here's what you just entered:</h4><br/>
                    <p>The name you added was: " . $_POST["name"] . ".</p>
                    <p>The email you added was: " . $_POST["email"] . ".</p>
                    <p>The message you added was: " . $_POST["message"] . ".</p>
                </div>";
            }
        ?>
    
        <!--Scripts-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
        <script src="../scripts/script.js"></script>

    </body>
</html>