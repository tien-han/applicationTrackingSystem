// make sure page has loaded before running event or it will not work
document.addEventListener("DOMContentLoaded", function() {
    // locate the button
    let darkLight = document.getElementById("dark-light")
    ;

    // toggle darkMode on click and change button text contents
    darkLight.onclick = function (event) {
        document.body.classList.toggle("darkMode");
        if (document.body.classList.contains("darkMode")){
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
