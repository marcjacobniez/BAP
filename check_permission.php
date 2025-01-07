<?php
if (!function_exists('checkAccess')) {
    function checkAccess($conn, $account_id, $required_permission) {
        $stmt = $conn->prepare("
            SELECT COUNT(*) as has_access
            FROM account_permission ap
            JOIN permission p ON ap.permission_id = p.permission_id
            WHERE ap.account_id = ? AND p.permission_name = ?
        ");
        
        $stmt->bind_param("is", $account_id, $required_permission);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return $row['has_access'] > 0;
    }
}

if (!function_exists('getUserPermissions')) {
    function getUserPermissions($conn, $account_id) {
        $stmt = $conn->prepare("
            SELECT p.permission_name
            FROM account_permission ap
            JOIN permission p ON ap.permission_id = p.permission_id
            WHERE ap.account_id = ?
        ");
        
        $stmt->bind_param("i", $account_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $permissions = array();
        while ($row = $result->fetch_assoc()) {
            $permissions[] = $row['permission_name'];
        }
        
        return $permissions;
    }
}
?>