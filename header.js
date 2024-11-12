document.addEventListener("DOMContentLoaded", function() {
    const loggedIn = false; // Replace with actual login status check
    const username = "JohnDoe"; // Replace with actual user's name

    if (loggedIn) {
        document.querySelector('.login').style.display = 'none';
        document.querySelector('.register').style.display = 'none';
        const usernameSpan = document.querySelector('.username');
        usernameSpan.textContent = username;
        usernameSpan.style.display = 'inline';
    }
});
