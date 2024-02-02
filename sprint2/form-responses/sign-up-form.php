<html lang="en" data-bs-theme="light">
<!-- Nav Bar -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link rel="stylesheet" href="../css/styles.css">
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
                <a class="nav-link" href="../pages/new-app.html">New Application</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="../pages/sign-up.html">Sign Up</a>
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

<?php
// TODO: validate information is entered before showing receipt

if (isset($_POST['email']) && $_POST['email'] != '' &&
    isset($_POST['name']) && $_POST['name'] != '' &&
    isset($_POST['cohortNumber']) && $_POST['cohortNumber'] != '')
{
        echo "<div class = 'row justify-content-center'>
        <div class='form-container pt-0 col-lg-4'>         
        <h1 class='pt-5 header-text m-auto'>Thanks for signing up, " . $_POST['name']. "!</h1>
        <h5>The details you entered are: </h5>
        <p>Email: " . $_POST['email'] . " </p>
        <p>Cohort Number: " . $_POST['cohortNumber'] . "</p>
        <p>Status: " . $_POST['seekingInternship'] . "</p>
        <p>Looking for: " . $_POST['seekingRoles'] . "</p>
        </div>
        </div>";
} else {
    // show error message if page is navigated to without form submission
    echo "<div class='form-container pt-0'>
            <div class = 'row justify-content-center'>
            <div class='form-container pt-0 col-lg-4 col-md-8 col-sm-10 col-12'>
            <h1 class='pt-5 header-text m-auto'>Error!</h1>
            <br>
            <p>Please return to the sign up form page and fill it out.</p>
            <p>We can't create an account for you with no information! </p>
            </div>
            </div>
            </div>";
    // TODO: MAKE THIS A PRETTIER ERROR MESSAGE
    include("..\pages\sign-up.html");
}
    ?>

</body>
</html>
