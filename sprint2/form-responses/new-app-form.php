<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $roleName = $_POST['RoleName'];
    $jobDesc = $_POST['Jobdesc'];
    $employerName = $_POST['employerName'];
    $contactName = $_POST['ContactName'] ;
    $contactEmail = $_POST['ContactEmail'];
    $contactPhone = $_POST['ContactPhone'] ;
    $interviewNotes = $_POST['InterviewNotes'];
    $applicationStatus = $_POST['Appliedposition'];


    $to = 'Matthews.Colton@student.greenriver.edu';


    // Create email message
    $subject = "New Application Submission: $roleName";
    $message = "
        <html>
        <head>
            <title>New Application Submission</title>
        </head>
        <body>
            <h2>Application Details:</h2>
            <p><strong>Role Name:</strong> $roleName</p>
            <p><strong>Job Description:</strong> $jobDesc</p>
            <p><strong>Employer Name:</strong> $employerName</p>
            <p><strong>Contact Name:</strong> $contactName</p>
            <p><strong>Contact Email:</strong> $contactEmail</p>
            <p><strong>Contact Phone:</strong> $contactPhone</p>
            <p><strong>Interview Notes:</strong> $interviewNotes</p>
            <p><strong>Application Status:</strong> $applicationStatus</p>
        </body>
        </html>
    ";


    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


    $headers .= "From: Matthews.Colton@student.greenriver.edu" . "\r\n";

    // Attempt to send the email
    if (mail($to, $subject, $message, $headers)) {
        echo "<html><head><title>Submission Successful</title></head><body>";
        echo "<h2>Application Submitted Successfully!</h2>";
        echo "<p>Thank you for submitting your application.</p>";
        echo "</body></html>";
    } else {
        echo "<html><head><title>Error</title></head><body>";
        echo "<h2>There was an error submitting your application.</h2>";
        echo "<p>Please try again later.</p>";
        echo "</body></html>";
    }
} else {

    header("Location:new-app.html");
}
?>
