<?php
    /** This file will pull the user data from a certain email.
     * Names: Tien, Colton, Sage, Eugene
     * Date: 3/15/2024
    */
    //Get DB Connection credentials
    require '/home/cicadagr/atsdb.php';

    // the username must be named email or it will conflict with cnxn file variable
    $email = $_POST["username"];
    $password = $_POST["password"];

    //Get the user from the database, using the email/username
    $userSQLquery = "SELECT * FROM users WHERE email = '$email'";
    $userResult = @mysqli_query($cnxn, $userSQLquery);

    $row = mysqli_fetch_assoc($userResult);

    //Assign values to variables to place in fields initially
    $name = $row['name'];
    $email = $row['email'];
    $cohort = $row['cohort'];
    $status = $row['status'];
    $passwordDB = $row['password'];
    $userId = $row['userId'];

    // Get all the roles for the user from the database, using the user's id
    // This is inside the while loop on purpose
    $userRolesQuery = "SELECT role_name
                        FROM roles
                        INNER JOIN user_roles ON roles.roleId=user_roles.roleId
                        WHERE user_roles.userId = '$userId'";
    $userRolesResult = @mysqli_query($cnxn, $userRolesQuery);
    $userRolesResult = mysqli_fetch_all($userRolesResult, MYSQLI_ASSOC);

    // Create an array of all the user's permissions
    //$permissions is an array of all the permissions for the user
    //Example: Array([0] => Admin [1] => User)
    $permissions = [];

    foreach ($userRolesResult as $userRole) {
        //$userRole is a single array with index "role_name"
        //$permission represents the user ats role itself, i.e. "Admin" or "User"
        $permission = $userRole["role_name"];
        array_push($permissions, $permission);
    };
?>