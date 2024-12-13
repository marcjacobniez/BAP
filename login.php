<?php
session_start();
include 'db.php';

$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT account_id, password FROM account WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($account_id, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $stmt->close();
            $activity_type = "login";
            $stmt = $conn->prepare("INSERT INTO activity_logs (account_id, activity_type) VALUES (?, ?)");
            $stmt->bind_param("ss", $account_id, $activity_type);
            $stmt->execute();
            $_SESSION['account_id'] = $account_id;
            $_SESSION['logged_in'] = true;
            header("Location: empty.php");
            exit();
        } else {
            $error_message = "Invalid email or password.";
        }
    } else {
        $error_message = "User not found.";
    }
    
    $stmt->close();
}
?>
<html>
    <head>
        <link rel="stylesheet" href="test.css">
    </head>
    <body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form action="login.php" method="POST">
            Email: <input type="text" name="email" required><br>
            Password: <input type="password" name="password" required><br>
            <button type="submit">Login</button>
            <p class="sign-redirection">Don't have an account? <a href="register.php">Register</a> here.</p>
        </form>
    </div>
    </body>
</html>