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
            null,
            { orderable: false },
            { orderable: false }
        ],
        "language": {
            "search": "Search: ",
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
//Note: The given path is relative to home, not where the file is
async function getUsers() {
    await fetch("/YOLO/data-processing/select-all-users.php")
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

    users.forEach(user => {
        //Get the user role and format it for visibility
        let roles = user.roles.join(", ");

        //Create and add a row for the user
        const rowData = userTable.row.add([
            user.name,
            user.email,
            roles,
            "<button type='button' class='btn btn-success'>View</button>",
            "<td><button type='button' class='btn btn-danger'>Delete</button></td>",
        ]).draw(false).node(); //Don't redraw the table (i.e. reset the sort/search)

        //Set the row's id
        $(rowData).attr("id", user.userId);
    });

    //Create filtering for the user table
    $("#users-table-header tr:eq(0) td").not(":eq(3),:eq(4)").each(function (i) {
        //Create selects for each column (besides the View and Delete columns)
        //And enable search/filter based on what's selected
        var select = $('<select><option value=""></option></select>')
            .appendTo($(this).empty())
            .on('change', function () {
                var term = $(this).val();
                userTable.column(i).search(term, false, false).draw();
            });

        //Apply values from the table into the select button
        userTable.column(i).data().unique().sort().each(function (d, j) {
            select.append('<option value="' + d + '">' + d + '</option>')
        });

        //Stop select triggering sort
        $("#users-table-header tr:eq(0) td").click(function (e) {
            e.stopPropagation();
        });
    });
}