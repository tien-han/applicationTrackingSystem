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
            const tableBody = document.getElementById('applicationsTableBody');
            if (!tableBody) {
                console.error('Table body not found');
                return;
            }
            data.forEach(application => {
                const row = document.createElement('tr');
                row.innerHTML = `
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
                    <td><button type="button" class="btn btn-danger">Delete</button></td>
            `;
                tableBody.appendChild(row);
            });
        })
        .catch((error) => {
            console.error('Error loading recent applications:', error);
        });
}
