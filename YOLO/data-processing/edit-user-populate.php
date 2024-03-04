<?php
    //Get DB Connection credentials
    require '/home/cicadagr/atsdb.php';

    $userId = $_POST['userId'];

    //Get the user from the database, using the user's id
    $userSQLquery = "SELECT * FROM users WHERE userId = '$userId'";
    $userResult = @mysqli_query($cnxn, $userSQLquery);

    //Get all the roles for the user from the database, using the user's id
    $userRolesQuery = "SELECT role_name
                        FROM roles
                        INNER JOIN user_roles ON roles.roleId=user_roles.roleId
                        WHERE user_roles.userId = '$userId'";
    $userRolesResult = @mysqli_query($cnxn, $userRolesQuery);
    //Get an array of all user permissions
    $userRolesResult = mysqli_fetch_all($userRolesResult, MYSQLI_ASSOC);

    //Assign values to variables to place in fields initially
    while ($row = mysqli_fetch_assoc($userResult))
    {
        $name = $row['name'];
        $email = $row['email'];
        $cohort = $row['cohort'];
        $status = $row['status'];
        $roles = $row['roles'];
        $permissions = $userRolesResult;
    }
?>

