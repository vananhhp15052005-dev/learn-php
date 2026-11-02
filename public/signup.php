<?php

require_once '/var/www/src/config/db.php';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "
        INSERT INTO users (username, email, password)
        VALUES (?, ?, ?)
    ";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $username, $email, $hashed_password);
    $stmt->execute();
    $stmt->close();

    header('Location: /login.php');
    exit();
}

?>


<form method="POST">
    <?php if ($errorMessage !== ''): ?>
        <p style="color: red;">
            <?= htmlspecialchars($errorMessage) ?>
        </p>
    <?php endif; ?>
    <label>
        Tên đăng nhập
        <input type="text" name="username" required>
    </label>
    <label>
        Email
        <input type="email" name="email" required>
    </label>
    <label>
        Mật khẩu
        <input type="password" name="password" required>
    </label>
    <label>
        Xác nhận mật khẩu
        <input type="password" name="confirm_password" required>
    </label>
    <button type="submit">Đăng ký</button>
</form>