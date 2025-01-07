document.addEventListener('DOMContentLoaded', function() {
    const navMenu = document.getElementById('nav-menu');
    const loginBtn = document.getElementById('login-btn');
    const registerBtn = document.getElementById('register-btn');

    if (navMenu) {
        navMenu.addEventListener('change', function() {
            switch(this.value) {
                case 'ecard':
                    window.location.href = 'ecard.php';
                    break;
                case 'directory':
                    window.location.href = 'directory.php';
                    break;
                case 'scanner':
                    window.location.href = 'scanner.php';
                    break;
                case 'logout':
                    window.location.href = 'header.php?logout=true';
                    break;
            }
        });
    }

    if (loginBtn) {
        loginBtn.addEventListener('click', function() {
            window.location.href = 'login.php';
        });
    }

    if (registerBtn) {
        registerBtn.addEventListener('click', function() {
            window.location.href = 'register.php';
        });
    }
});