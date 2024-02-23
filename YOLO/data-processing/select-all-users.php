<?php
    //This function handles selecting all users from the database
    function selectAllUsers() {
        //Get DB Connection credentials
        require '/home/cicadagr/atsdb.php';

        //SQL query for getting all users out of the database
        $usersSQL = "SELECT userId, name, email FROM users";

        //Run SQL query to get all users
        $usersResult = mysqli_query($cnxn, $usersSQL);

        //Create an empty array to hold all the users
        $users = array();
        
        //Loop through all the results and add them to the array
        while ($row = mysqli_fetch_assoc($usersResult)) {
            array_push($users, $row);
        }
        $usersJSON = json_encode($users);

        echo $usersJSON;
    }

    selectAllUsers();
?>