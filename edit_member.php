<?php
include 'header.php';
include 'check_permission.php';

if (!isset($_SESSION['account_id']) || !checkAccess($conn, $_SESSION['account_id'], 'directory_edit')) {
    header("Location: directory.php");
    echo "<script>alert('You do not have permission to edit members.');</script>";
    exit();
}

$success_message = '';
$error_message = '';

if (isset($_GET['id'])) {
    $stmt = $conn->prepare("SELECT * FROM members WHERE id_number = ?");
    $stmt->bind_param("s", $_GET['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $member = $result->fetch_assoc();

    if (!$member) {
        header("Location: directory.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_member'])) {
    $id_number = $_POST['id_number'];
    $first_name = $_POST['first_name'];
    $middle_initial = $_POST['middle_initial'];
    $surname = $_POST['surname'];
    $designation = $_POST['designation'];
    $region = $_POST['region'];
    $chapter = $_POST['chapter'];
    $valid_until = $_POST['valid_until'];

    try {
        $update_stmt = $conn->prepare("
            UPDATE members 
            SET first_name = ?, middle_initial = ?, surname = ?, 
                designation = ?, region = ?, chapter = ?, valid_until = ?
            WHERE id_number = ?
        ");
        
        $update_stmt->bind_param("ssssssss", 
            $first_name, $middle_initial, $surname, 
            $designation, $region, $chapter, $valid_until, 
            $id_number
        );

        if ($update_stmt->execute()) {
            $success_message = "Member information updated successfully!";
        } else {
            $error_message = "Error updating member information.";
        }
    } catch (Exception $e) {
        $error_message = "Error: " . $e->getMessage();
    }
}
?>

<html>
<head>
    <link rel="stylesheet" href="test.css">
</head>
<body>
    <div class="login-container">
        <h2>Edit Member</h2>
        
        <?php if ($success_message): ?>
            <div class="success-message"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <input type="hidden" name="id_number" value="<?php echo htmlspecialchars($member['id_number']); ?>">
            
            <label for="first_name">First Name:</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($member['first_name']); ?>" required>
            
            <label for="middle_initial">Middle Initial:</label>
            <input type="text" name="middle_initial" value="<?php echo htmlspecialchars($member['middle_initial']); ?>" maxlength="5">
            
            <label for="surname">Surname:</label>
            <input type="text" name="surname" value="<?php echo htmlspecialchars($member['surname']); ?>" required>
            
            <label for="designation">Designation:</label>
            <input type="text" name="designation" value="<?php echo htmlspecialchars($member['designation']); ?>" required>
            
            <label for="region">Region:</label>
            <select name="region" required>
                <?php
                $regions = array('NCR', '1', '2', '3', '4A', '4B', '5', '6', '7', '8', '9', '10', '11', '12', '13', 'CAR', 'BARMM');
                foreach ($regions as $r) {
                    $selected = ($r === $member['region']) ? 'selected' : '';
                    echo "<option value='$r' $selected>$r</option>";
                }
                ?>
            </select>
            
            <label for="chapter">Chapter:</label>
            <input type="text" name="chapter" value="<?php echo htmlspecialchars($member['chapter']); ?>" required>
            
            <label for="valid_until">Valid Until:</label>
            <input type="date" name="valid_until" value="<?php echo htmlspecialchars($member['valid_until']); ?>" required>
            
            <div class="button-group">
                <button type="submit" name="update_member">Update Member</button>
                <button type="button" onclick="window.location.href='directory.php'" class="cancel-btn">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>