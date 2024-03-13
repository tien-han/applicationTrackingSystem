<?php
/** This file will pull the user data from a certain email.
 * Names: Tien, Colton, Sage, Eugene
 * Date: 3/13/2024
*/
//Get DB Connection credentials
require '/home/cicadagr/atsdb.php';

// the username must be named email or it will conflict with cnxn file variable
$email = $_POST["username"];
$password = $_POST["password"];

//Get the user from the database, using the email/username
$userSQLquery = "SELECT * FROM users WHERE email = '$email'";
$userResult = @mysqli_query($cnxn, $userSQLquery);

//Assign values to variables to place in fields initially
while ($row = mysqli_fetch_assoc($userResult))
{
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
    //Get an array of all user permissions
    $userRolesResult = mysqli_fetch_all($userRolesResult, MYSQLI_ASSOC);
    $permissions = $userRolesResult;
}
?>