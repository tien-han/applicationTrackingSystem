window.addEventListener("load", function (event) {
    getFollowUps();
})

async function getFollowUps() {
    await fetch("/YOLO/data-processing/get-recent-applications.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Something went wrong while trying to get all applications.");
            }
            return response.json();
        })
        .then(data => {
            const reminders = document.getElementById('reminders');
            if (!reminders) {
                console.error('Reminders area not found');
                return;
            }
            data.forEach(application => {
                const row = document.createElement('p');

                <!-- we'll change the format of the dates so it doesn't display the h/m/s-->
                let follow_up_date = new Date(application.follow_up_date);
                let formattedDate = follow_up_date.toISOString().split('T')[0];

                row.innerHTML = `
                   
                        <!-- The following form method assigns the Id and allows us to direct to
                        the correct form for updating/viewing so the user can follow up or say they did -->
                        <form method="POST" action="../form-responses/edit-app-form.php">
                            <input type = "hidden" name = "applicationId" value = "${application.applicationsId}">
                            <p>Follow up with ${application.employer_name} by ${formattedDate}</p>
                            <button type = "submit" class = "btn">View</button>
                        </form>
                   `;
                reminders.appendChild(row);
            });
        })
        .catch((error) => {
            console.error('Error loading recent applications:', error);
        });
}
