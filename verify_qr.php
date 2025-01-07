<?php
include 'db.php';
include 'check_permission.php';
session_start();

if (!isset($_SESSION['account_id']) || !checkAccess($conn, $_SESSION['account_id'], 'qr_verify')) {
    echo json_encode(['status' => 'error', 'message' => 'You do not have permission to verify QR codes']);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['qr_data'])) {
    try {
        $data = json_decode($_POST['qr_data'], true);
        
        if (!$data) {
            echo json_encode(['status' => 'invalid', 'message' => 'Invalid QR Code format']);
            exit;
        }

        $stmt = $conn->prepare("SELECT * FROM members WHERE id_number = ?");
        $stmt->bind_param("s", $data['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $member = $result->fetch_assoc();
        
        if ($member) {
            $valid_until = strtotime($member['valid_until']);
            $current_date = time();
            
            if ($valid_until >= $current_date) {
                $response = [
                    'status' => 'valid',
                    'message' => "Valid Member: " . $member['first_name'] . " " . $member['surname'] . 
                                "\nDesignation: " . $member['designation'] . 
                                "\nRegion: " . $member['region'] . 
                                "\nValid until: " . $member['valid_until']
                ];
            } else {
                $response = [
                    'status' => 'invalid',
                    'message' => "Expired Membership\nMember: " . $member['first_name'] . " " . $member['surname'] . 
                                "\nExpired on: " . $member['valid_until']
                ];
            }
        } else {
            $response = ['status' => 'invalid', 'message' => 'Invalid or unregistered member'];
        }
        
        echo json_encode($response);
        exit;
        
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error processing QR code']);
        exit;
    }
}

echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
exit;
?>