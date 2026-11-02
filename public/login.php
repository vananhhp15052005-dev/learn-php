<?php

require_once '/var/www/src/config/db.php';
$username = '';
$password = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "
        SELECT *
        FROM users
        WHERE username = ?
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        $errorMessage = 'Tên đăng nhập không đúng';
    } else {
        $user = $result->fetch_assoc();
        if (!password_verify($password, $user['password'])) {
            $errorMessage = 'Mật khẩu không đúng';
        } else {
            echo 'Đăng nhập thành công';
        }
    }
}

?>


<form method="POST">
    <h1>Đăng nhập</h1>
    <label for="username">Tên đăng nhập</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Mật khẩu</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Đăng nhập</button>
</form>