/*This file contains scripts to get follow-up
* dates 5 days from today for the student homepage.
*
* Author: Sage Markwardt
* Date last touched: 3/4/2024
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
    fiveDaysLate.setDate(today.getDate() - 5)

    // grab our data and create our rows
    await fetch("/YOLO/data-processing/get-follow-up-applications.php")
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
                let follow_up_date = new Date(application.follow_up_date);
                // compare the incoming dates to today to get ones within our range
                if (fiveDaysLate <= follow_up_date && follow_up_date <= fiveDaysAhead) {
                    const row = document.createElement('p');

                    // we'll change the format of the dates so it doesn't display the h/m/s
                    let follow_up_date = new Date(application.follow_up_date);
                    let formattedDate = follow_up_date.toISOString().split('T')[0];

                    // for late items, turn the bell red
                    if (today > follow_up_date){
                        row.innerHTML = `
                            <form id = "${application.applicationsId}" action="/YOLO/form-responses/edit-app-form.php" method = "POST">
                                <input type = "hidden" name = "applicationId" value = "${application.applicationsId}">
                                <a href="javascript:void(0);" onclick="document.getElementById('${application.applicationsId}').submit();"><span style = "color:#D14900;"><i class="fa-solid fa-bell"></i></span>
                                Follow up with ${application.employer_name}</a>
                                <p class = "dated" style = "color:#D14900;">Overdue: ${formattedDate}</p>
                            </form>
                          
                       `;

                    } else {
                        // print the bell icon default color for non-late items
                        row.innerHTML = `
                       
                            <form id = "${application.applicationsId}" action="/YOLO/form-responses/edit-app-form.php" method = "POST">
                                <input type = "hidden" name = "applicationId" value = "${application.applicationsId}">
                                <a href="javascript:void(0);" onclick="document.getElementById('${application.applicationsId}').submit();"><i class="fa-solid fa-bell"></i>
                                Follow up with ${application.employer_name}</a>
                                <p class = "dated">Due: ${formattedDate}</p>
                            </form>
                            
                            
                          
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
