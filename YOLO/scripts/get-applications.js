window.addEventListener("load", function (event) {
    getApplications();
})

async function getApplications() {
    await fetch("/YOLO/data-processing/get-recent-applications.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Something went wrong while trying to get all applications.");
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            const tableBody = document.getElementById('applicationsTableBody');
            if (!tableBody) {
                console.error('Table body not found');
                return;
            }

            console.log("Attempting to create row's for each application");

            data.forEach(application => {
                const row = document.createElement('tr');
                console.log(row);
                row.innerHTML =
                    `
                        <td>${application.application_date}</td>
                        <td>${application.role_name}</td>
                        <td>${application.status}</td>
                        <!-- The following form method assigns the Id and allows us to direct to
                            the correct form for updating -->
                        <td>
                            <form method="POST" action="../form-responses/edit-app-form.php">
                                <input type="hidden" name="applicationId" value="${application.applicationsId}">
                                <button type="submit" class="btn btn-success">Update</button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="../data-processing/softDelete.php">
                                <input type="hidden" name="applicationId" value="${application.applicationsId}">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    `;
                tableBody.appendChild(row);
            });

            console.log("Trying to add event listeners to delete buttons");
            // Add event listeners for delete buttons
            const deleteButtons = document.querySelectorAll('.btn-danger');
            deleteButtons.forEach(button => {
                button.addEventListener('click', deleteButtons);
            });
            console.log("After adding event listeners to delete buttons");
        })
        .catch((error) => {
            console.error('Error loading recent applications:', error);
        });
}
