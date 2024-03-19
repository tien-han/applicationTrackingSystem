<!--This page shows the reflected Annoucement in detail when the title is clicked.
    Author: Colton Matthews
    File: admin-announcement-details-page.php
    Last changed: 3/4/2024
    -->

    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Application Form</title>
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
                    <a class="nav-link active" href="../pages/new-app.html">Add New Application</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/sign-up.html">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/contact.html">Contact</a>
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

    <?php
        require '/home/cicadagr/atsdb.php';
        $announcementId = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($announcementId > 0) {
            $sql = "SELECT * FROM announcements WHERE announcementId = ?";
            $stmt = mysqli_prepare($cnxn, $sql);
            mysqli_stmt_bind_param($stmt, "i", $announcementId);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                echo "<html><head><title>Submission Details</title></head><body>";
                echo " <div class='container-fluid'>
                            <div class='row col-12'>
                                <header>
                                    <h1>Announcement " . htmlspecialchars($row['title']) . " </h1>
                                </header>
                            </div>
                            <div class='row justify-content-center'>
                                <div class='form-container pt-0 col-lg-6 col-md-8 col-sm-12 col-12'>
                                    <h1 class='pt-5 header-text text-center'>The Details are as Follows:</h1>
                                    <div class='form-response'>
                                        <p><b>Title</b>: " . htmlspecialchars($row['title']) . "</p>
                                        <p><b>Job Type</b>: " . htmlspecialchars($row['job_type']) . "</p>
                                        <p><b>Location</b>: " . htmlspecialchars($row['location']) . "</p>
                                        <p><b>Email</b>: " . htmlspecialchars($row['email']) . "</p>
                                        <p><b>Message</b>: " . htmlspecialchars($row['more_info']) . "</p>
                                        <p><b>Employer</b>: " . htmlspecialchars($row['employer']) . "</p>
                                        <p><b>URL</b>: " . htmlspecialchars($row['url']) . "</p>
                                    </div>
                                </div>
                            </div>
                        </div>";
                echo "</body></html>";
            } else {
                // Announcement not found
                echo "Announcement not found.";
            }
        } else {
            // Invalid announcement ID
            echo "Invalid announcement ID.";
        }
        mysqli_close($cnxn);
    ?>
    <!--Scripts-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    <!-- Form validation and dark mode script -->
    <script type="text/javascript" src="../scripts/script.js"></script>
</body>
</html>