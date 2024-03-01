/*This file contains scripts to get announcements
* made in the last five days.
*
* Author: Sage Markwardt
* Date last touched: 2/28/2024
* File: get-announcements.js
* */window.addEventListener("load", function (event) {
    getAnnouncements();
})

async function getAnnouncements() {
    // first grab the date range +-5
    let today = new Date();
    let fiveDaysAhead = new Date(today);
    fiveDaysAhead.setDate(today.getDate() + 5);
    let fiveDaysLate = new Date(today);
    fiveDaysLate.setDate(today.getDate() - 5)

    // grab our data and create our rows
    await fetch("/YOLO/data-processing/get-recent-announcements.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Something went wrong while trying to get announcements.");
            }
            return response.json();
        })
        .then(data => {
            const reminders = document.getElementById('reminders');
            if (!reminders) {
                console.error('Announcements not found in HTML');
                return;
            }
            data.forEach(announcements => {
                let announcement_date = new Date(announcements.date);
                // compare the incoming dates to today to get ones within our range
                if (fiveDaysLate <= announcement_date
                    && announcement_date <= fiveDaysAhead) {
                    const row = document.createElement('p');

                    // we'll change the format of the dates so it doesn't display the h/m/s
                    let formattedDate = announcement_date.toISOString().split('T')[0];

                    row.innerHTML = `
                       
                            <!-- The following form method assigns the Id and allows us to direct to
                            the correct form for updating/viewing so the user can follow up or say they did -->
                            <div class="border border-success rounded mb-4 p-2 overflow-auto">
                                <div>
                                    <form method="POST" action="../form-responses/edit-app-form.php">
                                        <input type = "hidden" name = "announcementId" value = "${announcements.announcementsId}">
                                        <p>Announcement: ${announcements.title} posted on ${formattedDate}</p>
                                        <button type = "submit" class = "btn">View</button>
                                    </form>
                                </div>
                            </div>
                       `;
                    reminders.appendChild(row);
                }
            });
        })
        .catch((error) => {
            console.error('Error loading follow ups:', error);
        });
}
