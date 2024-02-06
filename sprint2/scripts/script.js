'use strict';

//-------------------------------------------------------------------------------------------------
// Dark Mode Setting, Toggling, and Propagation
//-------------------------------------------------------------------------------------------------
//Run this as soon as the window completely loads to store user preferences
window.onload = (event) => {
    //Set the user dark mode preference in local storage if it doesn't exist yet
    if (localStorage.getItem("darkMode") === null) {
        localStorage.setItem("darkMode", "disabled");
    }
    setColorTheme();
}

//Function to set the dark/light mode depending on what has been selected
function setColorTheme() {
    if (localStorage.getItem("darkMode") === "enabled") {
        enableDarkMode();
    } else {
        disableDarkMode();
    }
}

//Helper function that sets light mode
function disableDarkMode() {
    localStorage.setItem("darkMode", "disabled");
    document.body.classList.remove("darkMode");
    document.getElementById("dark-light").textContent = "Dark Mode";
}

//Helper function that sets dark mode
function enableDarkMode() {
    localStorage.setItem("darkMode", "enabled");
    document.body.classList.add("darkMode");
    document.getElementById("dark-light").textContent = "Light Mode";
}

//This adds the onclick toggling event to the dark mode button
//Make sure page has loaded before running event or it will not work
document.addEventListener("DOMContentLoaded", function () {
    // locate the button
    let darkLight = document.getElementById("dark-light");

    // toggle darkMode on click and change button text contents
    darkLight.onclick = function (event) {
        document.body.classList.toggle("darkMode");

        if (document.body.classList.contains("darkMode")) {
            enableDarkMode();
        } else {
            disableDarkMode();
        }
    }
});

//-------------------------------------------------------------------------------------------------
// New Application Form Validation
//-------------------------------------------------------------------------------------------------
if (document.getElementById("new-app-form")) {
    document.addEventListener('DOMContentLoaded', function () {
        var currentDateInput = document.getElementById("currentDateInput");
        var currentDate = new Date();
        currentDateInput.valueAsDate = currentDate;

        function updateFollowUpDate() {
            var selectedDate = new Date(currentDateInput.value);
            var followUpDate = new Date(selectedDate);
            followUpDate.setDate(currentDate.getDate() + 14);
            document.getElementById("followUpDateDisplay").innerHTML = followUpDate.toDateString();
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
// Sign Up Form Validation
//-------------------------------------------------------------------------------------------------
if (document.getElementById("sign-up-form")) {
    document.getElementById('signupForm').addEventListener('submit', function (event) {
        // Validate Cohort Number
        var cohortNumber = document.getElementById('cohortNumber').value;
        if (cohortNumber < 1 || cohortNumber > 100) {
            alert('Cohort Number must be between 1 and 100.');
            event.preventDefault();
            return false;
        }

        // Validate Email
        var email = document.getElementById('email').value;
        if (!email.endsWith('@greenriver.edu') && !email.endsWith('@greenrivercollege.edu')) {
            // Ask user for confirmation to proceed
            var confirmation = confirm('greenriver.edu email is preferred. Are you sure you want to proceed?');
            if (!confirmation) {
                event.preventDefault();
                return false;
            }
        }

        return true;
    });
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
// Form Validation Helper Methods
//-------------------------------------------------------------------------------------------------
//Validate a full name in a form
//used in new app Contact Name
function validateFullName(nameId) {
    console.log("Validating full name");
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

//-------------------------------------------------------------------------------------------------
// Users Table Search Bar
//-------------------------------------------------------------------------------------------------
function searchUsers() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("user-search");
    filter = input.value.toUpperCase();
    table = document.getElementById("users-table");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

// admin announcement Form Validation

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