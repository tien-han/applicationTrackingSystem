//This method gets all the cookies in the page and returns the cookie with the
//given key
function getCookie(name) {
    //Get all cookies on the page and split them into an array with all cookies
    const cookies = document.cookie.split(';');

    //Look at all the cookies
    for (let i = 0; i < cookies.length; i++) {
        const cookie = cookies[i].trim();
        //Return the value matched to the given key for the cookie
        if (cookie.startsWith(name + '=')) {
            return cookie.substring(name.length + 1);
        }
    }
    //If we don't find the key we're looking for, return null
    return null;
}