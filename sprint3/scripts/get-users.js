/*
    This page holds JavaScript code that pulls user information from "select-all-users.php"
    and populates the admin dashboard's users table.

    Author: Tien Han
    File: get-users.js
    Date: 2/15/2024
*/

//When the dom elements complete loading, populate the users table with users
window.addEventListener("load", function (event) {
    getUsers();
})

//Make the users table into a datatable & set parameters
$(document).ready(function () {
    $("#users-table").DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 75, 100, { label: "All", value: - 1 }],
        paging: true,
        scrollY: "560px",
        searching: true,
        columns: [
            null,
            null,
            { orderable: false },
            { orderable: false }
        ],
        "language": {
            "search": "Name/Email Search:",
            "infoEmpty": "No matching records found"
        },
        columnDefs: [
            // Center align both header and body content of columns 1, 2 & 3
            { className: "dt-center", targets: [0, 1, 2, 3] },
        ],
        autoWidth: false,
    });
});

$(window).on('resize', function () {
    $("#users-table").DataTable().columns.adjust().draw();
});

//This method gets all users with fetch() and kicks off "updateUsersTable()" to populate the users table
async function getUsers() {
    await fetch("https://cicada.greenriverdev.com/sprint3/data-processing/select-all-users.php")
        .then((response) => {
            if (!response.ok) {
                throw new Error("Something went wrong while trying to get all users.");
            }
            return response.text();
        })
        .then((data) => {
            const searchRegex = /\[.*\]/;

            //Get the SQL result for all users
            const filter = data.match(searchRegex);

            //Convert the JSON users string to an array with objects for us to use
            let users = JSON.parse(filter);

            updateUsersTable(users);
        })
        .catch((error) => {
            console.log("Catching errors!", error);
        });
}

//This method updates the users table with all the users
function updateUsersTable(users) {
    let userTable = $("#users-table").DataTable();

    let rowNode = users.forEach(user => {
        //Create and add a row for the user
        let rowNode = userTable.row.add([
            user.name,
            user.email,
            "<button type='button' class='btn btn-success'>View</button>",
            "<td><button type='button' class='btn btn-danger'>Delete</button></td>",
        ]).draw(false).node(); //Don't redraw the table (i.e. reset the sort/search)

        //Set the row's id
        $(rowNode).attr("id", user.userId);
    })
}