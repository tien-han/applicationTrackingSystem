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
                ?,
                ?,
                ?,
                ?,
                ?,
                ?
            )
        ";

        //Prepare the SQL query for execution
        $userSQLToRun = mysqli_prepare($cnxn, $userSQL);
        $userId = 0;

        if ($userSQLToRun) {
            mysqli_stmt_bind_param($userSQLToRun, 'ssssss', $name, $email, $cohortNum, $seekingPosition, $roles, $date);

            if (!mysqli_stmt_execute($userSQLToRun)) {
                echo "Error: " . mysqli_error($cnxn);
            }

            //Get the new userId that has just been created
            $userId = mysqli_insert_id($cnxn);

            mysqli_stmt_close($userSQLToRun);
        } else {
            echo "Error preparing statement: " . mysqli_error($cnxn);
        }

        //Identify the new user as a non-admin user and save them to the "user_roles" table
        $userRolesSQL = "
            INSERT INTO user_roles (
                userId, roleId, created_at
            ) VALUES (
                ?, ?, ?
            )
        ";

        $userRoleSQLToRun = mysqli_prepare($cnxn, $userRolesSQL);

        if ($userRoleSQLToRun) {
            //1 is Admin, 2 is User; all new sign-ups default to 2 User
            $roleId = 2;

            mysqli_stmt_bind_param($userRoleSQLToRun, 'sss', $userId, $roleId, $date);

            if (!mysqli_stmt_execute($userRoleSQLToRun)) {
                echo "Error: " . mysqli_error($cnxn);
            }

            mysqli_stmt_close($userRoleSQLToRun);
        } else {
            echo "Error preparing statement: " . mysqli_error($cnxn);
        }
    }

    //Clean up form responses to prevent security issues
    function clean_form_responses($data) {
        return trim(stripslashes(htmlspecialchars($data)));
    }
?>