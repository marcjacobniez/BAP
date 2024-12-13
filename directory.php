<?php include 'header.php';   
$region_query = "SELECT DISTINCT region FROM members ORDER BY region";
$region_result = $conn->query($region_query);
?>
<html>
<head>
    <link rel="stylesheet" href="test.css">
</head>
<body>
    <div class="directory">
    <h2>Members List</h2>
    <div class="region-filter">
        <button class="region-btn active" data-region="all">All Regions</button>
        <?php
        if ($region_result->num_rows > 0) {
            while ($region = $region_result->fetch_assoc()) {
                $region_name = htmlspecialchars($region['region']);
                echo "<button class='region-btn' data-region='" . $region_name . "'>" . $region_name . "</button>";
            }
        }
        ?>
    </div>
    <table id="MembersTable">
        <thead>
        <tr>
            <th>First Name</th>
            <th>Middle Initial</th>
            <th>Surname</th>
            <th>Designation</th>
            <th>Region</th>
            <th>Chapter</th>
            <th>Valid-Until</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $stmt = "SELECT first_name, middle_initial, surname, designation, region, chapter, valid_until FROM members";
        $result = $conn->query($stmt);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["middle_initial"] . "</td>";
                echo "<td>" . $row["surname"] . "</td>";
                echo "<td>" . $row["designation"] . "</td>";
                echo "<td>" . $row["region"] . "</td>";
                echo "<td>" . $row["chapter"] . "</td>";
                echo "<td>" . $row["valid_until"] . "</td>";
                echo "</tr>";
            }
        } else {
        echo "<tr><td colspan='7'>No records found</td></tr>";
        }
        ?>
        </tbody>
    </table>
    </div>
    <script src="directory.js"></script>
</body>
</html>