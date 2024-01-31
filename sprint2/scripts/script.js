// make sure page has loaded before running event or it will not work
document.addEventListener("DOMContentLoaded", function () {
    // locate the button
    let darkLight = document.getElementById("dark-light")
        ;

    // toggle darkMode on click and change button text contents
    darkLight.onclick = function (event) {
        document.body.classList.toggle("darkMode");
        if (document.body.classList.contains("darkMode")) {
            darkLight.textContent = "Light Mode";
        } else {
            darkLight.textContent = "Dark Mode";
        }
    }
});


document.addEventListener('DOMContentLoaded', function () {
    var currentDate = new Date();
    document.getElementById("currentDate").innerHTML = currentDate.toDateString();

    var followUpDate = new Date();
    followUpDate.setDate(currentDate.getDate() + 14);
    document.getElementById("followUpDate").innerHTML = followUpDate.toDateString();
});

// JavaScript for form validations
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

// make sure page has loaded before running event or it will not work
document.addEventListener("DOMContentLoaded", function () {
    // locate the button
    let darkLight = document.getElementById("dark-light")
        ;

    // toggle darkMode on click and change button text contents
    darkLight.onclick = function (event) {
        document.body.classList.toggle("darkMode");
        if (document.body.classList.contains("darkMode")) {
            darkLight.textContent = "Light Mode";
        } else {
            darkLight.textContent = "Dark Mode";
        }

    }
});

document.addEventListener("DOMContentLoaded", function () {
    // locate the button
    let darkLight = document.getElementById("dark-light")
        ;

    // toggle darkMode on click and change button text contents
    darkLight.onclick = function (event) {
        document.body.classList.toggle("darkMode");
        if (document.body.classList.contains("darkMode")) {
            darkLight.textContent = "Light Mode";
        } else {
            darkLight.textContent = "Dark Mode";
        }

    }
});