/*This file contains scripts to get follow-up
* dates 5 days from today for the student homepage.
*
* Author: Sage Markwardt, Colton Matthews
* Date last touched: 3/17/2024
* File: get-follow-ups.js

 */
window.addEventListener("load", function (event) {
    getFollowUps();
});

async function getFollowUps() {
    let today = new Date();
    let fiveDaysAhead = new Date(today);
    fiveDaysAhead.setDate(today.getDate() + 5);
    let fiveDaysLate = new Date(today);
    fiveDaysLate.setDate(today.getDate() - 5);

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
                if (followUpsAdded >= 5) return; //caps follow ups at 5 or set number

                let follow_up_date = new Date(application.follow_up_date);
                if (fiveDaysLate <= follow_up_date && follow_up_date <= fiveDaysAhead) {
                    const container = document.createElement('div');
                    container.className = 'follow-up-container';
                    container.style.position = 'relative'; // Ensure container is positioned relatively for absolute positioning of close button

                    let formattedDate = follow_up_date.toISOString().split('T')[0];
                    let overdue = today > follow_up_date;
                    let overdueStyle = overdue ? 'color:#D14900;' : '';
                    let overdueText = overdue ? 'Overdue: ' : 'Due: ';

                    container.innerHTML = `
                        <div class="follow-up-content" style="${overdueStyle}">
                            <form id="${application.applicationsId}" class="follow-up-form" action="/blobbieblob/form-responses/edit-app-form.php" method="POST">
                                <input type="hidden" name="applicationId" value="${application.applicationsId}">
                                <a href="javascript:void(0);" onclick="document.getElementById('${application.applicationsId}').submit();"><i class="fa-solid fa-bell"></i>
                                Follow up with ${application.employer_name}</a>
                                <p class="dated">${overdueText}${formattedDate}</p>
                            </form>
                        </div>  
                        <div class="close-btn" style="position: absolute; right: 5px; top: 5px; cursor:pointer;">&#10005;</div> 
                    `;  //positions the "X"
                    reminders.appendChild(container);

                    // x closes the follow ups
                    container.querySelector('.close-btn').addEventListener('click', function() {
                        container.style.display = 'none';
                    });

                    followUpsAdded++;
                }
            });
        })
        .catch((error) => {
            console.error('Error loading follow ups:', error);
        });
}
