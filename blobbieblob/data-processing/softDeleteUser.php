<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Announcement Form</title>
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
                <a class="nav-link" href="../pages/user-dashboard.html">Student Home</a>
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








<?php
// soft_delete.php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require '/home/cicadagr/atsdb.php';




// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST["userId"];
    //echo $applicationId . "</br>";

    // Validate and sanitize the input
    $userId = filter_var($userId, FILTER_SANITIZE_NUMBER_INT);

    // Check if the application ID is valid
    if ($userId !== null) {
        // Perform the soft delete operation
        $sql = "UPDATE users SET user_deleted = 1 WHERE userId = " . $userId;
        $result = mysqli_query($cnxn, $sql);

        // Bind parameters and execute the query
        if ($result) {
            // Soft delete successful
            json_encode(['success' => true, 'message' => 'User deleted successfully']);
        } else {
            // Soft delete failed
            echo json_encode(['success' => false, 'message' => 'Failed to delete user']);
        }
    } else {
        // Invalid application ID
        echo json_encode(['success' => false, 'message' => 'Invalid user ID']);
        echo json_encode($userId);
    }


    echo "<div class='form-container pt-0'>
        <div class = 'row justify-content-center'>
        <div class='form-container pt-0 col-lg-6 col-md-8 col-sm-12 col-12'>

        <h1 class='pt-5 header-text'></h1>
        <h5>Successfully deleted user with the ID of: " . $userId . ".</h5><br/>
       
        </div>
        </div>
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
