<?php include 'db.php';   ?>
<header>
    <div class="header-container">
        <img src="images/BAP Federation.jpg" alt="BAP" class="logo">
        <nav class="nav-links">
            <a href="home.html">Home</a>
            <a href="about.html">About</a>
        </nav>
        <div class="user-options">
            <a href="login.php" class="login">Login</a>
            <a href="register.php" class="register">Register</a>
            <!--They said this will dynamically change into the user's name when logged in-->
            <span class="username" style="display: none;">Username</span>
            <script src="header.js"></script>
            <!--Testing-->
        </div>
    </div>
</header>