<?php

require 'vendor/autoload.php';
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

include 'header.php';

if (!isset($_SESSION['account_id']) || !isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->prepare("
    SELECT m.* 
    FROM members m 
    JOIN account a ON m.id_number = a.id_number 
    WHERE a.account_id = ?
");
$stmt->bind_param("i", $_SESSION['account_id']);
$stmt->execute();
$result = $stmt->get_result();
$member = $result->fetch_assoc();

if (!$member) {
    echo "Member not found";
    exit();
}

$qrCode = QrCode::create(json_encode([
    'id' => $member['id_number'],
    'name' => $member['first_name'] . ' ' . $member['middle_initial'] . ' ' . $member['surname'],
    'designation' => $member['designation'],
    'valid_until' => $member['valid_until']
]))
->setSize(150)
->setMargin(10);

$writer = new PngWriter();
$result = $writer->write($qrCode);
$qrDataUri = $result->getDataUri();

?>

<html>
<head>
    <link rel="stylesheet" href="test.css">
</head>
<body>
    <div class="ecard-container">
        <div class="ecard">
            <div class="ecard-header">
                <img src="images/BAP Federation.jpg" alt="BAP Logo" class="ecard-logo">
                <h2>Basketball Association of the Philippines Federation</h2>
                <p class="federation-text">Roll D' Ball Inc.</p>
            </div>
    
            <div class="ecard-body">
                <div class="ecard-content">
                    <div class="member-photo">
                        <img src="images/memberplaceholderpicture.png" alt="Work in Progress!!!">
                    </div>
            
                    <div class="member-details">
                        <div class="detail-row">
                            <span class="label">ID Number:</span>
                            <span class="value"><?php echo htmlspecialchars($member['id_number']); ?></span>
                        </div>
                    <div class="detail-row">
                        <span class="label">Name:</span>
                        <span class="value">
                            <?php 
                            echo htmlspecialchars($member['first_name']) . " " . 
                                 htmlspecialchars($member['middle_initial']) . " " . 
                                 htmlspecialchars($member['surname']); 
                            ?>
                        </span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Designation:</span>
                        <span class="value"><?php echo htmlspecialchars($member['designation']); ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Region:</span>
                        <span class="value"><?php echo htmlspecialchars($member['region']); ?></span>
                    </div>
                    <div class="detail-row">
                        <span class="label">Chapter:</span>
                        <span class="value"><?php echo htmlspecialchars($member['chapter']); ?></span>
                    </div>
                </div>
            </div>
        
            <div class="qr-code">
                <img src="<?php echo $qrDataUri; ?>" alt="QR Code">
            </div>
        </div>
    
        <div class="ecard-footer">
            <div class="valid-until">
                Valid Until: <?php echo htmlspecialchars($member['valid_until']); ?>
            </div>
        </div>
    </div>
        
        <div class="ecard-actions">
            <button onclick="window.print()" class="action-button">Print E-Card</button>
        </div>
    </div>
</body>
</html>