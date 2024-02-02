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

//Make sure page has loaded before running event or it will not work
//This adds the onclick toggling event to the dark mode button
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
        var currentDate = new Date();
        document.getElementById("currentDate").innerHTML = currentDate.toDateString();

        var followUpDate = new Date();
        followUpDate.setDate(currentDate.getDate() + 14);
        document.getElementById("followUpDate").innerHTML = followUpDate.toDateString();
    });
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
        validateFullName();
    })
    document.getElementById("email").addEventListener("change", function () {
        validateEmail();
    })
    document.getElementById("message").addEventListener("change", function () {
        validateMessage();
    })
}

//Contact Form Validation on Submit
function validateContactForm() {
    const validationResult =
        validateFullName()
        && validateEmail()
        && validateMessage();

    if (!validationResult) {
        event.preventDefault();
    }
}

//Form validation for a full name
function validateFullName() {
    const name = document.getElementById("name").value.trim();
    const errorMessage = document.getElementById("name-error");

    //We won't be validating full name for only alphabetic values, as names may have other characters
    if (name === "") {
        errorMessage.innerText = "***Please enter in a name, you've only entered in spaces";
        return false;
    }
    errorMessage.innerText = "";
    return true;
}

//Form validation for an email
function validateEmail() {
    const email = document.getElementById("email").value.trim();
    const errorMessage = document.getElementById("email-error");

    if (email === "") {
        errorMessage.innerText = "***Please enter an email address"
        return false;
    }
    errorMessage.innerText = "";
    return true;
}

//Form validation for a message (currently used in Contact Form)
function validateMessage() {
    const message = document.getElementById("message").value.trim();
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