<?php
// TODO: If values are empty, default to what's in the database if req
$sql = "INSERT INTO applications (
                          application_date,
                          contact_email,
                          contact_name,
                          contact_phone,
                          employer_name,
                          follow_up_date,
                          job_description,
                          notes,
                          status
) VALUES (
          $RoleName,
          $jobDesc,
          $currentDateInput,
          $followUpDateDisplay,
          $employerName,
          $appStatus,
          $contactName,
          $contactEmail,
          $contactPhone,
          $notes 
)";
$result = @mysqli_query($cnxn, $sql);

// insert the new fields into the database