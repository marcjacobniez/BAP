<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bap";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $first = $_POST['first_name'];
  $middle = $_POST['middle_initial'];
  $last = $_POST['surname'];
  $desig = $_POST['designation'];
  $ID = $_POST['id_number'];
  $region = $_POST['region'];
  $chapter = $_POST['chapter'];
  $valid_until = $_POST['valid_until'];

  $sql = $conn->prepare("INSERT INTO members (first_name, middle_initial, surname, designation, id_number, region, chapter, valid_until) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $sql->bind_param("ssssssss", $first, $middle, $last, $desig, $ID, $region, $chapter, $valid_until);
  
  if ($sql->execute()) {
      $message = "Sign up successful. Name: $first $middle $last ID#: $ID";
      echo "<script>alert('$message');</script>";
  } else {
      $message = "Error: " . $sql->errorInfo()[2];
  }


$sql->close();
$conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Page</title>
  <link rel="stylesheet" href="test.css">
</head>
<body>
    <div class="login-container">
        <h2>Register</h2>
        <form action="" method="POST">

          <label for="first_name">First Name</label>
          <input type="text" id="first_name" name="first_name" required>

          <label for="middle_initial">Middle Initial</label>
          <input type="text" id="middle_initial" name="middle_initial" required>
          
          <label for="surname">Surname</label>
          <input type="text" id="surname" name="surname" required>

          <label for="designation">Designation</label>
          <input type="text" id="designation" name="designation" required>
            
          <label for="id_number">ID Number</label>
          <input type="text" id="id_number" name="id_number" required>

          <label for="region">Region</label>
          <input type="text" id="region" name="region" required>

          <label for="chapter">Chapter</label>
          <input type="text" id="chapter" name="chapter" required>

          <label for="valid_until">Valid Until</label>
          <input type="date" id="valid_until" name="valid_until" required>
          
          <button type="submit">Register</button>
        </form>
    </div>
  </body>
  </html>