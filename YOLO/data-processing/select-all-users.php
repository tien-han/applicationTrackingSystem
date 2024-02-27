<?php
    // PHP class that holds user information needed for the Users table
    class User {
        /** User Id
        * @var int
        */
        public int $userId;

        /** Name
        * @var string
        */
        public string $name;

        /** Email
        * @var string
        */
        public string $email;

        /** Role
        * @var array
        */
        public array $roles;

        public function __construct(int $userId, string $name, string $email, array $roles) {
            $this->userId = $userId;
            $this->name = $name;
            $this->email = $email;
            $this->roles = $roles;
        }
    }

    //This function handles selecting all users from the database
    function selectAllUsers() {
        //Get DB Connection credentials
        require '/home/cicadagr/atsdb.php';

        //SQL query for getting all users out of the database
        $usersSQL = "SELECT userId, name, email FROM users";
        //Run SQL query to get all users
        $usersResult = mysqli_query($cnxn, $usersSQL);

        //SQL to get all roles out of the database
        $rolesSQL = "SELECT roleId, role_name FROM roles";
        $rolesResult = mysqli_query($cnxn, $rolesSQL);
        //Get an array of all roles
        $rolesResult = mysqli_fetch_all($rolesResult, MYSQLI_ASSOC);
        
        //SQL to get all the user roles out of the database
        $userRolesSQL = "SELECT userId, roleId FROM user_roles";
        $userRolesResult = mysqli_query($cnxn, $userRolesSQL);
        //Get an array of all user roles
        $userRolesResult = mysqli_fetch_all($userRolesResult, MYSQLI_ASSOC);

        //Create an empty array to hold all the users
        $users = array();
        
        //Loop through all the results and add them to the array
        while ($row = mysqli_fetch_assoc($usersResult)) {
            $userId = $row['userId'];
            
            //Build the array of user roles ids
            $userRoleIds = [];

            //Look at all set user roles and save them to our $uesrRoleIds list if the userId
            //matches the current user we're looking at
            foreach ($userRolesResult as $role) {
                $roleUserId = $role['userId'];
                $roleId = $role['roleId'];

                if ($userId == $roleUserId) {
                    array_push($userRoleIds, $roleId);
                }
            }

            //Look through all the assigned user role id's and convert them to text user roles for the front end
            $userRoles = [];
            foreach ($userRoleIds as $assignedRoleId) {
                if ($assignedRoleId == 1) {
                    array_push($userRoles, $rolesResult[0]['role_name']);
                } else if ($assignedRoleId == 2) {
                    array_push($userRoles, $rolesResult[1]['role_name']);
                }
            };

            //Build out user object to return to the front end
            $user = new User($userId, $row['name'], $row['email'], $userRoles);

            array_push($users, $user);
        }
        echo json_encode($users);
    }

    selectAllUsers();
?>