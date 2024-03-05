/*This file contains scripts to get announcements
* made in the last five days for the student homepage.
*
* Author: Sage Markwardt
* Date last touched: 3/4/2024
* File: get-announcements-students.js
* */window.addEventListener("load", function (event) {
    getAnnouncementsStudents();
})

async function getAnnouncementsStudents() {
    // first grab the date range +-5
    let today = new Date();
    let lastFiveDays = new Date(today);
    lastFiveDays.setDate(today.getDate() - 5)

    // grab our data and create our rows
    await fetch("/YOLO/data-processing/get-recent-announcements.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Something went wrong while trying to get announcements.");
            }
            return response.json();
        })
        .then(data => {
            const announcement = document.getElementById('announcements');
            if (!announcement) {
                console.error('Announcements not found in HTML');
                return;
            }
            data.forEach(announcements => {
                let announcement_date = new Date(announcements.date);
                // we shouldn't need to check anything else since we have no feature for future announcements
                if (lastFiveDays <= announcement_date &&
                    announcement_date) {
                    const row = document.createElement('p');

                    // we'll change the format of the dates so it doesn't display the h/m/s
                    let formattedDate = announcement_date.toISOString().split('T')[0];

                    row.innerHTML = `
                       
                            <a href="/YOLO/data-processing/detailsPage.php?id=${announcements.announcementId}" class="announcement-title"><i class="fa-solid fa-bullhorn"></i>
                                ${announcements.title}</a>
                                <p class = "dated">Posted: ${formattedDate}</p>
                       `;
                    announcement.appendChild(row);
                }

            });
        })
        .catch((error) => {
            console.error('Error loading announcements:', error);
        });
}
