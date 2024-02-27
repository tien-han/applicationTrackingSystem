<?php
    //This function handles inserting new users into our db
    function insertNewUsers($VALUES) {
        //Get and clean form responses
        $name = clean_form_responses($VALUES["name"]);
        $email = clean_form_responses($VALUES["email"]);
        $cohortNum = clean_form_responses($VALUES["cohortNumber"]);
        $seekingPosition = clean_form_responses($VALUES["seekingInternship"]);
        $roles = clean_form_responses($VALUES["seekingRoles"]);

        //Get DB Connection credentials
        require '/home/cicadagr/atsdb.php';

        //Calculate the timestamp for when the user is created
        $date = date('Y-m-d H:i:s', time());

        //SQL Query to insert new user into db
        $userSQL = "
            INSERT INTO users (
                name,
                email,
                cohort,
                status,
                roles,
                created_at
            ) VALUES (
                '$name',
                '$email',
                '$cohortNum',
                '$seekingPosition',
                '$roles',
                '$date'
            )
        ";

        //Insert new user into database
        mysqli_query($cnxn, $userSQL);
    }

    //Clean up form responses to prevent security issues
    function clean_form_responses($data) {
        return trim(stripslashes(htmlspecialchars($data)));
    }
?>