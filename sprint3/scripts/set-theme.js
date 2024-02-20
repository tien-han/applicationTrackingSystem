'use strict'

//-------------------------------------------------------------------------------------------------
// Dark/Light Mode Propagation Before Page Load
//-------------------------------------------------------------------------------------------------
//Immediately as the page starts loading, set the color theme
//This is to prevent a white "flicker" on a page load if in dark mode
setTheme();

//Function to set the dark/light mode depending on what has been selected
function setTheme() {
    //Set the user dark mode preference in local storage if it doesn't exist yet
    if (localStorage.getItem("darkMode") === null) {
        localStorage.setItem("darkMode", "disabled");
    }

    //Enable or disable dark mode depending on what has been selected
    if (localStorage.getItem("darkMode") === "enabled") {
        enableDarkMode();
    } else {
        disableDarkMode();
    }
}

//Helper function that sets light mode
function disableDarkMode() {
    localStorage.setItem("darkMode", "disabled");
    document.documentElement.setAttribute('data-bs-theme', 'light');
}

//Helper function that sets dark mode
function enableDarkMode() {
    localStorage.setItem("darkMode", "enabled");
    document.documentElement.setAttribute('data-bs-theme', 'dark');
}
//-------------------------------------------------------------------------------------------------