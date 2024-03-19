document.addEventListener("DOMContentLoaded", function () {
    fetchAnnouncements();
});

async function fetchAnnouncements() {
    await fetch("/blobbieblob/data-processing/get-recent-announcements.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Something went wrong while trying to get all announcements.");
            }
            return response.json();
        })
        .then(data => {
            const announcementsDiv = document.getElementById('announcementsDiv');
            if (!announcementsDiv) {
                console.error('Announcements div not found');
                return;
            }
            // Check for an error response
            if (data.error) {
                announcementsDiv.innerHTML = '<p>No recent announcements found.</p>';
                return;
            }
            data.forEach(announcement => {
                const announcementElement = document.createElement('tr');
                announcementElement.classList.add('announcement');
                announcementElement.innerHTML = `
                    <td>${announcement.date}</td>
                    <td><a href="/blobbieblob/form-responses/admin-announcement-details-page.php?id=${announcement.announcementId}" class="announcement-title">${announcement.title}</a></td>
                    <td>${announcement.job_type}</td>
                `;
                announcementsDiv.appendChild(announcementElement);
            });
        })
        .catch((error) => {
            console.error('Error loading recent announcements:', error);
        });
}