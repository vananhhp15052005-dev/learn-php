<?php

require_once '/var/www/src/config/db.php';

$userId = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($userId === 0) {
    header('Location: /user-manager.php');
    exit;
}

$sql = '
    SELECT *
    FROM users
    WHERE id = ?
';

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);

    $sql = '
        UPDATE users
        SET username = ?, email = ?
        WHERE id = ?
    ';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $username, $email, $userId);
    $stmt->execute();

    header('Location: /user-manager.php');
    exit;
}

?>

<form method='POST'>
    <h1>Thong tin user <?=htmlspecialchars($user['username'])?></h1>
    <label>
        Ten dang nhap
        <input type='text' name='username' value=<?=htmlspecialchars($user['username'])?> >
    </label>
    <label>
        Email
        <input type='email' name='email' value=<?=htmlspecialchars($user['email'])?> >
    </label>
    <button type='submit'>Cap nhat</button>
</form>