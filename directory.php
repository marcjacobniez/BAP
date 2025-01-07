<?php 
include 'header.php';
include 'check_permission.php';

if (!isset($_SESSION['account_id']) || !isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$can_delete = checkAccess($conn, $_SESSION['account_id'], 'directory_delete');
$can_edit = checkAccess($conn, $_SESSION['account_id'], 'directory_edit');

if ($can_delete && isset($_POST['delete_member'])) {
    $id_to_delete = $_POST['member_id'];
    $delete_stmt = $conn->prepare("DELETE FROM members WHERE id_number = ?");
    $delete_stmt->bind_param("s", $id_to_delete);
    $delete_stmt->execute();
}

$region_query = "SELECT DISTINCT region FROM members ORDER BY region";
$region_result = $conn->query($region_query);
$existing_regions = array();
while ($row = $region_result->fetch_assoc()) {
    $existing_regions[] = $row['region'];
}
?>
<html>
<head>
    <link rel="stylesheet" href="test.css">
</head>
<body>
    <div class="directory">
        <h2>Members List</h2>
        
        <div class="controls-container">
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="Search members...">
            </div>
            <div class="region-filter">
                <button class="region-btn active" data-region="all">All Regions</button>
                <?php
                $ordered_regions = array(
                    'NCR',
                    '1',
                    '2',
                    '3',
                    '4A',
                    '4B',
                    '5',
                    '6',
                    '7',
                    '8',
                    '9',
                    '10',
                    '11',
                    '12',
                    '13',
                    'CAR',
                    'BARMM'
                );
                
                foreach ($ordered_regions as $region) {
                    echo "<button class='region-btn' data-region='" . htmlspecialchars($region) . "'>" . htmlspecialchars($region) . "</button>";    
                }
                ?>
            </div>
        </div>
        <table id="MembersTable">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>M.I.</th>
                    <th>Surname</th>
                    <th>Designation</th>
                    <th>Region</th>
                    <th>Chapter</th>
                    <th>Valid-Until</th>
                    <?php if ($can_edit || $can_delete): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stmt = "SELECT id_number, first_name, middle_initial, surname, designation, region, chapter, valid_until FROM members";
                    $result = $conn->query($stmt);
                    if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr data-region='" . htmlspecialchars($row['region']) . "'>";
                        echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['middle_initial']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['surname']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['designation']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['region']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['chapter']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['valid_until']) . "</td>";
                    
                        if ($can_edit || $can_delete) {
                            echo "<td class='action-buttons'>";
                            if ($can_edit) {
                                echo "<button onclick='window.location.href=\"edit_member.php?id=" . 
                                htmlspecialchars($row['id_number']) . "\"' class='edit-btn'>Edit</button>";
                            }
                            if ($can_delete) {
                                echo "<form method='POST' class='delete-form' onsubmit='return confirmDelete()'>";
                                echo "<input type='hidden' name='member_id' value='" . htmlspecialchars($row['id_number']) . "'>";
                                echo "<button type='submit' name='delete_member' class='delete-btn'>Delete</button>";
                                echo "</form>";
                            }
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
                    } else {
                    echo "<tr><td colspan='8'>No records found</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script src="directory.js"></script>
</body>
</html>