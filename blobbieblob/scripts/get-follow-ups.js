/*This file contains scripts to get follow-up
* dates 5 days from today for the student homepage.
*
* Author: Sage Markwardt, Colton Matthews
* Date last touched: 3/18/2024
* File: get-follow-ups.js
*/
window.addEventListener("load", function (event) {
    getFollowUps();
})

async function getFollowUps() {
    // first grab the date range +-5
    let today = new Date();
    let fiveDaysAhead = new Date(today);
    fiveDaysAhead.setDate(today.getDate() + 5);
    let fiveDaysLate = new Date(today);
    fiveDaysLate.setDate(today.getDate() - 5);

    // grab our data and create our rows
    await fetch("/blobbieblob/data-processing/get-follow-up-applications.php")
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
            let followUpsAdded = 0;
            data.forEach(application => {
                if (followUpsAdded >= 5) return; // cap the reminders at 5

                let follow_up_date = new Date(application.follow_up_date);
                // compare the incoming dates to today to get ones within our range
                if (fiveDaysLate <= follow_up_date && follow_up_date <= fiveDaysAhead) {
                    const row = document.createElement('div'); // using divs to make the "x" easier
                    row.style.display = 'flex';
                    row.style.justifyContent = 'space-between';
                    row.style.alignItems = 'center';

                    let formattedDate = follow_up_date.toISOString().split('T')[0];

                    // for late items, turn the bell red
                    if (today > follow_up_date) {
                        row.innerHTML = `
                            <form id = "${application.applicationsId}" action="/blobbieblob/form-responses/edit-app-form.php" method = "POST" style="flex-grow: 1; margin-right: 10px;">
                                <input type = "hidden" name = "applicationId" value = "${application.applicationsId}">
                                <a href="javascript:void(0);" onclick="document.getElementById('${application.applicationsId}').submit();"><span style = "color:#D14900;"><i class="fa-solid fa-bell"></i></span>
                                Follow up with ${application.employer_name}</a>
                                <p class = "dated" style = "color:#D14900;">Overdue: ${formattedDate}</p>
                            </form>
                            <span style="cursor:pointer;" onclick="this.parentElement.remove();">&#10005;</span>
                        `;
                    } else {
                        // print the bell icon default color for non-late items
                        row.innerHTML = `
                            <form id = "${application.applicationsId}" action="/blobbieblob/form-responses/edit-app-form.php" method = "POST" style="flex-grow: 1; margin-right: 10px;">
                                <input type = "hidden" name = "applicationId" value = "${application.applicationsId}">
                                <a href="javascript:void(0);" onclick="document.getElementById('${application.applicationsId}').submit();"><i class="fa-solid fa-bell"></i>
                                Follow up with ${application.employer_name}</a>
                                <p class = "dated">Due: ${formattedDate}</p>
                            </form>
                            <span style="cursor:pointer;" onclick="this.parentElement.remove();">&#10005;</span>
                        `;
                    }

                    reminders.appendChild(row);


                }
            });
        })
        .catch((error) => {
            console.error('Error loading follow ups:', error);
        });
}
