<?php 
session_start();

include 'db.php';

$user_surname = '';
if(isset($_SESSION['account_id']) && $_SESSION['logged_in'] === true) {
    $stmt = $conn->prepare("
        SELECT m.surname 
        FROM account a
        JOIN members m ON a.id_number = m.id_number
        WHERE a.account_id = ?
    ");
    $stmt->bind_param("i", $_SESSION['account_id']);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $user_surname = htmlspecialchars($row['surname']);
    }
    $stmt->close();
}

if (isset($_GET['logout'])) {
    if(isset($_SESSION['account_id'])) {
        $activity_type = "logout";
        $stmt = $conn->prepare("INSERT INTO activity_logs (account_id, activity_type) VALUES (?, ?)");
        $stmt->bind_param("is", $_SESSION['account_id'], $activity_type);
        $stmt->execute();
        $stmt->close();
    }

    session_destroy();
    
    $_SESSION = array();
    
    header("Location: login.php");
    exit();
}

?>
<header>
    <nav class="header-container">
        <img src="images/BAP Federation.jpg" alt="BAP" class="logo">
        <nav class="nav-links">
            <a href="home.html">Home</a>
            <a href="about.html">About</a>
        </nav>
        <div class="user-menu">
        <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <div class="logged-in-container">
                <span class="user-greeting">Welcome, <?php echo $user_surname; ?></span>
                <select id="nav-menu">
                    <option value="">Navigation</option>
                    <option value="profile">My Profile</option>
                    <option value="directory">Referee Directory</option>
                    <option value="logout">Logout</option>
                </select>
            </div>
        <?php else: ?>
            <div class="auth-menu">
                <button id="login-btn">Login</button>
                <button id="register-btn">Register</button>
            </div>
        <?php endif; ?>
        </div>
    </nav>
    <script src="header.js"></script>
</header>