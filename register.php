<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_number = $_POST['id_number'];
    $email = $_POST['email'];
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT id_number FROM members WHERE id_number = ?");
    $stmt->bind_param("s", $id_number);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 0) {
        echo "<script>
        alert('Invalid ID number. Please contact your administrator.');
        </script>";
    } else {
        $stmt->close();
        $stmt = $conn->prepare("SELECT email FROM account WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<script>
            alert('This email is already registered. Please use a different email.');
            </script>";
        } else {
            $stmt->close();
            $stmt = $conn->prepare("SELECT * FROM account WHERE id_number = ?");
            $stmt->bind_param("s", $id_number);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo "<script>
                alert('This ID number is already registered.');
                </script>";
            } else {
                $stmt->close();
                $stmt = $conn->prepare("INSERT INTO account (id_number, email, password) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $id_number, $email, $hashed_password);

                if ($stmt->execute()) {
                    echo "<script>
                    alert('Registration successful!');
                    </script>";
                    header("Location: login.php");
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
    }

    $stmt->close();
}
}
?>
<html>
    <head>
        <link rel="stylesheet" href="test.css">
    </head>
    <body>
    <div class="login-container">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            ID Number: <input type="text" name="id_number" required><br>
            Email: <input type="email" name="email" required><br>
            Password: <input type="password" name="password" required><br>
            <button type="submit">Register</button>
            <p class="sign-redirection">Already have an account? <a href="login.php">Login</a> here.</p>
        </form>
    </div>
    </body>
</html>