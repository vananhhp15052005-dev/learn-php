<?php
require_once '/var/www/src/config/db.php';

$userId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($userId === 0) {
    header('Location: /user-manager.php');
    exit;
}

$sql = '
    DELETE
    FROM users
    WHERE id = ?
';

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();

header('Location: /user-manager.php');
exit;
?>