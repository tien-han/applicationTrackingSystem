function getCookie(name) {
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        if (cookie.startsWith(name + '=')) {
            return cookie.substring(name.length + 1);
        }
    }
    return null;
}

let permissions = getCookie("permissions");

if (permissions == "User") {
    window.location.replace("/blobbieblob/pages/user-dashboard.html");
} else if (permissions == null) {
    window.location.replace("/blobbieblob/index.html");
} else if (permissions == "Admin") {
    alert("ADMIN");
}