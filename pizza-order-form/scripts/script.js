function validateForm() {
    state();
    schoolEmail();
    delivery();
    phoneValidate();
    validateToppings();
}

function state(){
let x = document.forms["pizza"]["state"].value;
if (x != "Washington" && x != "WA") {
    alert("State must be Washington");
    return false;
}
}

function schoolEmail(){
    let x = document.forms["pizza"]["email"].value;
    if (!x.endsWith("greenriver.edu")) {
        confirm("A greenriver school email is highly recommended. Are you sure you don't want to use a school email?");
        if (!confirm){
            return false;
        }
    }
}

function delivery(){
    let cityInput = document.getElementById('city').value.trim().toLowerCase();
    let allowedCities = ['seattle', 'kent', 'auburn', 'burien', 'seatac'];
    if (!allowedCities.includes(cityInput)) {
        alert('A $25 delivery fee will be added for cities other than Seattle, Kent, Auburn, Burien, or SeaTac.');
    }
}

function phoneValidate() {
    let phoneInput = document.getElementById('phone');
    const phoneRegex = /^\d{10}$/; // Assuming a 10-digit phone number
    if (!phoneRegex.test(phoneInput.value.trim())) {
        alert('Please enter a valid 10-digit phone number.');
    } else {
        return true;
    }
}

function validateToppings() {
    let checkboxes = document.querySelectorAll('input[type="checkbox"]');
    var count = 0;
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked === true) {
            count++;
        }
    }

if (count !== 3) {
    alert('Please select exactly 3 toppings.');
    return false;
}

    return true;
}









