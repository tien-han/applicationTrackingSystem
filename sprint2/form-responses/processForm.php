<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $title = $_POST['title'];
    $jobType = $_POST['job_type'];
    $location = $_POST['location'];
    $employer = $_POST['employer'];
    $moreInfo = $_POST['more_info'];
    $url = $_POST['url'];
    $email = $_POST['email'];

    // Add your own email address where you want to receive the messages
    $to = 'faison.eugene@student.greenriver.edu';

    // Create email message
    $subject = "New Admin Announcement: $title";
    $message = "
        <html>
        <head>
            <title>New Admin Announcement</title>
        </head>
        <body>
            <h2>Admin Announcement Details:</h2>
            <p><strong>Title:</strong> $title</p>
            <p><strong>Job or Internship:</strong> $jobType</p>
            <p><strong>Location:</strong> $location</p>
            <p><strong>Employer:</strong> $employer</p>
            <p><strong>More Information:</strong> $moreInfo</p>
            <p><strong>URL:</strong> $url</p>
        </body>
        </html>
    ";

    // Set headers for HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Send email
    mail($email, $subject, $message, $headers);

    // Display confirmation page
    echo "<html><head><title>Form Submitted</title></head><body>";
    echo "<h2>Form Submitted Successfully!</h2>";
    echo "<p>Details have been sent to $email</p>";
    echo "</body></html>";
} else {
    // Redirect if form is not submitted
    header("Location: adminAnnouncement.html");
}
?>
