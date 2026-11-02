<?php
require_once '/var/www/src/config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $checkSql = '
        SELECT * 
        FROM users
        WHERE username = ?
    ';
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo 'Ten dang nhap da ton tai';
    } else {
        $sql = '
            INSERT INTO users (username, email, password)
            VALUES (?, ?, ?)
        ';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $username, $email, $hashedPassword);
        $stmt->execute();
        
        header('Location: /user-manager.php');
        exit;
    }
}

?>

<div>
    <h1>Them nguoi dung</h1>
    <form method='POST'>
        <label>Ten dang nhap</label>
        <input type='text' name='username' required>

        <label>Email</label>
        <input type='email' name='email' required>

        <label>Mat khau</label>
        <input type='password' name='password' required>

        <button type='submit'>Tao nguoi dung</button>
    </form>
</div>