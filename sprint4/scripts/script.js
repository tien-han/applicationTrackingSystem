'use strict';

//-------------------------------------------------------------------------------------------------
// Dark Mode Setting, Toggling, and Propagation
//-------------------------------------------------------------------------------------------------
//Run this as soon as the window completely loads to set the theme
window.onload = (event) => {
    setThemeTogglerStatus();
}

//Set the user dark mode preference for the toggler and the theme
function setThemeTogglerStatus() {
    if (localStorage.getItem("darkMode") === "enabled") {
        document.body.classList.add("darkMode");
        checkToggler();
    } else {
        document.body.classList.remove("darkMode");
        uncheckToggler();
    }
    setTheme();
    document.getElementById("darkmode-container").hidden = false;
}

//Helper function that sets dark mode on the toggler
function checkToggler() {
    document.getElementById("darkmode-toggle").checked = true;
}

//Helper function that sets light mode on the toggler
function uncheckToggler() {
    document.getElementById("darkmode-toggle").checked = false;

}

//Event listener for the light/dark mode toggling button
document.getElementById('darkmode-toggle').addEventListener('change', (event) => {
    document.body.classList.toggle("darkMode");

    if (event.currentTarget.checked) {
        // document.body.classList.add("darkMode");
        enableDarkMode();
    } else {
        // document.body.classList.remove("darkMode");
        disableDarkMode();
    }
});

//-------------------------------------------------------------------------------------------------
// New Application Form Validation
//-------------------------------------------------------------------------------------------------
// document.addEventListener('DOMContentLoaded', function() {
//     fetch('../form-responses/get-recent-applications.php')
//         .then(response => {
//             console.log(response); // Check the raw response
//             return response.json();
//         })
//         .then(data => {
//             console.log(data); // Log the JSON data
//             const tableBody = document.getElementById('applicationsTableBody');
//             if (!tableBody) {
//                 console.error('Table body not found');
//                 return;
//             }
//             data.forEach(application => {
//                 console.log(application); // Log each application data
//                 const row = document.createElement('tr');
//                 row.innerHTML = `
//                     <td>${application.application_date}</td>
//                     <td>${application.role_name}</td>
//                     <td>${application.status}</td>
//                     <td><button type="button" class="btn btn-success">Update</button></td>
//                     <td><button type="button" class="btn btn-danger">Delete</button></td>
//                 `;
//                 tableBody.appendChild(row);
//             });
//         })
//         .catch(error => console.error('Error loading recent applications:', error));
// });

if (document.getElementById("new-app-form")) {
    document.addEventListener('DOMContentLoaded', function () {
        var currentDateInput = document.getElementById("application_date");
        var currentDate = new Date();
        currentDateInput.valueAsDate = currentDate;

        function updateFollowUpDate() {
            var selectedDate = new Date(currentDateInput.value);
            var followUpDate = new Date(selectedDate);
            followUpDate.setDate(followUpDate.getDate() + 14);
            document.getElementById("follow_up_date").valueAsDate = followUpDate;
        }
        updateFollowUpDate();
        currentDateInput.addEventListener('change', updateFollowUpDate);

    });

}
// Will go through next sprint and properlly rename all ids in this area to camelCase, my bad for messing that up. -Colton
//New app Form Validation on Change
if (document.getElementById("new-app-form")) {
    document.getElementById("RoleName").addEventListener("change", function () {
        validateRoleName("RoleName");
    })
    document.getElementById("Jobdesc").addEventListener("change", function () {
        validateMessage("Jobdesc");
    })
    document.getElementById("ContactName").addEventListener("change", function () {
        validateFullName("ContactName");
    })
    document.getElementById("ContactEmail").addEventListener("change", function () {
        validateEmail("ContactEmail");
    })
    document.getElementById("ContactPhone").addEventListener("change", function () {
        validateContactPhone("ContactPhone");
    })
    document.getElementById("InterviewNotes").addEventListener("change", function () {
        validateInterviewNotes("InterviewNotes");
    })

    document.getElementById("employerName").addEventListener("change", function () {
        validateemployerName("employerName");
    })
}

//new app Form Validation on Submit
function validatenewappform() {
    const validationResult =
        validateMessage("Jobdesc") //Form validation for a message (currently used in Contact Form)
        && validateEmail("ContactEmail")
        && validateContactPhone("ContactPhone")
        && validateInterviewNotes("InterviewNotes")
        && validateemployerName("employerName")
        && validateFullName("ContactName")
        && validateRoleName("RoleName");
    if (!validationResult) {
        event.preventDefault();
    }
}

function validateemployerName() { //
    const name = document.getElementById("employerName").value.trim();
    const errorMessage = document.getElementById("employerName-error");

    //We won't be validating full name for only alphabetic values, as names may have other characters
    if (name === "") {
        errorMessage.innerText = "***Please enter in a name, you've only entered in spaces";
        return false;
    }
    errorMessage.innerText = "";
    return true;
}

function validateRoleName() { //
    const name = document.getElementById("RoleName").value.trim();
    const errorMessage = document.getElementById("RoleName-error");

    //We won't be validating full name for only alphabetic values, as names may have other characters
    if (name === "") {
        errorMessage.innerText = "***Please enter in a name, you've only entered in spaces";
        return false;
    }
    errorMessage.innerText = "";
    return true;
}

function validateInterviewNotes(messageId) {
    const message = document.getElementById(messageId).value.trim();
    const errorMessage = document.getElementById("InterviewNotes-error");

    if (message === "") {
        errorMessage.innerText = "***Please enter in notes, you've only entered in spaces";
        return false;
    }
    errorMessage.innerText = "";
    return true;
}

function validateContactPhone(ContactPhone) {
    const phoneInput = document.getElementById("ContactPhone");
    const phone = phoneInput.value.trim();
    const errorMessage = document.getElementById("phone-error");
    const phoneNumberPattern = /^\d{10}$/;

    if (!phoneNumberPattern.test(phone)) {
        errorMessage.innerText = "Please enter a valid 10 digit phone number";
        return false;
    }

    errorMessage.innerText = "";
    return true;
}

//-------------------------------------------------------------------------------------------------
// Edit Application Validation
//-------------------------------------------------------------------------------------------------
function validateEditAppForm() {
    validatenewappform();
}

// load date on load and change value to be saved on submit
if (document.getElementById("edit-app-form")) {
    addEventListener("DOMContentLoaded", function () {
        // get the starting value of the date
        let submissionDateInput = document.getElementById("submissionDate");
        let followUpDateDisplay = document.getElementById("followUpDateDisplay");

        // Add event listener for submission date changes
        submissionDateInput.addEventListener('change', function (event) {
            // change value in html
            let submissionDate = event.target.valueAsDate;
        });

        // Add event listener for follow-up date changes
        followUpDateDisplay.addEventListener('change', function (event) {
            // change value in html
            let followUpDate = event.target.valueAsDate;
        });
    });
}

//-------------------------------------------------------------------------------------------------
// Sign Up Form Validation
//-------------------------------------------------------------------------------------------------
//Sign Up Form Validation on Change
if (document.getElementById("sign-up-form")) {
    document.getElementById("name").addEventListener("change", function () {
        validateFullName("name");
    })

    //Email validation
    document.getElementById("email").addEventListener("change", function () {
        validateEmail("email");
    })

    var email = document.getElementById('email').value.trim();
    if (!email.endsWith('@greenriver.edu') && !email.endsWith('@greenrivercollege.edu')) {
        const errorMessage = document.getElementById("email-error");
        errorMessage.innerText = "***A greenriver.edu email is preferred, but not required";
    }

    document.getElementById("message").addEventListener("change", function () {
        validateMessage("message");
    })
}

//Sign Up Form Validation on Submit
function validateUserSignUp() {
    // Validate Cohort Number
    var cohortNumber = document.getElementById('cohortNumber').value;
    if (cohortNumber < 1 || cohortNumber > 100) {
        alert('Cohort Number must be between 1 and 100.');
        event.preventDefault();
        return false;
    }

    // Validate Email
    var email = document.getElementById('email').value.trim();
    if (!email.endsWith('@greenriver.edu') && !email.endsWith('@greenrivercollege.edu')) {
        const errorMessage = document.getElementById("email-error");
        errorMessage.innerText = "***A greenriver.edu email is preferred, but not required";
    }
}

//-------------------------------------------------------------------------------------------------
// Edit User Permissions Form Validation
//-------------------------------------------------------------------------------------------------
//Edit User Permissions Form Validation on Change
if (document.getElementById("edit-user-permissions-form")) {
    const userPermissions = document.getElementById("user-permissions");
    const adminPermissions = document.getElementById("admin-permissions");

    userPermissions.addEventListener("change", function () {
        validateEditUserPermissions();
    })

    adminPermissions.addEventListener("change", function () {
        validateEditUserPermissions();
    })
}

//Edit User Form Validation on Submit
function validateEditUserPermissions() {
    //Get all checkboxes on the page
    let checkboxes = Array.from(document.querySelectorAll("input[type=checkbox]:checked"));

    //Filter out the dark mode toggler checkbox
    let filteredCheckboxes = checkboxes.filter((checkbox) => {
        return checkbox.id != "darkmode-toggle";
    })

    const errorMessage = document.getElementById("permissions-error");
    //If neither of the roles are checked, don't let the user submit
    if (filteredCheckboxes.length === 0) {
        event.preventDefault();
        errorMessage.innerText = "***Please grant the individual at least one ATS role";
        return false;
    }
    errorMessage.innerText = "";
    return true;
}

//-------------------------------------------------------------------------------------------------
// Contact Form Validation
//-------------------------------------------------------------------------------------------------
//Contact Form Validation on Change
if (document.getElementById("contact-page")) {
    document.getElementById("name").addEventListener("change", function () {
        validateFullName("name");
    })
    document.getElementById("email").addEventListener("change", function () {
        validateEmail("email");
    })
    document.getElementById("message").addEventListener("change", function () {
        validateMessage("message");
    })
}

//Contact Form Validation on Submit
function validateContactForm() {
    const validationResult =
        validateFullName("name")
        && validateEmail("email")
        && validateMessage("message");
    if (!validationResult) {
        event.preventDefault();
    }
}

//-------------------------------------------------------------------------------------------------
// Admin Announcement Form Validation
//-------------------------------------------------------------------------------------------------
function validateFormAdmin() {
    var emailInput = document.getElementById('email');
    var urlInput = document.getElementById('url');

    var email = emailInput.value;
    var url = urlInput.value;

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var urlRegex = /^(http(s)?:\/\/)?([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,4}(\S*)?$/;

    if (!emailRegex.test(email)) {
        alert('Invalid email address');
        emailInput.focus();
        return false;
    }

    if (!urlRegex.test(url)) {
        alert('Invalid URL');
        urlInput.focus();
        return false;
    }

    return true;
}

//-------------------------------------------------------------------------------------------------
// Form Validation Helper Methods
//-------------------------------------------------------------------------------------------------
//Validate a full name in a form
//used in new app Contact Name
function validateFullName(nameId) {
    const name = document.getElementById(nameId).value.trim();
    const errorMessage = document.getElementById("name-error");

    //We won't be validating full name for only alphabetic values, as names may have other characters
    if (name === "") {
        errorMessage.innerText = "***Please enter in a name, you've only entered in spaces";
        return false;
    }
    errorMessage.innerText = "";
    return true;
}

//Validate an email in a form
//Note: Entering spaces won't trigger the email "on change" validation for space inputs,
//because on input type="email" spaces aren't valid
function validateEmail(emailId) {
    const email = document.getElementById(emailId).value.trim();
    const errorMessage = document.getElementById("email-error");
    const isEmail = String(email)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );

    if (!isEmail) {
        errorMessage.innerText = "***Please enter an email address"
        return false;
    }
    errorMessage.innerText = "";
    return true;
}

//Form validation for a message/description
//Currently used in contact form message box and new application job description
function validateMessage(messageId) {
    const message = document.getElementById(messageId).value.trim();
    const errorMessage = document.getElementById("message-error");

    if (message === "") {
        errorMessage.innerText = "***Please enter in a message, you've only entered in spaces";
        return false;
    }
    errorMessage.innerText = "";
    return true;
}

//Form validation for the cohort number
function validateCohort(cohortNum) {
    const cohortNumber = document.getElementById(cohortNum).value;
    const errorMessage = document.getElementById("cohort-error");

    if (cohortNumber < 1 || cohortNumber > 100) {
        errorMessage.innerText = "***Cohort  Number must be higher than 1 and 100 or lower";
        return false;
    }
    errorMessage.innerText = "";
    return true;
}