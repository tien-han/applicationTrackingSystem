/*
    This page holds JavaScript code that pulls application information and populates the applications table
    for both users and admins.

    Author: Colton Matthews, Gene Faison, Tien Han
    File: get-applications.js
    Date: 3/7/2024
*/

//Make the applications table into a datatable & set parameters
$(document).ready(function () {
    $("#applications-table").DataTable({
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 75, 100, { label: "All", value: - 1 }],
        paging: true,
        scrollY: "560px",
        searching: true,
        columns: [
            null,
            null,
            null
        ],
        "language": {
            "search": "Search: ",
            "infoEmpty": "No matching records found"
        },
        columnDefs: [
            // Center align header content of columns 1, 2, 3
            { className: "dt-head-center", targets: [0, 1, 2] },
            // Center align body content of columns 1, 2, 3
            { className: "dt-body-center", targets: [0, 1, 2] },
        ],
        autoWidth: false,
    });

    getApplications();
});

$(window).on('resize', function () {
    $("#applications-table").DataTable().columns.adjust().draw();
});

async function getApplications() {
    await fetch("/blobbieblob/data-processing/get-recent-applications.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Something went wrong while trying to get all applications.");
            }
            return response.json();
        })
        .then(data => {
            updateApplicationsTable(data);
        })
        .catch((error) => {
            console.error('Error loading recent applications:', error);
        });
}

//This method updates the applications table with all the applications
function updateApplicationsTable(applications) {
    let applicationsTable = $("#applications-table").DataTable();

    applications.forEach(application => {
        const applicationDate = new Date(application.application_date).toISOString().split('T')[0];

        //Create and add a row for the application
        const rowData = applicationsTable.row.add([
            applicationDate,
            application.role_name,
            application.status,
        ]).draw(false).node();
    })

    //Create filtering for the applications table
    $("#applications-table-header tr:eq(0) td").not(":eq(3),:eq(4)").each(function (i) {
        //Create selects for each column (besides the View and Delete columns)
        //And enable search/filter based on what's selected
        var select = $('<select><option value=""></option></select>')
            .appendTo($(this).empty())
            .on('change', function () {
                var term = $(this).val();
                applicationsTable.column(i).search(term, false, false).draw();
            });

        //Apply values from the table into the select button
        applicationsTable.column(i).data().unique().sort().each(function (d, j) {
            select.append('<option value="' + d + '">' + d + '</option>')
        });

        //Stop select triggering sort
        $("#applications-table-header tr:eq(0) td").click(function (e) {
            e.stopPropagation();
        });
    });

    applicationsTable.columns.adjust().draw();
}